<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', Login::class)
    ->middleware('guest')
    ->name('login');

Route::get('/register', Register::class)
    ->middleware('guest')
    ->name('register');
