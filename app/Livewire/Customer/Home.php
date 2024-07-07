<?php

declare(strict_types=1);

namespace App\Livewire\Customer;

use App\Livewire\Customer\Components\Search;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.roles.customer')]
class Home extends Component
{
    #[Url(as: 'q')]
    public string $search;
    #[On(Search::EVENT)]
    public function render(): View
    {
        return view('livewire.customer.home', [
            'products' => Product::search($this->search)->paginate(),
        ]);
    }
}
