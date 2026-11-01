<?php

use App\Modules\Membership\Http\Controllers\Admin\MembersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('members', MembersController::class);
    });
