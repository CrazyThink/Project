#include<omp.h>
#include<time.h>
#include<iostream>
#include<algorithm>
#include"DS_timer.h"
#define SIZE (1024*1024*16)		//1073741824 //1024^3 //8GB �޸𸮴� 512*1024*1024�� ����
#define THREAD 8				//������ ����

// ----- ���� ���� ----- //
int RANGE;
float* rand_num = new float[SIZE];	//0~RANGE ���� ��
float** num;	//������ �迭
int* size;		//�� ���� ���� ���� �� �����Ҵ翡 ���
int* count;		//������ ����� ī��Ʈ�� ���

// ----- Ŀ�� �̵� ----- //
inline void gotoxy(int x, int y) {
	COORD pos = { x, y };
	SetConsoleCursorPosition(GetStdHandle(STD_OUTPUT_HANDLE), pos);
}
// ----- ����� ǥ�� ----- //
inline void readPercentage(int now, int max, int line=0) {
	static int temp = -1;
	if (temp != (int)((100.0 / max) * now)) {
		temp = (int)((100.0 / max) * now);
		gotoxy(18, line);
		printf("%3d%%]", temp+1-line);
	}
}
// ----- �� �ε����� �迭 �����Ҵ� ----- //
void makeMemory() {
	//size�迭�� �ִ밪��ŭ �����Ҵ��ϰ� �� ������ ���� ī��Ʈ
	size = new int[RANGE];
	count = new int[RANGE];
	num = new float*[RANGE];
	memset(size, 0, RANGE * sizeof(int));
	memset(count, 0, RANGE * sizeof(int));
	printf("\n���� : 0 ~ %d\n", RANGE);
	for (int i = 0; i < SIZE; i++)
		size[(int)rand_num[i]]++;
	//0~RANGE�� float ������ŭ �����Ҵ�
	for (int i = 0; i < RANGE; i++)
		num[i] = new float[size[i]];
}
// ----- 0~range ������ ���� �� ���� ----- //
void random(int range){
	#pragma omp parallel for num_threads(THREAD)
	for (int i = 0; i < SIZE; i++) {
		rand_num[i] = (rand()*rand()) % (range * 10000) / (float)10000;
		if(omp_get_thread_num()==0) readPercentage(i*THREAD, SIZE);
	}
	RANGE = range;
}
// ----- ���� �б� ----- //
void fileRead() {
	FILE *f;
	if (!(f = fopen("input.txt", "r")))
		printf("������ �����ϴ�.\n");
	//������ �����鼭 �ִ� ã��
	for (int i = 0; i < SIZE; i++) {
		fscanf(f, "%f ", &rand_num[i]);
		if (RANGE < rand_num[i]) RANGE = rand_num[i];
		readPercentage(i, SIZE);
	}
	fclose(f);
	RANGE++;
}
// ----- ���� ���� ----- //
void fileWrite(char* filename, int from = 0, int to = RANGE) {
	FILE *f;
	if (!(f = fopen(filename, "w")))
		printf("������ �� �� �����ϴ�.\n");

	for (int i = from; i < to; i++)
		for (int j = 0; j < size[i]; j++)
			fprintf(f, "%f ", num[i][j]);
	fclose(f);
}

void main(){
	// ----- Ÿ�̸� ���� ----- //
	DS_timer timer(2);
	timer.initTimers();
	srand(time(NULL));

	// ----- ���� �б� ----- //
	printf("������ �д� ��...[   %%]");
	//fileRead();			//���Ͽ��� �������� �޾ƿ�
	random(rand()%991+10);	//�������� ���� ����(10~1000)
	makeMemory();
	int from, to;
	printf("������ ��� �о�Խ��ϴ�.\n");
	printf("�˻� ������ �Է��ϼ���.\n");
	printf("����) 2���� 6���� = 2 6 : ");
	scanf("%d %d", &from, &to);

	system("cls");
	printf("�� �����ϴ� ��1..[   %%]");
	timer.onTimer(0);
	//0~RANGE �迭�� ���� ������ ���� - Serial�� ó��
	for (int i = 0; i < SIZE; i++){
		num[(int)rand_num[i]][count[(int)rand_num[i]]++] = rand_num[i];
		readPercentage(i, SIZE);
	}

	// ----- 0~RANGE �迭 ���� ���� ----- //
	printf("\n�� �����ϴ� ��2..[   %%]");
	// ----- Serial ��� ----- //
	/*
	for (int i = 0; i < RANGE; i ++) {
		std::sort(num[i], num[i] + size[i]);
		readPercentage(i+1, RANGE, 1);
	}
	*/
	
	// ----- OpenMP ��� ----- //
	
	int now = 0;
	#pragma omp parallel for schedule(guided, 1) num_threads(THREAD) 
	for (int i = 0; i < RANGE; i++) {
		std::sort(num[i], num[i] + size[i]);
		#pragma omp critical
		readPercentage(++now, RANGE, 1);
	}
	

	timer.offTimer(0);
	timer.printTimer();

	// ----- ���� ���� ----- //
	int total = 0;
	timer.onTimer(1);
	for (int i = from; i < to; i++)
		total += size[i];
	timer.offTimer(1);
	printf("�˻��� ������ �� : %d��\n", total);
	fileWrite("sort.txt");
	fileWrite("search.txt", from, to);
}