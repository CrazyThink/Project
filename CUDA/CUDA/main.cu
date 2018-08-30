#include <fstream>
#include <iostream>
#include <string>
#include <array>
#include <vector>
#include <iterator>
#include <Windows.h>
#include <assert.h>
#include <omp.h>
#include <thrust/host_vector.h>
#include <thrust/device_vector.h>
#include <thrust/copy.h>
#include "DS_timer.h"
#include "cuda_runtime.h"
#include "device_launch_parameters.h"

using namespace std;

#define THREAD 8
#define THREAD_IN_BLOCK 256

uint32_t fileSize;
uint32_t dataOffset;
uint32_t width;
uint32_t height;
uint32_t depth;
int dataSize;

__global__ void grayFilter(char* img, int dataSize) {
	int tid = (blockIdx.x * blockDim.x + threadIdx.x) * 3;
	if (tid > dataSize) return;

	double R = img[tid + 2] & 0xff;
	double G = img[tid + 1] & 0xff;
	double B = img[tid    ] & 0xff;

	char temp = R * .299f + G * .587f + B * .114f;
	img[tid + 2] = temp;	//R
	img[tid + 1] = temp;	//G
	img[tid    ] = temp;	//B
}

__global__ void brightFilter(char* img, int dataSize) {
	int tid = (blockIdx.x * blockDim.x + threadIdx.x) * 3;
	if (tid > dataSize) return;

	double R = img[tid + 2] & 0xff;
	double G = img[tid + 1] & 0xff;
	double B = img[tid    ] & 0xff;

	img[tid + 2] = (R + R * .2f) > 255 ? 255 : (R + R * .2f);
	img[tid + 1] = (G + G * .2f) > 255 ? 255 : (G + G * .2f);
	img[tid    ] = (B + B * .2f) > 255 ? 255 : (B + B * .2f);
}

__global__ void sepiaFilter(char* img, int dataSize) {
	int tid = (blockIdx.x * blockDim.x + threadIdx.x) * 3;
	if (tid > dataSize) return;

	double R = img[tid + 2] & 0xff;
	double G = img[tid + 1] & 0xff;
	double B = img[tid] & 0xff;

	double R_temp = R * .393f + G * .769f + B * .189f;
	double G_temp = R * .349f + G * .686f + B * .168f;
	double B_temp = R * .272f + G * .534f + B * .131f;

	img[tid + 2] = R_temp > 255 ? 255 : R_temp;
	img[tid + 1] = G_temp > 255 ? 255 : G_temp;
	img[tid] = B_temp > 255 ? 255 : B_temp;
}
__global__ void customFilter(char* img, int dataSize) {
	int tid = (blockIdx.x * blockDim.x + threadIdx.x) * 3;
	if (tid > dataSize) return;

	double R = img[tid + 2] & 0xff;
	double G = img[tid + 1] & 0xff;
	double B = img[tid] & 0xff;

	double R_temp = R;
	double G_temp = G;
	double B_temp = B;

	const double rate = .2f;
	int standard = 15;		//차이 허용 값

	if (R > 160 && G > 160 && B > 160) {
		standard = 20;
	}
	if (R > B && G > B) {	//B가 제일 작을 때
		R_temp = R + R * rate;
		G_temp = G + G * rate;
	}
	if (R > G && B > G) {	//G가 제일 작을 때
		R_temp = R + R * rate;
		B_temp = B + B * rate;
	}
	if (G > R && B > R) {	//R이 제일 작을 때
		G_temp = G + G * rate;
		B_temp = B + B * rate;
	}
	if (R > B && R > G) {	//R이 제일 클 때
		R_temp = R + R * rate;
		G_temp = G + G * rate;
		B_temp = B;
		if (G_temp < B_temp) B_temp = B + B * rate;
	}
	if (G > R && G > B) {	//G가 제일 클 때
		R_temp = R + R * rate;
		G_temp = G + G * rate;
		B_temp = B;
		if (R_temp < B_temp) B_temp = B + B * rate;
	}
	if (abs(R - G) < standard && abs(G - B) < standard && abs(R - B) < standard) {
		R_temp = R + R * rate;
		G_temp = G + G * rate;
		B_temp = B;
	}
	else if (B > R && B > G && abs(G - B) < standard && abs(R - B) < standard * 2) {
		R_temp = R + R * rate;
		G_temp = G + G * rate;
		B_temp = B;
	}
	else if (B > R && B > G) {//B가 제일 클 때
		R_temp = R;
		G_temp = G;
		B_temp = B + B * rate;
		if (R_temp > G_temp) R_temp = R + R * rate;
		else G_temp = G + G * rate;
	}

	img[tid + 2] = R_temp > 255 ? 255 : R_temp;
	img[tid + 1] = G_temp > 255 ? 255 : G_temp;
	img[tid] = B_temp > 255 ? 255 : B_temp;
}

