# Activity Log For Laravel 5

- [Installation](#installation)
    - [Composer](#composer)
    - [Service Provider](#service-provider)
    - [Migration File](#migration-file)
    - [ActivityLogable Contract](#activitylogable-contract)

## Installation

This package is very easy to set up. There are only couple of steps.

### Composer

    composer require codersvn/laravel_activity_log

### Service Provider

Add the package to your application service providers in `config/app.php` file.

```php
'providers' => [
    
    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
    Illuminate\Auth\AuthServiceProvider::class,
    ...
    
    /**
     * Third Party Service Providers...
     */
    Vicoders\ActivityLog\Providers\ActivityLogServiceProvider::class,

],
```

### Migration File

Publish the package config file and migrations to your application. Run these commands inside your terminal.

    php artisan vendor:publish --provider="Vicoders\ActivityLog\Providers\ActivityLogServiceProvider" --tag=migrations

And also run migrations.

    php artisan migrate

> This uses the default users table which is in Laravel. You should already have the migration file for the users table available and migrated.

### ActivityLogable Contract

```php
<?php

namespace VCComponent\Laravel\User\Events;

use Illuminate\Queue\SerializesModels;
use Vicoders\ActivityLog\Contracts\ActivityLogable;

class UserRegisteredEvent implements ActivityLogable
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getMeta() {
        return $this->user->id;
    };
    public function getMetaType() {
        return 'user_id';
    };
}
```

And that's it!
