<?php

use App\Enums\Type;
use App\Livewire\Courier;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'type:'.Type::COURIER->value], 'prefix' => '/courier'], function (): void {
    Route::get('/', Courier\Home::class)
        ->name('courier');
});
