<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\Store;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.pages.store.index');
    }
}
