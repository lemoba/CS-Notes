#include <stdio.h>

typedef struct lock_t { 
    int ticket;
    int turn;
} lock_t;

int FetchAndAdd(int *ptr) {
    int old = *ptr;
    *ptr = old++;
    return old;
}

void lock_init(lock_t *lock) {
    lock->ticket = 0;
    lock->turn = 0;
}

void lock(lock_t *lock) {
    int myturn = FetchAndAdd(&lock->ticket);
    while (lock->turn != myturn); // spin
}

void unlock(lock_t *lock) {
    FetchAndAdd(&lock->turn);
} 