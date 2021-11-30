#include <stdio.h>
#include <stdlib.h>
#include "common.h">

volatile int counter = 0;
int loops;

void *worker(void *arg)
{
	for (int i = 0; i < loops; i++)
	{
		counter++;	
	}
	return NULL;
}

int main(int argc, char *argv[])
{
	if (argc != 2)
	{
		fprintf(stderr, "usage: threads <value>\n");
		exit(1);
	}
	loops = atoi(argv[1]);
	pthread_t p1, p2;

}
