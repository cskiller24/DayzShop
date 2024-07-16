<div class="card light-hover p-3">
    <div class="row align-items-center">
        <a class="h3 mb-0 col-sm-12 col-md-6" wire:navigate
           href="{{ route('customer.products.show', $cart->productVariant->product_id) }}">
            {{ $cart->productVariant->name }} ({{ $cart->productVariant->product->name }})
        </a>
        <div class="col-sm-12 col-md-6 ">
            <div class="row align-items-center text-center">
                <div class="col-4">
                    {{ $cart->productVariant->price }}
                </div>
                <div class="col-4">
                    <div class="btn-group me-2 " role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-success"
                                wire:click="increment(1)"
                                wire:loading.attr="disabled">
                            +
                        </button>
                        <button type="button" class="border border-light-subtle btn">{{ $cart->quantity }}</button>
                        <button type="button" class="btn btn-outline-warning"
                                wire:click="decrement(1)"
                                wire:loading.attr="disabled">
                            -
                        </button>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <button class="btn btn-danger btn-lg" wire:click="$parent.deleteCart('{{ $cart->id }}')">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
