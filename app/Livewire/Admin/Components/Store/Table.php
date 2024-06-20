<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Components\Store;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.components.store.table', [
           'stores' => Store::query()->paginate(),
        ]);
    }
}
