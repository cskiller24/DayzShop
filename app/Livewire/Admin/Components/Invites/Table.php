<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Components\Invites;

use App\Mail\StoreInvitation;
use App\Models\Invite;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public function notify(string $code = null, string $email = null): void
    {
        $validator = Validator::make([
            'code' => $code,
            'email' => $email,
        ], [
            'email' => ['email', 'required', 'unique:users,email'],
            'code' => ['exists:invites,code']
        ]);

        if($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
                $this->dispatch('flash-message', message: $error, title: 'Error!', type: NotificationInterface::ERROR);
            }

            return;
        }

        $invite = Invite::query()->where('code', $code)->first();

        dispatch(function () use ($email, $invite) {
            Mail::to($email)->send(new StoreInvitation($invite));
        })->afterResponse();

        $this->dispatch('flash-message', message: 'Invitation successfully sent!', title: 'Success!', type: NotificationInterface::SUCCESS);

    }

    public function delete(string $code): void
    {
        if(($invite = Invite::where('code', $code)->first()) === null) {
            $this->dispatch('flash-message', message: 'Cannot delete invitation.', title: 'Error!');
        }

        // @phpstan-ignore-next-line
        $invite->delete();

        $this->dispatch('flash-message', message: 'Successfully deleted invitation.', title: 'Success!');
    }

    #[On('invite-created')]
    public function render(): View
    {
        return view('livewire.admin.components.invites.table', [
            'invites' => Invite::query()->oldest('expire_at')->paginate()
        ]);
    }
}
