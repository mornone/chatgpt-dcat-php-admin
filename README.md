# 

#### 介绍
TODO

#### 开发环境
IDE：PHPStorm
PHP：8.1+
CAHAE: 默认file,支持更换其他缓存驱动

## 安装项目
```shell
$ composer install

$ cp .env.example .env

$ php artisan key:generate

$ php artisan storage:link

$ composer dump-autoload -o

$ php artisan migrate:refresh --seed //会清空改配置下的数据库进行填充数据
```
