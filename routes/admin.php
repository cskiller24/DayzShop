<?php

declare(strict_types=1);

use App\Enums\Type;
use App\Livewire\Admin;
use App\Livewire\Admin\Pages\Invites;
use App\Livewire\Admin\Pages\Store;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'type:'.Type::ADMIN->value], 'prefix' => '/admin'], function (): void {
    Route::get('/', Admin\Home::class)
        ->name('admin');

    Route::get('/invites', Invites::class)
        ->name('admin.invites');

    Route::get('/stores', Store\Index::class)
        ->name('admin.stores');

    Route::get('/stores/create', Store\Create::class)
        ->name('admin.stores.create');
});
