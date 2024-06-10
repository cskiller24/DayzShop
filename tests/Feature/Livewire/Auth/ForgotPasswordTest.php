<?php

use App\Livewire\Auth\ForgotPassword;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ForgotPassword::class)
        ->assertStatus(200);
});

it('successfully send a forgot password email', function () {
    Notification::fake();

    $user = User::factory()->create();

    Livewire::test(ForgotPassword::class)
        ->set('email', $user->email)
        ->call('sendPasswordReset');

    Notification::assertSentTo([$user], ResetPassword::class);
});

it('does not send a forgot password email to non-existing user', function () {
    Notification::fake();

    Livewire::test(ForgotPassword::class)
        ->set('email', fake()->email())
        ->call('sendPasswordReset')
        ->assertHasErrors(['email' => 'The selected email is invalid.'])
        ->assertHasErrors(['email' => ['exists']]);

    Notification::assertNothingSent();
});
