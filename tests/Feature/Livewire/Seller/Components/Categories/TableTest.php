<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Components\Categories\Table;
use App\Models\Category;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    seedSeller();
    withoutVite();
    $this->seller = User::whereType('seller')->first();
});

it('renders successfully', function () {
    Livewire::actingAs($this->seller)
        ->test(Table::class)
        ->assertStatus(200);
});

it('updates category', function () {
    $category = Category::factory()->createQuietly(['store_id' => $this->seller->active_store_id]);

    Livewire::actingAs($this->seller)
        ->test(Table::class)
        ->assertStatus(200)
        ->set('name', 'name')
        ->call('update', $category->id)
        ->assertDispatched(Toaster::EVENT);
});

it('deletes category', function () {
    $category = Category::factory()->createQuietly(['store_id' => $this->seller->active_store_id]);

    Livewire::actingAs($this->seller)
        ->test(Table::class)
        ->assertStatus(200)
        ->set('name', 'name')
        ->call('delete', $category->id)
        ->assertDispatched(Toaster::EVENT);
});
