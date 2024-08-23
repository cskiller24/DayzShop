<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Components\Products\AddImage;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    seedSeller();
    withoutVite();
    $this->seller = User::whereType('seller')->first();
});

it('renders successfully', function () {
    Livewire::actingAs($this->seller)
        ->test(AddImage::class)
        ->assertStatus(200);
});

it('successfully adds an image', function () {
    Storage::fake('public');

    $product = Product::whereStoreId($this->seller->active_store_id)->first();

    $file = UploadedFile::fake()->image('image.jpg');

    Livewire::actingAs($this->seller)
        ->test(AddImage::class, ['product' => $product])
        ->assertStatus(200)
        ->set('photo', $file)
        ->call('addImage')
        ->assertDispatched(Toaster::EVENT)
        ->assertDispatched('product-image-added');

    assertDatabaseHas('media', ['id' => $product->getMedia()[0]->id]);
});

it('does not add an invalid image', function () {
    Storage::fake('public');

    $product = Product::whereStoreId($this->seller->active_store_id)->first();
    $file = UploadedFile::fake()->create('image.docx');

    Livewire::actingAs($this->seller)
        ->test(AddImage::class, ['product' => $product])
        ->assertStatus(200)
        ->set('photo', $file)
        ->call('addImage')
        ->assertHasErrors('photo');

    Storage::disk('public')->assertMissing('image.docx');
});
