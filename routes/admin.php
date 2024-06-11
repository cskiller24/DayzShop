<?php

use App\Enums\Type;
use App\Livewire\Admin;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'type:'.Type::ADMIN->value], 'prefix' => '/admin'], function (){
    Route::get('/', Admin\Home::class)
        ->name('admin');
});
