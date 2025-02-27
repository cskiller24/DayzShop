<?php

use App\Enums\InvitationTypes;
use App\Livewire\Admin\Components\Invites\Create;
use App\Models\Invite;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    $this->admin = seedAdmin();
    setPermissionsTeamId(\App\Models\Permission::DEFAULT_ADMIN_TEAM);
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs($this->admin)
        ->test(Create::class)
        ->assertStatus(200);
});

it('creates an invitation', function () {
    Livewire::actingAs($this->admin)
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
    Livewire::actingAs($this->admin)
        ->test(Create::class)
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
    Livewire::actingAs($this->admin)
        ->test(Create::class)
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
    Livewire::actingAs($this->admin)
        ->test(Create::class)
        ->set('expireAt', now()->subDay()->toDateTimeLocalString())
        ->set('type', fake()->randomElement([InvitationTypes::STORE->value, InvitationTypes::COURIER->value]))
        ->call('create')
        ->assertHasErrors(['expireAt']);

    // expect(Invite::query()->count())
    //     ->not
    //     ->toBe(0);
});
