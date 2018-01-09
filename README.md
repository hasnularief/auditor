# Auditor for Laravel

How to use

Add packages to autoload and add ServiceProvider to config\app.php

```php
Hasnularief\Auditor\AuditorServiceProvider::class,
```

Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish --tag=auditor
```

Auditor will be enabled when `AUDITOR` is `true` in .env

Add AuditorTrait to your model and auditor will audit your model when you write data
```php
use Hasnularief\Auditor\AuditorTrait;

class User extends Model
{
    use AuditorTrait;
```

Auditor using observer to observe your model. If your model already have observer in boot method, you can't use the first method, but you can include observer directly in model.

```php
use Hasnularief\Auditor\AuditorObserver;

class User extends Model
{
    protected static function boot()
    {
        parent::boot();
        $request = request();
        static::observe(new AuditorObserver($request));
    }
```

Finally you can access the result in route your-project.dev/auditor

For other configuration you can see in config/auditor.php
