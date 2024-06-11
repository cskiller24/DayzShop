<?php

declare(strict_types=1);

use App\Enums\Type;
use App\Livewire\Admin;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'type:'.Type::ADMIN->value], 'prefix' => '/admin'], function (): void {
    Route::get('/', Admin\Home::class)
        ->name('admin');
});
