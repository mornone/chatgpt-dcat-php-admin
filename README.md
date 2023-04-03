# 

#### 介绍
TODO

#### 生产环境
```shell

$ composer install

$ cp .env.example .env

$ php artisan key:generate

$ php artisan admin:publish

$ php artisan admin:minify

$ php artisan migrate --seed

$ php artisan storage:link

$ composer install --no-dev
```

#### 开发环境
IDE：PHPStorm

## 初始项目
```shell
$ composer install

$ cp .env.example .env

$ php artisan key:generate

$ composer dump-autoload

$ php artisan admin:minify

$ php artisan migrate --seed

$ php artisan storage:link

$ php artisan admin:export-seed --users 仅在后台开发需要导出菜单、权限等数据时执行
```

## 更新项目
```shell
$ composer install

$ composer dump-autoload

$ php artisan admin:minify

$ php artisan migrate:refresh --seed //会清空数据库
```

