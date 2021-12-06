**查看mysql连接进程**

```sql
select * from variables_by_thread where variable_name = 'long_query_time';
select * from threads where thread_id = 41 limit 1\G;
select * from variables_by_thread as vb, threads as t where vb.thread_id = t.thread_id;
```

**创建/删除/更改用户**

```sql
create user 'username'@'%' identified by 'password';
drop user 'username'@'%';
alter user 'username'@'%' identified by 'password';
```

**查看用户权限**

```sql
show grants;
show grants for 'username'@'';
```

**授予/删除用户权限**

```sql
grant select, update, insert, delete on gochat.* to 'username'@'%' (with grant option [授予自身权限给他人]);
grant create,index on gochat.* to 'username'@'%';

revoke select, update, insert, delete on gochat.* to 'username'@'%';
revoke create,index on gochat.* to 'username'@'%';
```

![image-20211023164020054](/Users/lemoba/Library/Application Support/typora-user-images/image-20211023164020054.png)

**mysql 用户权限记录表**

```sql
show tables like 'user';
show tables like 'db';
show tables like 'tables_priv';
show tables like 'columns_priv';
```

