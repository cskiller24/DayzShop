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
                <div class="fs-1 ">
                    {{ $product->lowestVariantPrice() }} - {{ $product->highestVariantPrice() }}
                </div>
            @else
                <div class="fs-1">
                    {{ $product->lowestVariantPrice() }}
                </div>
            @endif
        </div>
        @foreach($product->variants as $variant)
            <div class="border rounded border-light-subtle">
                {{ $variant->name }}
            </div>
        @endforeach
    </div>
</div>
