#include <stdio.h>


int main()
{
    int a = 5;
    int *p;
    // p = &a;
    // printf("a addr = %p\n", &a);
    // printf("p addr = %p\n", p);

    // printf("*p = %d\n", *p); // dereferencing
    // *p = 4;
    // printf("a = %d\n", a);
    printf("%p\n", p);
    printf("a = %lu\n", sizeof(a));
    printf("%p\n", p + 1);
    return 0;
}