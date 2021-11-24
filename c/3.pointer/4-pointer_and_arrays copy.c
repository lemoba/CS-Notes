#include <stdio.h>

int main()
{
    int A[] = {6,1,3,2,5};

    printf("%p\n", A);
    printf("%p\n", &A[0]);
    printf("%d\n", A[0]);
    printf("%d\n", *A);

    for (int i = 0; i < 5; i++)
    {
        printf("address = %p\n", &A[i]);
        printf("address = %p\n", A + i);
        printf("value = %d\n", A[i]);
        printf("value = %d\n", *(A+i));

    }
    return 0;
}