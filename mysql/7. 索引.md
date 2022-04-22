#### 1. 索引

> 索引是一个特殊的数据结构，为了快速检索数据

##### 1) 基本操作

> 线上操作，会有主从延迟

```sql
# 添加索引
alter table x add index idx(a);

# 删除索引
alter table x drop index idx;
```

##### 2) 索引组织表(IOT)

> 对于主键索引，叶子结点存放一整行所有的数据；
>
> 对于辅助索引，叶子结点键值和主键值；
>
> 辅助索引和主键索引的非叶子结点，不存储数据，只存键值和指针，指针大小为6 byte。

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220309174547959.png" alt="image-20220309174547959" style="zoom:30%;" />

##### 3) 堆表

> MyISAM
>
> 堆：无序数据的集合

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220309174610200.png" alt="image-20220309174610200" style="zoom:30%;" />

##### 4) 堆表和索引组织表优缺点

* 堆表
  * 优点：查询速度比较快：不管是主键索引还是聚集索引，查找速率相同，不存在回表操作。
  * 缺点：对于主键范围查询性能较差

##### 5) 填充因子

> 当一个页插满的话，会给这个页留出一部分空间给其他记录更新
>
> 为页大小的1/16

```sql
show variables like 'innodb%fill%';

+--------------------+-------+
| Variable_name      | Value |
+--------------------+-------+
| innodb_fill_factor | 100   |
+--------------------+-------+
```

##### 6) 索引创建原则

###### **① 获取TABLE_ROWS**

```SQL
select * from tables where table_schema =
'dbt3' and table_name = 'customer' limit 3\G

*************************** 1. row ***************************
  TABLE_CATALOG: def
   TABLE_SCHEMA: dbt3
     TABLE_NAME: customer
     TABLE_TYPE: BASE TABLE
         ENGINE: InnoDB
        VERSION: 10
     ROW_FORMAT: Dynamic
     TABLE_ROWS: 147940
 AVG_ROW_LENGTH: 202
    DATA_LENGTH: 29949952
MAX_DATA_LENGTH: 0
   INDEX_LENGTH: 3686400
      DATA_FREE: 0
 AUTO_INCREMENT: NULL
    CREATE_TIME: 2022-03-03 17:31:35
    UPDATE_TIME: NULL
     CHECK_TIME: NULL
TABLE_COLLATION: latin1_swedish_ci
       CHECKSUM: NULL
 CREATE_OPTIONS: 
  TABLE_COMMENT: 
```

###### **② 获取CARDINALITY的值**

```sql
select * from statistics where table_schema = 'dbt3' limit 3\G

*************************** 1. row ***************************
TABLE_CATALOG: def
 TABLE_SCHEMA: dbt3
   TABLE_NAME: customer
   NON_UNIQUE: 0
 INDEX_SCHEMA: dbt3
   INDEX_NAME: PRIMARY
 SEQ_IN_INDEX: 1
  COLUMN_NAME: c_custkey
    COLLATION: A
  CARDINALITY: 147940
     SUB_PART: NULL
       PACKED: NULL
     NULLABLE: 
   INDEX_TYPE: BTREE
      COMMENT: 
INDEX_COMMENT: 
```



* 选择的列是高选择度的列 (CARDINALITY / TABLE_ROWS = 1, < 0.1(地选择度))

##### 7) 复合索引

> 选择多个列构成索引

##### 8) 索引覆盖

> 查询的列在非聚集索引的联合索引中，不需要回表

##### 9) 函索索引

> 在函数计算的虚拟列上添加索引
>
> 虚拟列不存在，不占用空间
>
> 索引真实存在

#### 2. SQL优化

> 通过慢查询日志来观察

```shell
mysqldumpslow slow.log | grep less #格式化SQL语句
```

* **当线上数据量很大时，可以通过采样来分析**

```shell
tail -n 100000 slow.log > analytics.log

mysqldumpslow analytics
```

* **接着清除日志**

```shell
$> mv slow.log 2021-02-02_slow.log # 备份
mysql> flush slow logs: # 新生成日志
```

#### 3. information_schema/sys

* [information_schema] STATISTICS 表可以查看没有主键的表
* [sys]schema_unused_indexes 可以查看没有被使用过的索引
* [sys]schema_redundant_indexes 可以查看冗余索引

#### 4. 索引倾斜

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220312090551305.png" alt="image-20220312090551305" style="zoom:30%;" />