inline vector<char> grayFilter(vector<char> img) {
	#pragma omp parallel for num_threads(THREAD)
	for (int i = dataSize - 3; i >= 0; i -= 3){
		double R = img[i + 2] & 0xff;
		double G = img[i + 1] & 0xff;
		double B = img[i] & 0xff;

		char temp = R * .299f + G * .587f + B * .114f;
		img[i + 2] = temp;	//R
		img[i + 1] = temp;	//G
		img[i] = temp;	//B
	}
	return img;
}

inline vector<char> brightFilter(vector<char> img) {
	#pragma omp parallel for num_threads(THREAD)
	for (int i = dataSize - 3; i >= 0; i -= 3) {
		double R = img[i + 2] & 0xff;
		double G = img[i + 1] & 0xff;
		double B = img[i] & 0xff;

		img[i + 2] = (R + R * .2f) > 255 ? 255 : (R + R * .2f);
		img[i + 1] = (G + G * .2f) > 255 ? 255 : (G + G * .2f);
		img[i] = (B + B * .2f) > 255 ? 255 : (B + B * .2f);
	}
	return img;
}

inline vector<char> sepiaFilter(vector<char> img) {
	#pragma omp parallel for num_threads(THREAD)
	for (int i = dataSize - 3; i >= 0; i -= 3){
		double R = img[i + 2] & 0xff;
		double G = img[i + 1] & 0xff;
		double B = img[i] & 0xff;

		double R_temp = R * .393f + G * .769f + B * .189f;
		double G_temp = R * .349f + G * .686f + B * .168f;
		double B_temp = R * .272f + G * .534f + B * .131f;

		img[i + 2] = R_temp > 255 ? 255 : R_temp;
		img[i + 1] = G_temp > 255 ? 255 : G_temp;
		img[i] = B_temp > 255 ? 255 : B_temp;
	}
	return img;
}

inline vector<char> customFilter(vector<char> img) {
	#pragma omp parallel for num_threads(THREAD)
	for (int i = dataSize - 3; i >= 0; i -= 3){
		double R = img[i + 2] & 0xff;
		double G = img[i + 1] & 0xff;
		double B = img[i] & 0xff;

		double R_temp = R;
		double G_temp = G;
		double B_temp = B;

		const double rate = .2f;
		int standard = 15;		//차이 허용 값

		if (R > 160 && G > 160 && B > 160) {
			standard = 20;
		}

		if (R > B && G > B) {	//B가 제일 작을 때
			R_temp = R + R * rate;
			G_temp = G + G * rate;
		}
		if (R > G && B > G) {	//G가 제일 작을 때
			R_temp = R + R * rate;
			B_temp = B + B * rate;
		}
		if (G > R && B > R) {	//R이 제일 작을 때
			G_temp = G + G * rate;
			B_temp = B + B * rate;
		}
		if (R > B && R > G) {	//R이 제일 클 때
			R_temp = R + R * rate;
			G_temp = G + G * rate;
			B_temp = B;
			if (G_temp < B_temp) B_temp = B + B * rate;
		}
		if (G > R && G > B) {	//G가 제일 클 때
			R_temp = R + R * rate;
			G_temp = G + G * rate;
			B_temp = B;
			if (R_temp < B_temp) B_temp = B + B * rate;
		}
		if (abs(R - G) < standard && abs(G - B) < standard && abs(R - B) < standard) {
			R_temp = R + R * rate;
			G_temp = G + G * rate;
			B_temp = B;
		}
		else if (B > R && B > G && abs(G - B) < standard && abs(R - B) < standard * 2) {
			R_temp = R + R * rate;
			G_temp = G + G * rate;
			B_temp = B;
		}
		else if (B > R && B > G) {//B가 제일 클 때
			R_temp = R;
			G_temp = G;
			B_temp = B + B * rate;
			if (R_temp > G_temp) R_temp = R + R * rate;
			else G_temp = G + G * rate;
		}


		img[i + 2] = R_temp > 255 ? 255 : R_temp;
		img[i + 1] = G_temp > 255 ? 255 : G_temp;
		img[i] = B_temp > 255 ? 255 : B_temp;
	}
	return img;
}

