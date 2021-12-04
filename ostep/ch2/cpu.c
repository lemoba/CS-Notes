#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <assert.h>
#include <sys/time.h>
#include "common.h"
int main(int argc, char *argv[])
{
	if 	(argc != 2) {
		fprintf(stderr, "usage: cput <string>\n");
		exit(1);
	}
	char *str = argv[1];
	while (1) {
		Spin(1);
		printf("%s\n", str);
	}

	return 0;
}


