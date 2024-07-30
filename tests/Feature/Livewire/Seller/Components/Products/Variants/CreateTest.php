<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Components\Products\Variants\Create;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Create::class)
        ->assertStatus(200);
});

it('creates a product variant', function () {
    Storage::fake();

    seedSeller();
    $seller = User::whereType('seller')->first();

    $product = Product::whereStoreId($seller->active_store_id)->first();

    Livewire::actingAs($seller)
        ->test(Create::class, ['product' => $product])
        ->assertStatus(200)
        ->set('form.name', fake()->name())
        ->set('form.description', fake()->word())
        ->set('form.price', '100')
        ->set('form.quantity', 100)
        ->set('form.photo', UploadedFile::fake()->image('photo.jpg'))
        ->call('store')
        ->assertDispatched(Toaster::EVENT)
        ->assertDispatched('product-variant-added');

    assertDatabaseHas('product_variants', ['product_id' => $product->id]);
    assertDatabaseHas('media', ['id' => $product->getMedia()[0]->id]);
});
