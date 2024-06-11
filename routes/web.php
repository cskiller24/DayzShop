<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LimboController;
use App\Livewire\Auth\EmailVerification;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Test;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)
    ->name('welcome');

Route::get('login', Login::class)
    ->middleware('guest')
    ->name('login');

Route::get('/register', Register::class)
    ->middleware('guest')
    ->name('register');

Route::get('/forgot-password', ForgotPassword::class)
    ->middleware('guest')
    ->name('password.request');

Route::get('/reset-password/{token}', ResetPassword::class)
    ->middleware('guest')
    ->name('password.reset');

Route::post('/logout', LogoutController::class)
    ->middleware('auth')
    ->name('logout');

Route::get('/email-verification/notice', EmailVerification::class)
    ->middleware(['not-verified', 'auth'])
    ->name('verification.notice');

Route::post('/email-verification/send', [EmailVerificationController::class, 'send'])
    ->middleware(['auth', 'not-verified', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/email-verification/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::get('limbo', LimboController::class)
    ->middleware(['auth', 'verified'])
    ->name('limbo');

Route::get('test', Test::class);

Route::get('/auth', function (): void {
})->middleware(['auth', 'verified']);
