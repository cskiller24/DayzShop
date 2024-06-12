<?php

declare(strict_types=1);

use App\Enums\Type;
use App\Livewire\Admin\Pages\Home;
use App\Livewire\Admin\Pages\Invitation;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'type:'.Type::ADMIN->value], 'prefix' => '/admin'], function (): void {
    Route::get('/', Home::class)
        ->name('admin');

    Route::get('/invitations', Invitation::class)
        ->name('admin.invitations.index');
});
