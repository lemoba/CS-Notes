#include <stdio.h>

int main()
{
    int x = 5;
    int* p = &x;
    *p = 6;

    int** q = &p;
    int*** r = &q;

    printf("a address = %p, a value = %d\n", &x, x);
    printf("p address = %p, p value = %d\n", p, *p);
    printf("q address = %p, q value = %d\n", *q, *(*q));
    printf("r address = %p, r value = %d\n", *(*r), *(*(*r)));

    ***r = 10;
    printf("x value = %d\n", x);

    **q = *p + 2;
     printf("x value = %d\n", x);
    return 0;
}