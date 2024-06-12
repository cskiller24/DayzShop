<?php

namespace App\Livewire\Admin\Components\Invitations;

use App\Models\Invitation;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public function delete(string $code): void
    {
        if(($invite = Invitation::where('code', $code)->first()) === null) {
            $this->dispatch('flash-message', message: 'Cannot delete invitation.', title: 'Error!');
        }

        $invite->delete();

        $this->dispatch('flash-message', message: 'Successfully deleted invitation.', title: 'Success!');
    }

    public function render()
    {
        return view('livewire.admin.components.invitations.table', [
            'invites' => Invitation::query()->paginate(),
        ]);
    }
}
