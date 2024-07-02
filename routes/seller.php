<?php

declare(strict_types=1);

use App\Enums\Type;
use App\Http\Controllers\Seller\StoreController;
use App\Livewire\Seller;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'type:'.Type::SELLER->value], 'prefix' => '/seller'], function (): void {
    Route::get('/', Seller\Home::class)
        ->name('seller');

    Route::get('/select', Seller\SelectStore::class)
        ->name('seller.select');
    Route::post('/create-store/{store}', [StoreController::class, 'activate'])
        ->name('seller.activate');

    Route::get('/create-store', Seller\CreateStore::class)
        ->name('seller.create');
    Route::post('/create-store', [StoreController::class, 'store'])
        ->name('seller.store');

    Route::get('/products', Seller\Pages\Products\Index::class)
        ->name('seller.products.index');
    Route::get('/products/create', Seller\Pages\Products\Create::class)
        ->name('seller.products.create');
    Route::get('/products/{product}', Seller\Pages\Products\Show::class)
        ->name('seller.products.show');
    Route::get('/products/{product}/edit', Seller\Pages\Products\Edit::class)
        ->name('seller.products.edit');

    Route::get('categories', Seller\Pages\Categories\Index::class)
        ->name('seller.categories.index');

});
