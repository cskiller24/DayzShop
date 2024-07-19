<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Test')]
#[Layout('components.layouts.app')]
class Test extends Component
{
    public function render(): View
    {
        //        $produicts = Product::search('bead')->get();
        return view('livewire.test');
    }
}
