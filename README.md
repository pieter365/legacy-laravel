# legacy-laravel
Runs legacy code inside a Laravel project for example Codeigniter

## Why?
To assist to run a legacy project inside laraval

## Installation

1 - Create a new laravel project

```shell
composer create-project --prefer-dist laravel/laravel {projectName} "9.0.*"
```

2 - Require via Composer

```shell
composer create-project legacy-laravel
```

3 - Get configuration file 
```shell
php artisan vendor:publish
```

4 - Put your legacy project inside `./legacy` folder.

## Details

Add the following to your routes/web.php to make sure that the routing works correct for you legacy setup

```php
Route::middleware('legacy')
    ->any('/{path}', ['as' => 'legacy', 'uses' => '\Legacy\Controller@index'])
    ->where('path', '.*');
```
