#include <stdio.h>
#include <unistd.h>
#include <assert.h>
#include <fcntl.h>
#include <sys/types.h>

int main(int argc, char *argv[])
{
    int fd = open("./file.txt", O_WRONLY | O_CREAT | O_APPEND, S_IRWXU);
    assert(fd > -1);
    int rc = write(fd, "hello world111\n", 13);
    assert(rc == 13);
    close(fd);
    return 0;
}