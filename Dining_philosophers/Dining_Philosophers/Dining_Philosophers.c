#include "pthread.h"
#include <stdio.h>
#include <windows.h>
//semaphore를 windows.h에서 사용하기 위해 매크로 선언
#define sem_init(s, p, v) *(s) = CreateSemaphore(NULL, v, LONG_MAX, NULL)
#define sem_wait(s) WaitForSingleObject(*(s), INFINITE)
#define sem_post(s) ReleaseSemaphore(*(s), 1, NULL)
#define sem_destroy(s) CloseHandle(*(s))

#define E 5 //철학자가 밥먹는 횟수
#define P 5 //철학자 수

HANDLE Fork[P];

void *tphilosopher(void *ptr) {
	int i, k = *((int *)ptr);	//철학자 번호를 받아온다.
	for (i = 1; i <= E; i++) {	
		//홀수 번째는 오른쪽 포크를 먼저 사용하고, 짝수 번째는 왼쪽 포크를 먼저 사용한다.
		//Fork[k] == 왼쪽 포크, Fork[(k + 1) % P] == 오른쪽 포크
		printf("%*c%d : Hungry \n", k * 11, ' ', k + 1);
		 (k % 2) ? sem_wait(&Fork[k]) : sem_wait(&Fork[(k + 1) % P]);
		!(k % 2) ? sem_wait(&Fork[k]) : sem_wait(&Fork[(k + 1) % P]);

		//Hungry 후에 양쪽 젓가락을 잡았다면 1~3초간 Eat을 한다.
		printf("%*c%d : Eat(%d)\n", k * 11, ' ', k + 1, i);
		Sleep((rand() % 3 + 1) * 1000);
		sem_post(&Fork[k]);					//왼쪽 포크를 놓는다.
		sem_post(&Fork[(k + 1) % P]);		//오른쪽 포크를 놓는다.
		
		//Eat 후에는 바로 1~3초간 Think를 한다.
		printf("%*c%d : Think\n", k * 11, ' ', k + 1);
		Sleep((rand() % 3 + 1) * 1000);
	}
	pthread_exit(0);			//밥을 E횟수만큼 먹었다면 스레드를 종료함
	return "";
}

void main() {
	int i, targ[P];
	pthread_t thread[P];
	srand((unsigned)time(NULL)); 
		//semaphore를 초기화하고, 각 philosopher에 해당하는 스레드 생성
	for (i = 0; i < P; i++) {
		sem_init(&Fork[i], 0, 1);
		targ[i] = i;
		pthread_create(&thread[i], NULL, &tphilosopher, (void *)&targ[i]);
	}
	for (i = 0; i < P; i++) pthread_join(thread[i], NULL);
	for (i = 0; i < P; i++) sem_destroy(&Fork[i]);
}