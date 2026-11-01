<?php

use App\Modules\Committees\Http\Controllers\Admin\CommitteeMembersController;
use App\Modules\Committees\Http\Controllers\Admin\CommitteesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('committees', CommitteesController::class);

        Route::post('committees/{committee}/members', [CommitteeMembersController::class, 'store'])
            ->name('committees.members.store');
        Route::patch('committees/{committee}/members/{member}', [CommitteeMembersController::class, 'update'])
            ->name('committees.members.update');
        Route::delete('committees/{committee}/members/{member}', [CommitteeMembersController::class, 'destroy'])
            ->name('committees.members.destroy');
    });
