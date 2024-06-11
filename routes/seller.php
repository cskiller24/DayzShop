<?php

use App\Livewire\Seller;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => '/seller'], function (){
    Route::get('/', Seller\Home::class)
        ->name('seller');
});
