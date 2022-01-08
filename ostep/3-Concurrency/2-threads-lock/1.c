#include <stdio.h>

typedef struct lock_t { int flag; } lock_t;

// 版本一
// void init(lock_t *mutex) {
//     // 0 -> lock is available, 1 -> held
//     mutex->flag = 0;
// }

// void lock(lock_t *mutex) {
//     while (mutex->flag == 1); // spin-wait -自旋
//     mutex->flag = 1;
// }

// void unlock(lock_t *mutex) {
//     mutex->flag = 0;
// }

// 比较并交换
int CompareAndSwap(int *ptr, int expected, int new) {
   int actual = *ptr;
   if (actual == expected) {
       *ptr = new;
   } 
   return actual;
}
// 版本二
int TestAndSet(int *old_ptr, int new) {
    int old = *old_ptr;
    *old_ptr = new;
    return old;
}

void init(lock_t *lock) {
    lock->flag = 0;
}

void lock(lock_t *lock) {
    while (TestAndSet(&lock->flag, 1) == 1); // spin-wait
}

void unlock(lock_t *lock) {
    lock->flag = 0;
}




// 链接的加载和条件式存储指令

int LoadLinked(int *ptr) {
    return *ptr;
}

// int StoreConditional(int *ptr, int value) {
 
// }

