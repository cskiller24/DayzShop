<?php

use App\Enums\Type;
use App\Livewire\Customer;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'type:'.Type::CUSTOMER->value], 'prefix' => '/customer'], function (): void {
    Route::get('/', Customer\Home::class)
        ->name('customer');
});
