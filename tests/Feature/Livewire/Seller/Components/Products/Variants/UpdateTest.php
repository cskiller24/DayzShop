<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Components\Products\Variants\Update;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    $this->seller = seedSeller();
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs($this->seller)
        ->test(Update::class)
        ->assertStatus(200);
});

it('updates a product variant', function () {
    Storage::fake();
    $product = Product::factory()->state(['store_id' => $this->seller->active_store_id])->createQuietly();
    $variant = ProductVariant::factory()
        ->state(['product_id' => $product->id])
        ->create();

    Livewire::actingAs($this->seller)
        ->test(Update::class, ['product' => $product])
        ->call('setVariantAndOpen', $variant->id)
        ->assertStatus(200)
        ->set('form.name', fake()->name())
        ->set('form.description', fake()->word())
        ->set('form.price', '100')
        ->set('form.quantity', 100)
        ->set('form.photo', UploadedFile::fake()->image('photo.jpg'))
        ->call('update')
        ->assertDispatched(Toaster::EVENT)
        ->assertDispatched('product-variant-update');

    assertDatabaseHas('product_variants', ['product_id' => $product->id]);
    assertDatabaseHas('media', ['id' => $product->getMedia()[0]->id]);
});
