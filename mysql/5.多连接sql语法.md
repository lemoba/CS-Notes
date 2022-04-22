#### 多连接SQL语法

##### 1. 子查询和join的区别

```sql
# 子查询
SELECT * FROM t1 WHERE a IN (SELECT a FROM t2);  # 返回t1中的字段并且去重

# 改写join
SELECT DISTINCT t1.* FROM t1 JOIN t2 ON t1.a = t2.a

SELECT * FROM t1 JOIN t2 ON t1.a = t2.a; # 返回两表中的所有字段
```

##### 2. SQL关联语句

* **在emp数据库中,将employees表和titles根据emp_no关联取出最新的title**

> 在一对多的关系下取出一对一的数据

```sql
SELECT 
    t.emp_no, t.title
FROM
    employees e,
    (SELECT 
        emp_no, title
    FROM
        titles
    WHERE
        (emp_no , to_date) IN (SELECT 
                emp_no, MAX(to_date)
            FROM
                titles
            GROUP BY emp_no)) t
WHERE
    e.emp_no = t.emp_no;
```

- **INNER JOIN**：如果表中有至少一个匹配，则返回行 （INNER JOIN 与 JOIN 是相同的）
- **LEFT JOIN**：即使右表中没有匹配，也从左表返回所有的行。如果右表中没有匹配，则结果为 NULL。
- **RIGHT JOIN**：即使左表中没有匹配，也从右表返回所有的行。如果左表中没有匹配，则结果为 NULL。
- **FULL JOIN**：只要其中一个表中存在匹配，则返回整行

| <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220307093912872.png" alt="image-20220307093912872" style="zoom:50%;" /> | <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220307094036055.png" alt="image-20220307094036055" style="zoom:50%;" /> | <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220307094052647.png" alt="image-20220307094052647" style="zoom:50%;" /> | <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220307094107503.png" alt="image-20220307094107503" style="zoom:50%;" /> |
| ------------------------------------------------------------ | ------------------------------------------------------------ | ------------------------------------------------------------ | ------------------------------------------------------------ |

* **在dbt3数据库, customer、orders、nation表中，返回客户是加拿大但是没有在1997年内没有生产订单的用户**

```sql
SELECT 
    *
FROM
    customer c
        LEFT JOIN
    (SELECT 
        o.o_custkey,
        o.o_orderDATE,
        o.o_orderkey
    FROM
        orders o
    WHERE
        o_orderDATE >= '1997-01-01'
            AND o_orderDATE < '1998-01-01') o ON o.o_custkey = c.c_custkey
        LEFT JOIN
    nation n ON c_nationkey = n.n_nationkey
WHERE
    o.o_orderkey IS NULL AND n.n_name = 'CANADA';
```

* **自定义行号**

```sql
 # 1 更快
 SELECT 
    @a:=@a + 1 row_num,
    emp_no,
    birth_date,
    first_name,
    last_name,
    gender,
    hire_date
FROM
    employees,
    (SELECT @a:=0) a
LIMIT 10;

# 2 效率低
SELECT 
    *,
    (SELECT 
            COUNT(1)
        FROM
            employees e2
        WHERE
            e2.emp_no <= e1.emp_no) AS row_num
FROM
    employees e1
ORDER BY emp_no
LIMIT 10;
    
+--------+------------+------------+-----------+--------+------------+---------+
| emp_no | birth_date | first_name | last_name | gender | hire_date  | row_num |
+--------+------------+------------+-----------+--------+------------+---------+
|  10001 | 1953-09-02 | Georgi     | Facello   | M      | 1986-06-26 |       1 |
|  10002 | 1964-06-02 | Bezalel    | Simmel    | F      | 1985-11-21 |       2 |
|  10003 | 1959-12-03 | Parto      | Bamford   | M      | 1986-08-28 |       3 |
|  10004 | 1954-05-01 | Chirstian  | Koblick   | M      | 1986-12-01 |       4 |
|  10005 | 1955-01-21 | Kyoichi    | Maliniak  | M      | 1989-09-12 |       5 |
|  10006 | 1953-04-20 | Anneke     | Preusig   | F      | 1989-06-02 |       6 |
|  10007 | 1957-05-23 | Tzvetan    | Zielinski | F      | 1989-02-10 |       7 |
|  10008 | 1958-02-19 | Saniya     | Kalloufi  | M      | 1994-09-15 |       8 |
|  10009 | 1952-04-19 | Sumant     | Peac      | F      | 1985-02-18 |       9 |
|  10010 | 1963-06-01 | Duangkaew  | Piveteau  | F      | 1989-08-24 |      10 |
+--------+------------+------------+-----------+--------+------------+---------+
```

