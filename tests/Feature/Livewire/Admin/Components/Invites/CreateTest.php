<?php

use App\Enums\InvitationTypes;
use App\Livewire\Admin\Components\Invites\Create;
use App\Models\Invite;
use Database\Seeders\DatabaseSeeder;
use Livewire\Livewire;
use function Pest\Laravel\seed;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
    seed(DatabaseSeeder::class);
});

it('renders successfully', function () {
    Livewire::test(Create::class)
        ->assertStatus(200);
});

it('creates an invitation', function () {
    $admin = \App\Models\User::whereType('admin')->first();

    setPermissionsTeamId($admin->id);

    Livewire::actingAs($admin)
        ->test(Create::class)
        ->set('expireAt', now()->addDay()->toDateTimeLocalString())
        ->set('type', fake()->randomElement([InvitationTypes::STORE->value, InvitationTypes::COURIER->value]))
        ->call('create')
        ->assertDispatched('invite-created')
        ->assertDispatched('flash-message', message: 'Invitation successfully created!', title: 'Success!');

    // expect(Invite::query()->count())
    //     ->not
    //     ->toBe(0);
});

it('creates store invitation', function () {
    Livewire::test(Create::class)
        ->set('expireAt', now()->addDay()->toDateTimeLocalString())
        ->set('type', InvitationTypes::STORE->value)
        ->call('create')
        ->assertDispatched('invite-created')
        ->assertDispatched('flash-message', message: 'Invitation successfully created!', title: 'Success!');

    expect(Invite::query()->count())
        ->not
        ->toBe(0);
});

it('creates courier invitation', function () {
    Livewire::test(Create::class)
        ->set('expireAt', now()->addDay()->toDateTimeLocalString())
        ->set('type', InvitationTypes::STORE->value)
        ->call('create')
        ->assertDispatched('invite-created')
        ->assertDispatched('flash-message', message: 'Invitation successfully created!', title: 'Success!');

    expect(Invite::query()->count())
        ->not
        ->toBe(0);
});

it('throws validation exception on invalid expire at', function () {
    Livewire::test(Create::class)
        ->set('expireAt', now()->subDay()->toDateTimeLocalString())
        ->set('type', fake()->randomElement([InvitationTypes::STORE->value, InvitationTypes::COURIER->value]))
        ->call('create')
        ->assertHasErrors(['expireAt']);

    // expect(Invite::query()->count())
    //     ->not
    //     ->toBe(0);
});
