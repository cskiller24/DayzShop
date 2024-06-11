<?php

use App\Enums\Type;
use App\Livewire\Auth\Login;
use App\Models\User;
use App\Providers\MacroServiceProvider;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Login::class)
        ->assertStatus(200);
});

it('validates required email', function () {
    Livewire::test(Login::class)
        ->set('email', '')
        ->call('login')
        ->assertHasErrors(['email' => 'The email field is required.'])
        ->assertHasErrors(['email' => ['required']]);
});

it('validates that the email is invalid email', function () {
    Livewire::test(Login::class)
        ->set('email', 'test')
        ->call('login')
        ->assertHasErrors(['email' => 'The email field must be a valid email address.'])
        ->assertHasErrors(['email' => ['email']]);
});

it('validates that the email does not exists in the database', function () {
    Livewire::test(Login::class)
        ->set('email', 'test@gmail.com')
        ->call('login')
        ->assertHasErrors(['email' => 'The selected email is invalid.'])
        ->assertHasErrors(['email' => ['exists']]);
});

it('sucessfully validates the email', function () {
    User::factory()->create(['email' => 'email@example.com']);

    Livewire::test(Login::class)
        ->set('email', 'email@example.com')
        ->call('login')
        ->assertHasNoErrors(['email']);
});

it('validates that the password is required', function () {
    Livewire::test(Login::class)
        ->set('password', '')
        ->call('login')
        ->assertHasErrors(['password' => 'The password field is required.']);
});

it('succesfully logs in the user with different', function () {
    foreach (array_merge(Type::getValues(), ['limbo']) as $role) {
        $user = User::factory()->create(['email' => "{$role}@example.com", 'type' => $role]);

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect(MacroServiceProvider::routeTypes()[$role] ?? route('limbo'));
    }

    // $user = User::factory()->create(['email' => "limbo@example.com", 'type' => 'limbo']);

    // Livewire::test(Login::class)
    //         ->set('email', $user->email)
    //         ->set('password', 'password')
    //         ->call('login')
    //         ->assertRedirect(route('limbo'));
});
