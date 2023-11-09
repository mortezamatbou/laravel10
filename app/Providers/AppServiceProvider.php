<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('title', 'Undefined Title');

        DB::listen(function (QueryExecuted $query) {
            // $query->connection->insert('INSERT INTO log_requests (route_name, uuid, time_add) VALUES (?, UUID(), ?)', [request()->path(), time()]);
        });

    }
}
