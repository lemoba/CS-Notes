#### MySQL类型

#### 1. int类型

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220303175832167.png" alt="image-20220303175832167" style="zoom:40%;" />

* unsigned/signed: 无符号/有符号

* zerofill：显示的填充0，而不是类型转换

* auto_increment: 自增属性 （推荐使用bigint）

  * **推荐使用bitint**
  * 只会自增不会回退

  * last_insert_id()：获取上次插入的🆔
  * **自增值不会持久化，重启造成回溯**

#### 2. 数字类型

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220303182412692.png" alt="image-20220303182412692" style="zoom:40%;" />

#### 3. 字符串类型

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220303192105639.png" alt="image-20220303192105639" style="zoom:40%;" />

* 字符集：一组符号和编码的集合
* 常见字符集：utf8、gbk、gbk18030、utf8mb4

* **推荐使用utf8mb4**

```sql
 # 显示所有字符集
show charset;

# 更改字符集 表锁
alter table 表名 convert to character set utf8mb4;

# 将字符转换为16进制
select hex('我'); # 0xE68891

# 类型转换
select cast(123 as char(10));

# 我在gbk字符集下的16进制表示
select hex(cast('我' as char(1) charset gbk)); # CED2

# length字节长度 char_length字符长度
select length('我'), char_length('我'); # 3 1

# 转换大写
select upper('ranen'); # RANEN

# 转换小写
select lower('RANEN'); # ranen

# md5加密
select md5('lemoba'); # 8b49a7ce310262a5ec6a9cfcc43d4ff9

# 字符串连接
select concat('lemoba', 'salt'); # lemobasalt

# 指定连接符
select concat_ws('.', 'a', 'b', 'bdd'); # a.b.bdd

# 重复字符串
select repeat('hello', 2);  # hellohello 

# 随机生成1~100间的数字
select floor(1 + rand() * 99);

# 填充指定字符 lpad:左边填充 rpad:右边填充
select lpad('aaa', 10, ','); # ,,,,,,,aaa
```

* **collation：**排序规则

```sql
show collation;
```

##### 枚举类型

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220303202001751.png" alt="image-20220303202001751" style="zoom:40%;" />

#### 4. 日期类型

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220303202210301.png" alt="image-20220303202210301" style="zoom:40%;" />



* **TIMESTAMPS和DATATIME的区别？**
  * timestamps带时区
  * 占用字节数不一样
  * 时间范围不一样

```sql

# now: 获取当前时间
# unix_timestamp:转换成秒
select unix_timestamp(now()); #1646310393
```

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220303203350246.png" alt="image-20220303203350246" style="zoom:40%;" />

* **NOW和SYSDATE的区别?**
  * now是程序执行时的时间
  * sysdate是程序执行到的时间

```sql
select now(), sysdate(), sleep(3), now(), sysdate();

select date_add(now(), interval -1 day);
```

#### 5. JSON类型

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220303204323072.png" alt="image-20220303204323072" style="zoom:30%;" />

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220303210245246.png" alt="image-20220303210245246" style="zoom:30%;" />

> 5.7 版本支持

```sql
select uid, json_extract(data, "$.name") as name from user; 
select uid, data->"$.name" as name from user;
+-----+---------+
| uid | name    |
+-----+---------+
|   1 | "David" |
|   2 | "David" |
+-----+---------+

select uid, json_unquote(json_extract(data, "$.name")) as name from user;
select uid, data->>"$.name" as name from user;
+-----+-------+
| uid | name  |
+-----+-------+
|   1 | David |
|   2 | David |
+-----+-------+

```