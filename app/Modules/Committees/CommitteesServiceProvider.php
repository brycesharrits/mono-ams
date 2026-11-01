<?php

namespace App\Modules\Committees;

use Illuminate\Support\ServiceProvider;

class CommitteesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'committees');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }
}
