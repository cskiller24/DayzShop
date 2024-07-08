<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
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
        DB::enableQueryLog();
        $produicts = Product::search('bead')->get();
        dd(DB::getQueryLog(), $produicts->toArray());
        return view('livewire.test');
    }
}