* **在emp数据库中, 将departments、salaries 、dept_emp  关联取出最新数据**

```sql
# 1 子查询 效率低
SELECT 
    emp_no, salary
FROM
    salaries
WHERE
    (emp_no, from_date, to_date) IN (SELECT 
            emp_no, MAX(from_date), MAX(to_date)
        FROM
            salaries
        GROUP BY emp_no)
LIMIT 10;

+--------+--------+
| emp_no | salary |
+--------+--------+
|  10001 |  88958 |
|  10002 |  72527 |
|  10003 |  43311 |
|  10004 |  74057 |
|  10005 |  94692 |
|  10006 |  59755 |
|  10007 |  88070 |
|  10008 |  52668 |
|  10009 |  94409 |
|  10010 |  80324 |
+--------+--------+

# 2 使用GROUP_CONCAT一次取出数据
SELECT 
    emp_no,
    GROUP_CONCAT(salary
        ORDER BY to_date DESC , from_date DESC) AS salary
FROM
    salaries
GROUP BY emp_no
LIMIT 10;

+--------+-------------------------------------------------------------------------------------------------------------+
| emp_no | salary                                                                                                      |
+--------+-------------------------------------------------------------------------------------------------------------+
|  10001 | 88958,85097,85112,84917,81097,81025,80013,76884,75994,75286,74333,71046,66961,66596,66074,62102,60117       |
|  10002 | 72527,71963,69366,67534,65909,65828                                                                         |
|  10003 | 43311,43699,43478,43636,43466,43616,40006                                                                   |
|  10004 | 74057,70698,69722,67096,64340,62566,60770,58326,54693,52119,50594,48271,46065,42542,42283,40054             |
|  10005 | 94692,91453,90531,90392,89724,88063,88448,86050,85076,85572,83735,82621,78228                               |
|  10006 | 59755,60098,58299,56032,53747,52255,47917,47518,45844,42629,42085,40000                                     |
|  10007 | 88070,84456,80083,79513,75582,73362,70220,68833,64563,63208,63475,62745,60740,56724                         |
|  10008 | 52668,48584,46671                                                                                           |
|  10009 | 94409,94443,93507,90668,89324,85875,82507,80944,78335,76518,74612,71434,70889,69042,66302,64780,64604,60929 |
|  10010 | 80324,79580,78194,75405,74347,72488                                                                         |
+--------+-------------------------------------------------------------------------------------------------------------+

# 3 使用SUBSTRING_INDEX函数根据','取第一个数据, 并使用CAST做类型转换
SELECT 
    emp_no,
    CAST(SUBSTRING_INDEX(GROUP_CONCAT(salary
                    ORDER BY to_date DESC , from_date DESC),
                ',',
                1)
        AS UNSIGNED) AS salary
FROM
    salaries
GROUP BY emp_no
LIMIT 10;

+--------+--------+
| emp_no | salary |
+--------+--------+
|  10001 | 88958  |
|  10002 | 72527  |
|  10003 | 43311  |
|  10004 | 74057  |
|  10005 | 94692  |
|  10006 | 59755  |
|  10007 | 88070  |
|  10008 | 52668  |
|  10009 | 94409  |
|  10010 | 80324  |
+--------+--------+

```

##### 6. **Prepare SQL语法**

* 减少开销，会缓存
* 防范SQL注入
* 动态搜索条件

```sql
SET @s = 'SELECT * FROM employees WHERE emp_no = ?';
SET @a = 10001;
PREPARE stmt FROM @s;
EXECUTE stmt USING @a;
DEALLOCATE PREPARE stmt;

# sql注入 or 1 = 1
SELECT * FROM employees WHERE emp_no = 10010 or 1 = 1 limit 10;

# 动态查询, 根据不同的条件
SET @s = 'SELECT * FROM employees WHERE 1 = 1';
SET @s = CONCAT(@s, ' AND gender = "m"');
SET @s = CONCAT(@s, ' AND birth_date >= "1960-01-01"');
SET @s = CONCAT(@s, ' ORDER BY emp_no LIMIT ?, ?');
SET @page_no = 0;
SET @page_count = 10;
PREPARE stmt FROM @s;
EXECUTE stmt USING @page_no, @page_count;
DEALLOCATE PREPARE stmt;
```

