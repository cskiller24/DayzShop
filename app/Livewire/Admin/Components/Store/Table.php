<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Components\Store;

use App\Models\Store;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public function delete(string $id): void
    {
        Store::query()->findOrFail($id)->delete();

        $this->dispatch('flash-message', message: 'Deleted store successfully');
    }

    public function render(): View
    {
        return view('livewire.admin.components.store.table', [
           'stores' => Store::query()->paginate(),
        ]);
    }
}
