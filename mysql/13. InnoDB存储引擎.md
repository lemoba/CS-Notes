### InnoDB存储引擎

#### 1.InnoDB存储引擎文件

* 表空间文件

  * 独立表空间文件
  * 全局表空间文件

  * undo表空间文件

* 重做日志文件

  * 物理逻辑日志
  * 没有Oracle的归档重做日志

#### 2. 表空间页

* **页**：是最小的I/O操作单位

  * 默认每个页16K
  * --innodb_page_size

* **区**：是最小的空间申请单位(1M * 4)

* **压缩表**

  * 基于页的压缩

  * 每个表的页大小可以不同

  * 页压缩：

    ```sql
    ALTER TABLE 表名 ENGINE=InnoDB ROW_FORMAT=compressed,KEY_BLOCK_SIZE=8 # 压缩为8K
    ```

    

