<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Components;

use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
    public const string EVENT = 'searched';

    #[Url(as: 'q')]
    public string $search;

    public function searched(): void
    {
        $this->dispatch(self::EVENT);
    }

    public function render(): View
    {
        return view('livewire.customer.components.search');
    }
}
