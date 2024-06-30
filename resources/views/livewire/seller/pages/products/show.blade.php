<div>
    <x-slot name="headerPretitle">
        {{ $product->id }}
    </x-slot>
    <x-slot name="headerTitle">
        View Product
    </x-slot>
    <div class="row">
        <div class="col-4">
            <div class="card h-full">
                <div class="card-body d-flex flex-column align-items-center">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#product-carousel" data-bs-slide-to="0"
                                    class="active"></button>
                            @foreach($product->getMedia() as $media)
                                <button type="button" data-bs-target="#product-carousel"
                                        data-bs-slide-to="{{ $loop->iteration }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($product->getMedia() as $media)
                                <div @class(['carousel-item', 'active' => $loop->first])>
                                    <img class="" alt="{{ $media->name }}"
                                         src="{{ $media->getUrl() }}"/>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" data-bs-target="#product-carousel" role="button"
                           data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" data-bs-target="#product-carousel" role="button"
                           data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
                <div title="Add product image">
                    <x-base.button class="w-full" data-bs-target="#product-add-image" data-bs-toggle="modal"
                                   type="button">Add Image
                    </x-base.button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card h-full">
                <div class="card-body">
                    <div class="mb-2">
                        <h1>
                            {{ $product->name }}
                        </h1>
                    </div>
                    <div class="bg-bitbucket-lt text-light p-2">
                        {{ $product->description }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter">

                            <thead>
                            <tr>
                                <th colspan="2" class="text-center text-light">Specifications</th>
                            </tr>
                            <tr>
                                <th>Specification</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product->specifications as $key => $value)
                                <tr>
                                    <td>
                                        {{ $key }}
                                    </td>
                                    <td>
                                        {{ $value }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <livewire:seller.components.products.variants.table :product="$product"/>
        </div>
    </div>
    <livewire:seller.components.products.add-image :product="$product" modal-id="product-add-image"/>
</div>

@script
<script>
    $wire.on('product-image-added', () => {
        $wire.$refresh();
    });

    $wire.on('product-variant-added', () => {
        $wire.$refresh();
    });

    $wire.on('product-variant-updated', () => {
        $wire.$refresh();
    });

    $wire.on('product-variant-deleted', () => {
        $wire.$refresh();
    });
</script>
@endscript
