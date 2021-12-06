### 1. Mysql安装

* [下载地址](https://downloads.mysql.com/archives/community/)(**Linux - Generic (glibc 2.12) (x86, 64-bit), Compressed TAR Archive**)

  ```shell
  #下载
  wget https://downloads.mysql.com/archives/get/p/23/file/mysql-8.0.20-linux-glibc2.12-x86_64.tar.xz
  #解压
  tar -xvf mysql-8.0.20-linux-glibc2.12-x86_64.tar.xz -C /usr/local/
  #链接
  ln -s mysql-8.0.20-linux-glibc2.12-x86_64.tar.xz mysql
  
  groupadd mysql
  useradd -r -g mysql -s /bin/false mysql
  cd mysql
  chmod -R mysql .
  chgrp -R mysql.
  bin/mysqld --initialize --user=mysql
  chmod -R root.
  #bin/mysql_ssl_rsa_setup
  bin/mysqld_safe --user=mysql &
  
  #开机启动
  cp support-files/mysql.server /etc/init.d/mysql.server 
  
  chkconfig --add mysqld.server
  chkconfig --list
  ```

  

### 2. Mysql配置参数

* 从作用域上分为global和session
* 从类型上分为可修改和只读参数
* 用户可在线修改非只读参数
* 只读参数只能通过配置文件修改并重启
* 所有参数的修改都不持久化

| 命令                                                         | 说明                         |
| ------------------------------------------------------------ | ---------------------------- |
| show [global\| \| session] variables [like 'pattern' \| where expr] | 查看变量,可根据like进行过滤 |
| set [global \| session] variables = xxx                      | 修改global或session的参数    |

*note: 修改global参数不影响当前session参数*

**查看mysql有哪些可以的配置文件**

```sql
mysql --help --verbose|grep my.cnf
mysql --help --verbose|less

#依次读取(参数替换,后面参数会替换前面参数)
$/etc/my.cnf /etc/mysql/my.cnf /usr/local/mysql/etc/my.cnf ~/.my.cnf 
```

**查看配置参数**

```sql
show variables;
show variables like 'log_error';
show variables like 'datadir';
```

**设置参数**

```sql
show (global) variables like 'long%query%';
set session long_query_time = 1.5 //会话级别的设置,当前连接生效,断开重连后恢复默认
set global long_query_time = 1.5 //全局级别的设置,当前连接不生效,断开重连后生效
```

#### 命令

```sql
1. 查看每个进程连接参数
use performance_schema;
select * from variables_by_thread  where variable_name = 'long_query_time';
select * from threads where thread_id = 36051 \G
```

```sql
2. 查看每个进程连接列表: show processlist;
```

```sql
3. 查看连接ID: select connection_id();
```

### 3. 用户权限管理

* 创建一个名为ranen密码为root并允许所有id登录

  ```sql
  create user 'ranen'@'%' identified by 'root' (require ssl); //(强制使用ssl)
  ```

* 登录

  ```shel
  mysql -uroot -p
  mysql -h[ip] (-P[port]) -u[username] -p[password] (-S[//tmp/mysql.sock])
  ```

* 删除用户

  ```sql
  drop user 'ranen'@'%';
  ```

* 查看用户权限

  ```sql
  show grants; // 查看当前用户
  show grants for 'ranen'@'%'; //查看其他用户
  ```

* 给用户授权

  ```sql
  grant select, update, insert, delete, create, index on [test.* | .*.] to 'ranen'@'%' (with grant option); // 给ranen用户授予test库的增删改查权限(允许将自己的权限授予其他人)
  ```

* 删除权限

  ```sql
  revoke create, index on test.* from 'ranen'@'%';
  revoke all on test.* from 'ranen'@'%'; // 删除所有权限
  ```

* 修改密码

  ```sql
  alter user 'ranen'@'%' identified by 'ranen';
  ```


* 查看连接状态

  ```sql
  status;
  ```

* 配置ssl

  ```sql
  #shell
  mysql_ssl_rsa_setup
  chown mysql:mysql *.pem
  /etc/init.d/mysql.server restart
  
  show variables like '%ssl%';
  ```
  

* 安装密码插件

  ```sql
  show plugins; /显示所有已安装插件
  INSTALL PLUGIN validate_password SONAME 'validate_password.so';
  
  validate_password_policy = LOW[1]|MEDIUM[2]|STRONG[3]
  #my.conf
  [mysqld]
  plugin-load-add=validate_password.so

* 多版本多实例安装

  ```sql
  #my.conf
  [client]
  user=root
  password=password
  
  [mysql]
  prompt=(\\u@\\h) [\\d]>\\_
  
  [mysqld]
  port=3306
  user=mysql
  datadir=/mmysql/mydata
  log_error=error.log
  socket = /tmp/mysql.sock
  explicit_defaults_for_timestamp=true
  plugin-load-add=validate_password.so
  #skip-grant-tables
  
  [mysqld1]
  server-id=21
  innodb_buffer_pool_size=32M
  port=3357
  datadir=/mmysql/mydata1
  socket=/tmp/mysql.sock1
  
  [mysqld2]
  server-id=22
  innodb_buffer_pool_size=32M
  port=3358
  datadir=/mmysql/mydata2
  socket=/tmp/mysql.sock2
  
  #[mysqld3]
  #server-id=23
  #innodb_buffer_pool_size=32M
  #port=3356
  #datadir=/mmysql/mydata
  #socket=/tmp/mysql.sock
  
  [mysqld80]
  server-id=80
  innodb_buffer_pool_size=32M
  port=3380
  basedir=/usr/local/mysql80/
  datadir=/mmysql/mydata8/
  socket=/tmp/mysql.sock8
  
  
  [mysqld_multi]
  mysqld=/usr/local/mysql/bin/mysqld_safe
  mysqladmin=/usr/local/mysql/bin/mysqladmin
  log=/usr/local/mysql/mysqld_multi.log
  
  
  #shell
  mysqld --initialize --datadir=/mmysql/mydata2
  
  mysqld_multi report
  
  mysqld_multi start 2
  
  netstat -ntl
  
  #查看默认密码
  cat /PATH/error.log | grep temp
  
  #登录mysql
  mysql -S /tmp/mysql.sock1 -p'password';
  
  #修改密码
  set password = 'newPassword';
  
  #设置开机启动
  cp /usr/local/mysql/support-files/mysqld_multi.server /etc/init.d/
  chkconfig --add mysqld_multi.server
  chkconfig --list
  ```

* 忘记密码

  ```sql
  #my.cnf
  skip-grant-tables
  
  update user set authentication_string = password('newPassword') where user='root' and host='localhost';
  flush privieges;
  ```

  
