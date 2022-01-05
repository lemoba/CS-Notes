#include <stdio.h>

void Increment(int *a)
{
    (*a)++;
}

int main()
{
    int a = 10;
    Increment(&a);
    printf("a = %d\n", a);
    return 0;
}