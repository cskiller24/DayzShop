<?php

use App\Livewire\Customer;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => '/customer'], function (){
    Route::get('/', Customer\Home::class)
        ->name('customer');
});


