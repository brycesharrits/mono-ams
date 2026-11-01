<?php

namespace App\Modules\Membership;

use Illuminate\Support\ServiceProvider;

class MembershipServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'membership');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }
}
