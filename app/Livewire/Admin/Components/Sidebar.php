<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class Sidebar extends Component
{
    /**
     * @return array<array<string,string>>
     */
    public function items(): array
    {
        return [
            [
                'title' => 'Dashboard',
                'icon' => 'c-chart-pie',
                'url' => route('admin'),
            ],
            [
                'title' => 'Invitations',
                'icon' => 'o-paper-airplane',
                'url' => route('admin.invitations.index'),
            ],
        ];
    }

    public function render()
    {
        return view('livewire.admin.components.sidebar');
    }
}
