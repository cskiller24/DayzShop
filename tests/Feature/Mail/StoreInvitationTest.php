<?php

use App\Exceptions\InvalidInvitationTypeException;
use App\Mail\StoreInvitation;
use App\Models\Invite;
use Illuminate\Support\Facades\Mail;

it('sends invitation via email', function () {
    Mail::fake();

    $invite = Invite::factory()->storeInvite()->create();
    $email = fake()->email();

    Mail::to($email)->send(new StoreInvitation($invite));

    Mail::assertSent(StoreInvitation::class);
});

it('throws invalid invitation type on wrong type', function () {
    Mail::fake();

    $invite = Invite::factory()->courierInvite()->create();

    new StoreInvitation($invite);

})->throws(InvalidInvitationTypeException::class);
