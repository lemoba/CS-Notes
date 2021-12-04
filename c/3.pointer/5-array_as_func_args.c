#include <stdio.h>

int sumOfElements(int* A, int size)
{
    int sum = 0;
    printf("SOE - Size of A = %lu, size of A[0] = %lu\n", sizeof(A), sizeof(A[0]));
    for (int i = 0; i < size; i++)
    {
        sum += A[i]; // A[i] is *(A+1)
    }
    return sum;
}

void Double(int *A, int size)
{
    for (int i = 0; i < size; i++)
        *(A+i) = 2 * A[i];
}
int main()
{
     int A[] = {1,2,3,4,5};
     int size = sizeof(A) / sizeof(A[0]);
     Double(A, size);
     for (int i = 0; i < size; i++)
        printf("%d\n", *(A+i));
}

int main1()
{
    int A[] = {1,2,3,4,5};
    int size = sizeof(A) / sizeof(A[0]);
    int total = sumOfElements(A, size); // a can be used for &A[0]
    printf("totol = %d\n", total);
    printf("Main - Size of A = %lu, size of A[0] = %lu\n", sizeof(A), sizeof(A[0]));
    return 0;
}