### 锁

#### 1. 什么是MVCC？

> 一致性非锁定读 ，是mysql基于自己的回滚机制为并发场景下的读取操作做一个优化。为**读**控制的多版本

* 基于回滚机制undo log
* 为读操作提供的多版本控制，为了解决并发环境下读操作不需要被锁定的这样一个目的来加快mysql的读取

#### 2. 不同事务隔离下MVCC的表现？

 





| <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220314114854246.png" alt="image-20220314114854246" style="zoom:55%;" /> | <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220314115947817.png" alt="image-20220314115947817" style="zoom:50%;" /> | <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220314121924166.png" alt="image-20220314121924166" style="zoom:50%;" /> |
| ------------------------------------------------------------ | ------------------------------------------------------------ | ------------------------------------------------------------ |









```sql
# for update会加锁🔐
select * from l where a = 8 for update;

# 共享锁
select * from l where a = 8 lock in share mode;

# 查看锁状态信息··········
show engine innodb status\G
```

#### 

