<?php

declare(strict_types=1);

use App\Http\Middleware\AcceptsCustomerAndGuest;
use App\Livewire\Customer;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => AcceptsCustomerAndGuest::class, 'prefix' => '/shop'], function (): void {
    Route::get('/', Customer\Home::class)
        ->name('customer');

    Route::get('{product}', Customer\Pages\Products\Show::class)
        ->name('customer.products.show');
});
