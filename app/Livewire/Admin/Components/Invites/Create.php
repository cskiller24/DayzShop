<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Components\Invites;

use App\Enums\InvitationTypes;
use App\Models\Invite;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    public string $expireAt;

    public string $type;

    public function mount(): void
    {
        $this->expireAt = now()->addDay()->toDateTimeString();
    }

    public function create(): void
    {
        $expireAt = Carbon::parse($this->expireAt);

        $this->validate([
            'expireAt' => ['required'],
            'type' => ['required', new Enum(InvitationTypes::class)],
        ]);

        throw_if(
            $expireAt->lessThan(now()),
            ValidationException::withMessages(['expireAt' => __('validation.after', ['attribute' => 'expires at', 'date' => now()->format('F j, Y h:i A')])])
        );

        Invite::query()->create([
            'expire_at' => $expireAt,
            'type' => $this->type,
        ]);

        $this->dispatch('invite-created');

        $this->dispatch('flash-message', message: 'Invitation successfully created!', title: 'Success!');
    }

    public function render(): View
    {
        return view('livewire.admin.components.invites.create');
    }
}
