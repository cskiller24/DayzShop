<?php

declare(strict_types=1);

use App\Enums\Type;
use App\Livewire\Seller;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'type:'.Type::SELLER->value], 'prefix' => '/seller'], function (): void {
    Route::get('/', Seller\Home::class)
        ->name('seller');
});
