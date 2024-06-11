<?php

use App\Livewire\Courier;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => '/courier'], function (){
    Route::get('/', Courier\Home::class)
        ->name('courier');
});
