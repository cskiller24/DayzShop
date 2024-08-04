<?php

declare(strict_types=1);

use App\Enums\Type;
use App\Http\Middleware\AcceptsCustomerAndGuest;
use App\Livewire\Customer;
use App\Livewire\Customer\Pages\ProcessCart;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => AcceptsCustomerAndGuest::class, 'prefix' => '/shop'], function (): void {
    Route::get('/', Customer\Home::class)
        ->name('customer');

    Route::get('process-cart', ProcessCart::class)
        ->middleware(['auth', 'type:'.Type::CUSTOMER->value])
        ->name('customer.cart-process');

    Route::get('/process-checkout', Customer\Pages\Checkout::class)
        ->middleware(['auth', 'type:'.Type::CUSTOMER->value])
        ->name('customer.checkout-process');

    Route::get('{product}', Customer\Pages\Products\Show::class)
        ->name('customer.products.show');
});
