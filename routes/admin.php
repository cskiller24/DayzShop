<?php

use App\Livewire\Admin;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => '/admin'], function (){
    Route::get('/', Admin\Home::class)
        ->name('admin');
});
