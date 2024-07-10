<div class="card card-link-pop border light-hover">
    <div class="p-1">
        <img src="{{ $product->getFirstMedia()->getUrl()  }}">
        <div class="fw-bold fs-3">{{ $product->name }}</div>
        {{ $this->highestPrice }} {{ $this->lowestPrice }}
    </div>
</div>
