<a class="card card-link-pop border light-hover" href="{{ route('customer.products.show', $product->id) }}"
   wire:navigate>
    <div class="p-1">
        <img src="{{ $product->getFirstMedia()->getUrl()  }}">
        <div class="fw-bold fs-3">{{ $product->name }}</div>
        @if($this->lowestPrice !== $this->highestPrice)
            {{ $this->lowestPrice }} - {{ $this->highestPrice }}
        @else
            {{ $this->lowestPrice }}
        @endif
    </div>
</a>
