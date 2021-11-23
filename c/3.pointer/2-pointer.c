#include <stdio.h>


int main()
{
    int a = 1025;
    int *p;
    p = &a;
    printf("size of integer is %lu\n", sizeof(int));
    printf("address = %p, value = %d\n", p, *p);

    char *p0;
    p0 = (char*)p; //typecasting
    printf("size of integer is %lu bytes\n", sizeof(char));
    printf("address = %d, value = %d\n", p0, *p0);

    return 0;
}