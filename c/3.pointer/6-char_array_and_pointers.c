#include <stdio.h>
#include <string.h>

int main()
{
    // char c[5];
    // c[0]= 'J';
    // c[1] = 'O';
    // c[2] = 'H';
    // c[3] = 'N';
    // c[4] = '\0';

    // char c[] = "JOHN";
    char c[] = {'J', 'O', 'H', 'N', '\0'}; 
    printf("%s, len = %lu, size = %lu\n", c, strlen(c), sizeof(c));
    return 0;
}