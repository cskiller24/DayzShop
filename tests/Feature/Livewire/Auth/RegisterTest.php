<?php

declare(strict_types=1);

use App\Livewire\Auth\Register;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Register::class)
        ->assertStatus(200);
});

it('registers successfully', function () {
    Livewire::test(Register::class)
        ->set('name', fake()->name())
        ->set('email', $email = fake()->email())
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertRedirect('/');
});

it('validates name is required', function () {
    Livewire::test(Register::class)
        ->set('email', $email = fake()->email())
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertHasErrors(['name' => ['required']])
        ->assertHasErrors(['name' => 'The name field is required.']);
});

it('validates email is required', function () {
    Livewire::test(Register::class)
        ->set('name', fake()->name())
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertHasErrors(['email' => ['required']])
        ->assertHasErrors(['email' => 'The email field is required.']);
});

it('validates email is invalid email', function () {
    Livewire::test(Register::class)
        ->set('name', fake()->name())
        ->set('email', 'invalid_email')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertHasErrors(['email' => ['email']])
        ->assertHasErrors(['email' => 'The email field must be a valid email address.']);
});

it('validates email must be unique', function () {
    $user = User::factory()->create();
    Livewire::test(Register::class)
        ->set('name', fake()->name())
        ->set('email', $user->email)
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertHasErrors(['email' => ['unique']])
        ->assertHasErrors(['email' => 'The email has already been taken.']);
});

it('validates that the password is required', function () {
    Livewire::test(Register::class)
        ->set('name', fake()->name())
        ->set('email', fake()->email())
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertHasErrors(['password' => ['required']])
        ->assertHasErrors(['password' => 'The password field is required.']);
});

it('validates that the password is the same in confirm password', function () {
    Livewire::test(Register::class)
        ->set('name', fake()->name())
        ->set('email', fake()->email())
        ->set('password', 'password')
        ->set('password_confirmation', 'password2')
        ->call('register')
        ->assertHasErrors(['password_confirmation' => ['same']])
        ->assertHasErrors(['password_confirmation' => 'The password confirmation field must match password.']);
});
