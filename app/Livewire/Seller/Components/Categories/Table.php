<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Components\Categories;

use App\Models\Category;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Table extends Component
{
    #[Validate('required')]
    public string $name;

    public function update(string $id): void
    {
        $this->authorize('update', Category::class);

        $this->validate();

        Category::query()
            ->findOrFail($id)
            ->update(['name' => $this->name]);

        $this->dispatch('flash-message', message: 'Successfully updated category', title: 'Success!', type: NotificationInterface::SUCCESS);
    }

    public function delete(string $id): void
    {
        $this->authorize('delete', Category::class);

        Category::query()
            ->findOrFail($id)
            ->delete();

        $this->dispatch('flash-message', message: 'Successfully deleted category', title: 'Success!', type: NotificationInterface::SUCCESS);
    }

    #[On('category-created')]
    public function render(): View
    {
        return view('livewire.seller.components.categories.table', [
            'categories' => Category::query()->latest()->paginate(),
        ]);
    }
}
