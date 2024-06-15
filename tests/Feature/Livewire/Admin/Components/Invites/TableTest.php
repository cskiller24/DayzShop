<?php

use App\Livewire\Admin\Components\Invites\Table;
use App\Mail\StoreInvitation;
use App\Models\Invite;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Table::class)
        ->assertStatus(200);
});

it('deletes the invitation successfully', function () {
    $invite = Invite::factory()->create();

    Livewire::test(Table::class)
        ->call('delete', code: $invite->code)
        ->assertDispatched('flash-message', message: 'Successfully deleted invitation.', title: 'Success!');

    expect(Invite::query()->count())
        ->toBe(0);
});

it('does not delete invitation on wrong code', function () {
    Invite::factory()->create();

    Livewire::test(Table::class)
        ->call('delete', '1')
        ->assertDispatched('flash-message', message: 'Cannot delete invitation.', title: 'Error!');

    expect(Invite::query()->count())
        ->toBe(1);
});

it('sends invitation via email', function () {
    Mail::fake();

    $invite = Invite::factory()->storeInvite()->create();

    $email = fake()->email();

    Livewire::test(Table::class)
        ->call('notify', code: $invite->code, email: $email)
        ->assertDispatched('flash-message', message: 'Invitation successfully sent!', title: 'Success!', type: NotificationInterface::SUCCESS);

    Mail::assertSent(StoreInvitation::class);
});
