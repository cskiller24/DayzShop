<?php

use App\Enums\Type;
use App\Livewire\Seller;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'type:'.Type::SELLER->value], 'prefix' => '/seller'], function (){
    Route::get('/', Seller\Home::class)
        ->name('seller');
});
