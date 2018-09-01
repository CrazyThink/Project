#include "pthread.h"
#include <stdio.h>
#include <windows.h>
//semaphore�� windows.h���� ����ϱ� ���� ��ũ�� ����
#define sem_init(s, p, v) *(s) = CreateSemaphore(NULL, v, LONG_MAX, NULL)
#define sem_wait(s) WaitForSingleObject(*(s), INFINITE)
#define sem_post(s) ReleaseSemaphore(*(s), 1, NULL)
#define sem_destroy(s) CloseHandle(*(s))

#define E 5 //ö���ڰ� ��Դ� Ƚ��
#define P 5 //ö���� ��

HANDLE Fork[P];

void *tphilosopher(void *ptr) {
	int i, k = *((int *)ptr);	//ö���� ��ȣ�� �޾ƿ´�.
	for (i = 1; i <= E; i++) {	
		//Ȧ�� ��°�� ������ ��ũ�� ���� ����ϰ�, ¦�� ��°�� ���� ��ũ�� ���� ����Ѵ�.
		//Fork[k] == ���� ��ũ, Fork[(k + 1) % P] == ������ ��ũ
		printf("%*c%d : Hungry \n", k * 11, ' ', k + 1);
		 (k % 2) ? sem_wait(&Fork[k]) : sem_wait(&Fork[(k + 1) % P]);
		!(k % 2) ? sem_wait(&Fork[k]) : sem_wait(&Fork[(k + 1) % P]);

		//Hungry �Ŀ� ���� �������� ��Ҵٸ� 1~3�ʰ� Eat�� �Ѵ�.
		printf("%*c%d : Eat(%d)\n", k * 11, ' ', k + 1, i);
		Sleep((rand() % 3 + 1) * 1000);
		sem_post(&Fork[k]);					//���� ��ũ�� ���´�.
		sem_post(&Fork[(k + 1) % P]);		//������ ��ũ�� ���´�.
		
		//Eat �Ŀ��� �ٷ� 1~3�ʰ� Think�� �Ѵ�.
		printf("%*c%d : Think\n", k * 11, ' ', k + 1);
		Sleep((rand() % 3 + 1) * 1000);
	}
	pthread_exit(0);			//���� EȽ����ŭ �Ծ��ٸ� �����带 ������
	return "";
}

void main() {
	int i, targ[P];
	pthread_t thread[P];
	srand((unsigned)time(NULL)); 
		//semaphore�� �ʱ�ȭ�ϰ�, �� philosopher�� �ش��ϴ� ������ ����
	for (i = 0; i < P; i++) {
		sem_init(&Fork[i], 0, 1);
		targ[i] = i;
		pthread_create(&thread[i], NULL, &tphilosopher, (void *)&targ[i]);
	}
	for (i = 0; i < P; i++) pthread_join(thread[i], NULL);
	for (i = 0; i < P; i++) sem_destroy(&Fork[i]);
}