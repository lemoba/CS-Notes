### 一、存储过程

> [mysql文档](https://dev.mysql.com/doc/refman/5.7/en/)


#### 1. 临时表

* 临时表是基于会话的
* 数据存在于datadir下面的ibtmp1
* 表结构定义文件在tmp/目录下 #sql1b1d_5e_0.frm

```sql

```

#### 2. 存储过程

> 性能拉胯

| <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220307205636961.png" alt="image-20220307205636961" style="zoom:33%;" /> | <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220309144305850.png" alt="image-20220309144305850" style="zoom:33%;" /> | <img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220309144335545.png" alt="image-20220309144335545" style="zoom:33%;" /> |
| ------------------------------------------------------------ | ------------------------------------------------------------ | ------------------------------------------------------------ |

##### 1) 阶乘的存储过程

* 存储过程

```sql
DROP TABLE IF EXISTS tbl_proc_test;
CREATE TEMPORARY TABLE tbl_proc_test (num BIGINT);

DROP PROCEDURE IF EXISTS pro_test1;
DELIMITER //
CREATE PROCEDURE pro_test1
(IN total INT, OUT res INT)

BEGIN
	DECLARE i INT;
	SET i = 1;
	SET res = 1;
	IF total <= 0 THEN
		SET total = 0;
	END IF;
	
	WHILE i < total DO
		SET res = res * i;
		INSERT INTO tbl_proc_test(num) VALUES (res);
		SET i = i + 1;
	END WHILE;
END; //
delimiter ;

CALL pro_test1(10, @a);
SELECT @a;
SELECT * FROM tbl_proc_test;
```

* 函数

```sql
DROP FUNCTION IF EXISTS func_test;

DELIMITER //
CREATE FUNCTION func_test(total INT)
RETURNS BIGINT

BEGIN
	DECLARE i INT;
    DECLARE res INT;
	SET i = 1;
	SET res = 1;
	IF total <= 0 THEN
		SET total = 0;
	END IF;
	
	WHILE i < total DO
		SET res = res * i;
		SET i = i + 1;
	END WHILE;
    RETURN res;
END; //
delimiter ;

SELECT func_test(10);
```

### 二、触发器

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220309154019161.png" alt="image-20220309154019161" style="zoom:40%;" />

![image-20220309154148525](/Users/lemoba/Library/Application Support/typora-user-images/image-20220309154148525.png)

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220309154529983.png" alt="image-20220309154529983" style="zoom:50%;" />

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220309154852428.png" alt="image-20220309154852428" style="zoom:50%;" />

<img src="/Users/lemoba/Library/Application Support/typora-user-images/image-20220309154915997.png" alt="image-20220309154915997" style="zoom:50%;" />
