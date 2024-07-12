<div class="row">
    <div class="col-4">
        <div class="card h-full">
            <div class="card-body d-flex flex-column align-items-center">
                <div id="product-carousel" class="carousel slide" data-bs-ride="carousel" data-interval="false">
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
        </div>
    </div>
    <div class="col-8">
        <h1 class="display-5">
            {{ $product->name }}
        </h1>

        <div class="mb-3">
            @if($product->lowestVariantPrice() !== $product->highestVariantPrice() && $product->variants->count() === 1)
                <div class="fs-1">
                    {{ $product->lowestVariantPrice() }}
                </div>
            @else
                <div class="fs-1 ">
                    {{ $product->lowestVariantPrice() }} - {{ $product->highestVariantPrice() }}
                </div>
            @endif
        </div>
        <div class="bg-light-lt py-1 px-2 mb-3">
            {{ $product->description }}
        </div>
        <div class="row mb-3">
            <div class="form-selectgroup">
                @foreach($product->variants as $variant)
                    <label class="form-selectgroup-item">
                        <input type="radio" name="name" wire:model="productVariantId" value="{{ $variant->id }}"
                               class="form-selectgroup-input text-white"/>
                        <span class="form-selectgroup-label text-white border-light-subtle">
                            {{ $variant->name }} - {{ $variant->price->format() }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="d-flex flex-row-reverse gap-2">
            <button class="btn btn-success" wire:loading.attr="disabled">
                <i class="ti ti-currency-peso me-1"></i> Buy now
            </button>
            <button class="btn btn-teal" wire:click="addToCart" wire:loading.attr="disabled">
                <i class="ti ti-shopping-cart me-1"></i> Add to Card
            </button>
        </div>
    </div>
</div>
