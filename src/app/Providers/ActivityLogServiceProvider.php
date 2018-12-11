<?php
namespace Vicoders\ActivityLog\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Vicoders\ActivityLog\Repositories\ActivityLogRepository;
use Vicoders\ActivityLog\Repositories\ActivityLogRepositoryEloquent;

class ActivityLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }

    public function register()
    {
        App::bind(ActivityLogRepository::class, ActivityLogRepositoryEloquent::class);
        App::bind(\Vicoders\ActivityLog\Services\Simplize\Constracts\Simplize::class, \Vicoders\ActivityLog\Services\Simplize\Simplize::class);
    }
}
