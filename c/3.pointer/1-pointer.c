#include <stdio.h>


int main()
{
    int a = 1025;
    int *p;
    p = &a;
    printf("size of integer is %lu\n", sizeof(int));
    printf("address = %p, value = %d\n", p, *p);
    printf("address = %p, value = %d\n", p + 1, *(p + 1));

    char *p0;
    p0 = (char*)p; //typecasting

    printf("size of integer is %lu bytes\n", sizeof(char));
    printf("address = %p, value = %d\n", p0, *p0);
    printf("address = %p, value = %d\n", p0 + 1, *(p0 + 1));

    void *p1;
    p1 = p;
    printf("address = %p\n", p1);
    return 0;
}