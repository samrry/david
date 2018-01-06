## 一个快速开发API的框架


## Feature
 - 简洁的架构
 - 已经实现了 MVC
 - 自定义每一部分组件

## Requirement

1. PHP >= 5.4
2. **[composer](https://getcomposer.org/)**


## Installation

```shell
composer create-project davidnineroc/david
```

## Usage
* 你几乎不用配置什么
* 服务器配置
	* Aapche
		* 请务必启用`mod_rewrite`模块，让服务器能够支持`.htaccess`文件的解析
	* Nginx
>
>  
>     location / {
>         try_files $uri $uri/ /index.php?$query_string;
>     }
>

* 如果你使用数据库或者选项，请配置 `config` 目录下的配置文件
* 之后访问根目录下的`public/index.php`便可以访问到如下图

## Documentation

## License

MIT