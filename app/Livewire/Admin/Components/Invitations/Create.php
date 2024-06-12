<?php

namespace App\Livewire\Admin\Components\Invitations;

use App\Enums\InvitationTypes;
use App\Models\Invitation;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public string $modalId;

    #[Validate(['required'])]
    public string $date;

    #[Validate(['required'])]
    public string $time;

    #[Validate(['required'])]
    public string $type;

    public function mount(string $modalId): void
    {
        $this->modalId = $modalId;
        $this->date = now()->addDays(5)->format('Y-m-d');
        $this->time = now()->toTimeString('minutes');
    }

    public function save(): void
    {
        $this->validate();

        $time = Carbon::parse($this->date.$this->time);

        throw_if(
            $time->addMinute()->lessThanOrEqualTo(now()),
            ValidationException::withMessages(['date' => 'Invalid, the date and time must be greater than now.'])
        );

        Invitation::query()->create([
            'expire_at' => $time->toDateTimeLocalString(),
            'type' => $this->type,
        ]);

        $this->dispatch('flash-message', message: 'Sucessfully created invitation.', title: 'Success!');

        $this->redirect(route('admin.invitations.index'), true);
    }

    public function render()
    {
        return view('livewire.admin.components.invitations.create');
    }
}
