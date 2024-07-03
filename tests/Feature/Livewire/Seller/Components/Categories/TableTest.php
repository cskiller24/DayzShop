<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Components\Categories\Table;
use App\Models\Category;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Table::class)
        ->assertStatus(200);
});

it('updates category', function () {
    $category = Category::factory()->createQuietly();
    $seller = \App\Models\User::factory()
        ->seller()
        ->create([
            'active_store_id' => $category->store_id,
        ]);

    $seller->stores()->sync($category->store_id);

    Livewire::actingAs($seller)
        ->test(Table::class)
        ->assertStatus(200)
        ->set('name', 'name')
        ->call('update', $category->id)
        ->assertDispatched(Toaster::EVENT);
});

it('deletes category', function () {
    $category = Category::factory()->createQuietly();
    $seller = \App\Models\User::factory()
        ->seller()
        ->create([
            'active_store_id' => $category->store_id,
        ]);

    $seller->stores()->sync($category->store_id);

    Livewire::actingAs($seller)
        ->test(Table::class)
        ->assertStatus(200)
        ->set('name', 'name')
        ->call('delete', $category->id)
        ->assertDispatched(Toaster::EVENT);
});
