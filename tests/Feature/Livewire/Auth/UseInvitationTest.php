<?php

declare(strict_types=1);

use App\Livewire\Auth\UseInvitation;
use App\Models\Invite;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function () {
    $invite = Invite::factory()->storeInvite()->create();

    Livewire::test(UseInvitation::class, ['invite' => $invite])
        ->assertStatus(200);
});

it('succesfully creates a seller account', function () {
    Notification::fake();

    $invite = Invite::factory()
        ->storeInvite()
        ->create();

    $email = fake()->email();

    Livewire::test(UseInvitation::class, ['invite' => $invite])
        ->assertStatus(200)
        ->assertViewIs('livewire.auth.invitation.seller-registration')
        ->set('name', fake()->name())
        ->set('email', $email)
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertRedirect();

    assertDatabaseHas('users', ['email' => $email]);
});

it('it renders expires invitation on expired invite', function () {
    $invite = Invite::factory()
        ->storeInvite()
        ->expired()
        ->create();

    Livewire::test(UseInvitation::class, ['invite' => $invite])
        ->assertViewIs('livewire.auth.invitation.expired');
});
