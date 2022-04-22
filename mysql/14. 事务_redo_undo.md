### 事务

> 事务指的是满足 ACID 特性的一组操作，可以通过 Commit 提交一个事务，也可以使用 Rollback 进行回滚。

#### 1、事务的四个特性(ACID)

##### ① 原子性(Atomicity)

> 事务被视为不可分割的最小单元，事务的所有操作要么全部提交成功，要么全部失败回滚。

* redo

##### ② 一致性(Consistency)

> 数据库在事务执行前后都保持一致性状态。在一致性状态下，所有事务对同一个数据的读取结果都是相同的。

* undo

##### ③ 隔离性(Isolation)

> 一个事务所做的修改在最终提交以前，对其它事务是不可见的。

* lock

##### ④ 持久性(Durable)

> 一旦事务提交，则其所做的修改将会永远保存到数据库中。即使系统发生崩溃，事务执行的结果也不能丢失。

* redo & undo

#### 2. 基本操作

> 不使用begin，然后rollback，不起作用，因为MySQL默认是自动提交(autocommit) 

```sql
show variables like 'autocommit';
+---------------+-------+
| Variable_name | Value |
+---------------+-------+
| autocommit    | ON    |
+---------------+-------+
```



* 开启事务

```sql
# 1
begin;

# 2
start transaction;
```

* 设置回滚保存点

```sql
savepoint s1;
```

* 提交事务

```sql
commit;
```

* 回滚事务

```sql
# 1
rollback;

# 2
rollback to s1; #回滚到s1，事务还未完成，需要commit提交
```

#### 3. 分布式事务

> 在分布式环境下运行的扁平事务
>
> 每个事务都要符合ACID

* 例子

  持卡人从工行银行的储蓄卡转账1000元到建设银行的账户里。

#### 4. 事务隔离级别

> 解决脏读、幻读、不可重复读

* **脏读：一个事务读到了另一个未提交事务修改过的数据**
* **不可重复读：一个事务修改了另一个未提交事务读取的数据**
* **幻读：一个事务先根据某些搜索条件查询出一些记录，在该事务未提交时，另一个事务写入了一些符合那些搜索条件的记录**

```sql
show variables like 'tx_isolation';
+---------------+-----------------+
| Variable_name | Value           |
+---------------+-----------------+
| tx_isolation  | REPEATABLE-READ |
+---------------+-----------------+
```

##### ① 未提交读（READ UNCOMMITTED）

> 事务中的修改，即使没有提交，对其它事务也是可见的。

##### ② 提交读（READ COMMITTED）

> 一个事务只能读取已经提交的事务所做的修改。换句话说，一个事务所做的修改在提交之前对其它事务是不可见的。

##### ③ 可重复读（REPEATABLE READ）

> 保证在同一个事务中多次读取同一数据的结果是一样的。

##### ④ 可串行化（SERIALIZABLE）

> 强制事务串行执行，这样多个事务互不干扰，不会出现并发一致性问题。
>
> 该隔离级别需要加锁实现，因为要使用加锁机制保证同一时间只有一个事务执行，也就是保证事务串行执行。



<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220314094306012.png" alt="image-20220314094306012" style="zoom:40%;" />

#### 5. REDO

> 记录对页所做的修改

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220313175531868.png" alt="image-20220313175531868" style="zoom:40%;" />

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220314105624271.png" alt="image-20220314105624271" style="zoom:35%;" />

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220314110901269.png" alt="image-20220314110901269" style="zoom:35%;" />

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220314111804769.png" alt="image-20220314111804769" style="zoom:30%;" />

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220314112556895.png" alt="image-20220314112556895" style="zoom:35%;" />

```sql
show variables like 'innodb%log%';
show variables like 'innodb%log%';
```



* innodb_flush_log_at_trx_commit

  * = 0：写入缓存不刷新到磁盘中

  * = 1：innodb真正意义上达到持久性的标准，当一个事务进行提交了即使master thread没有进行刷新，redo log buffer使用率没有大于1/2，也会将重做日志持久化到硬盘中去
  * = 2：写入到操作系统缓存

* redo和binlog的区别
  * binlog是逻辑日志，就是事务所提交的顺序，值在commit的时候记录
  * redo是物理日志，记录的page_no和space，每次操作都会记录

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220314114347193.png" alt="image-20220314114347193" style="zoom:30%;" />