vector<char> readBMP(const string &file)
{
	static constexpr size_t HEADER_SIZE = 54;

	ifstream bmp(file, ios::binary);

	array<char, HEADER_SIZE> header;
	bmp.read(header.data(), header.size());

	fileSize	= *reinterpret_cast<uint32_t *>(&header[ 2]);
	dataOffset	= *reinterpret_cast<uint32_t *>(&header[10]);
	width		= *reinterpret_cast<uint32_t *>(&header[18]);
	height		= *reinterpret_cast<uint32_t *>(&header[22]);
	depth		= *reinterpret_cast<uint16_t *>(&header[28]);

	cout << "fileSize: " << fileSize << endl;
	cout << "dataOffset: " << dataOffset << endl;
	cout << "width: " << width << endl;
	cout << "height: " << height << endl;
	cout << "depth: " << depth << "-bit" << endl;

	vector<char> img(dataOffset - HEADER_SIZE);
	bmp.read(img.data(), img.size());

	dataSize = ((width * 3 + 3) & (~3)) * height;
	img.resize(dataSize);
	bmp.read(img.data(), img.size());

	return img;
}

bool SaveImage(const string& szPathName, const vector<char>& lpBits, int w, int h) {
	ofstream pFile(szPathName, ios_base::binary);
	if (!pFile.is_open()) return false;

	BITMAPINFOHEADER bmih;
	bmih.biSize = sizeof(BITMAPINFOHEADER);
	bmih.biWidth = w;
	bmih.biHeight = h;
	bmih.biPlanes = 1;
	bmih.biBitCount = 24;
	bmih.biCompression = BI_RGB;
	bmih.biSizeImage = w * h * 3;

	BITMAPFILEHEADER bmfh;
	int nBitsOffset = sizeof(BITMAPFILEHEADER) + bmih.biSize;
	LONG lImageSize = bmih.biSizeImage;
	LONG lFileSize = nBitsOffset + lImageSize;
	bmfh.bfType = 'B' + ('M' << 8);
	bmfh.bfOffBits = nBitsOffset;
	bmfh.bfSize = lFileSize;
	bmfh.bfReserved1 = bmfh.bfReserved2 = 0;

	pFile.write((const char*)&bmfh, sizeof(BITMAPFILEHEADER));
	UINT nWrittenFileHeaderSize = pFile.tellp();

	pFile.write((const char*)&bmih, sizeof(BITMAPINFOHEADER));
	UINT nWrittenInfoHeaderSize = pFile.tellp();

	pFile.write(&lpBits[0], lpBits.size());
	UINT nWrittenDIBDataSize = pFile.tellp();
	pFile.close();

	return true;
}

int main() {
	//타이머 선언
	DS_timer timer(2);
	timer.initTimers();

	//변수 선언
	string filename;
	string completeName[4] = { "_grayFilter","_sepiaFilter","_brightFilter","_customFilter" };
	int num;

	//파일 읽기
	printf("변환할 파일 이름 (확장자 제외) : ");
	cin >> filename;
	vector<char> img = readBMP(filename + ".bmp");
	thrust::device_vector<char> d_img(img);
	dim3 dimGrid(((dataSize / 3 + 1) / THREAD_IN_BLOCK) + 1, 1, 1);
	dim3 dimBlock(THREAD_IN_BLOCK, 1, 1);

	//쿠다로 값 복사
	char* raw_ptr = thrust::raw_pointer_cast(d_img.data());

	printf("파일을 모두 읽었습니다. 아래 중 하나를 선택하세요.\n");
	printf("1 : grayFilter\n");
	printf("2 : sepiaFilter\n");
	printf("3 : brightFilter\n");
	printf("4 : customFilter\n");
	scanf("%d", &num);

	//OpenMP Version
	timer.onTimer(0);
	switch (num) {
		case 1:	img = grayFilter(img); break;
		case 2: img = sepiaFilter(img); break;
		case 3: img = brightFilter(img); break;
		case 4: img = customFilter(img); break;
		default: printf("잘못된 값을 입력 받았습니다.\n"); return 0;
	}
	timer.offTimer(0);
	printf("CPU Complete!!\n");

	//CUDA Version
	timer.onTimer(1);
	switch (num) {
		case 1:	grayFilter <<< dimGrid, dimBlock >>>(raw_ptr, dataSize); break;
		case 2: sepiaFilter <<< dimGrid, dimBlock >>>(raw_ptr, dataSize); break;
		case 3: brightFilter << < dimGrid, dimBlock >> >(raw_ptr, dataSize); break;
		case 4: customFilter << < dimGrid, dimBlock >> >(raw_ptr, dataSize); break;
		default: printf("잘못된 값을 입력 받았습니다.\n"); return 0;
	}
	cudaThreadSynchronize();
	timer.offTimer(1);
	printf("GPU Complete!!\n");

	//쿠다에서 값 가져옴
	thrust::copy(d_img.begin(), d_img.end(), img.begin());

	filename += completeName[num - 1];
	filename += ".bmp";
	cout << "저장된 파일 이름 : " << filename << endl;
	SaveImage(filename, img, width, height);

	timer.printTimer();

	return 0;
}