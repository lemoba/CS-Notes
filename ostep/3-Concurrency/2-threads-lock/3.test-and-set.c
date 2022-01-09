
typedef struct lock_t { int flag; } lock_t;

void init(lock_t *lock) {
    lock->flag = 0;
}

int TestAndSet(int *old_ptr, int new) {
    int old = *old_ptr;
    *old_ptr = new;
    return old;
}

void lock(lock_t *lock) {
    while (TestAndSet(&lock->flag, 1) == 1) yield(); // give up the cpu
}

void unlock(lock_t *lock) {
    lock->flag = 0;
}