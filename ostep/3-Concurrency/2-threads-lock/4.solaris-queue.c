
// Solaris
typedef struct lock_t { 
    int flag;
    int guard;
    queue_t *q;
} lock_t;

int TestAndSet(int *old_ptr, int new) {
    int old = *old_ptr;
    *old_ptr = new;
    return old;
}

void lock_init(lock_t *m) {
    m->flag = 0;
    m->guard = 0;
    queue_init(m->q);
}

void lock(lock_t *m) {
    while (TestAndSet(m->guard, 1) == 1)
    ; //acquire guard lock by spinning

    if (m->flag == 0) {
        m->flag = 1; // lock is acquired
        m->guard = 0;
    } else {
        queue_add(m->q, gettid());
        setpark();
        m->guard = 0;
        park();
    }
}

void unlock(lock_t *m) {
    while (TestAndSet(m->guard, 1) == 1)
    ;// acquire guard lock by spinning
    if (queue_empty(m->q)) {
        m->flag = 0; // let go of lock; no one wants it
    } else {
        unpark(queue_remove(m->q)); // hold lock(for next thread)
    }
    m->guard = 0;
}
