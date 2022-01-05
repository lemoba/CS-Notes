#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <assert.h>
#include <sys/time.h>
#include "common.h"
int main(int argc, char *argv[])
{
	if (argc != 2) { 
	fprintf(stderr, "usage: mem <value>\n"); 
	exit(1); 
    } 
	int *p = malloc(sizeof(int));
	assert(p != NULL);
	printf("(%d) memeory address of p:$%p\n", getpid(), p);
	*p = atoi(argv[1]);
	while (1) {
		Spin(1);
		*p = *p + 1;
		printf("(%d) p: %d\n", getpid(), *p);
	}
	return 0;
}


