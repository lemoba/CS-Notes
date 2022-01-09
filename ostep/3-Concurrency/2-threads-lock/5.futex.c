
void mutex_lock(int *mutex) {
    int v;
    if (atomic_bit_test_set(mutex, 31) == 0) {
        return;
    }
    automic_increment(mutex);
    while (1) {
        if (atomic_bit_test_set(mutex, 31) == 0) {
            atomic_decrement(mutex);
            return;
        }

        v = *mutex;
        if (v >= 0) {
            continue;
        }
        futex_wait(mutex, v);
    }
}

void mutex_unlock(int *mutex) {
    if (atomic_add_zero(mutex, 0x80000000)) {
        return;
    }
    futex_wakeup(mutex);
}
