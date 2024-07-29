<div class="nav-item dropdown d-none d-md-flex me-3">
    <a href="#" class="nav-link px-0 show" data-bs-toggle="dropdown" tabindex="-1" data-bs-auto-close="false"
       aria-label="Show notifications" aria-expanded="true">
        <i class="ti ti-shopping-cart icon"></i>
    </a>
    <div @class(["dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card", 'show' => $show])
         data-bs-popper="static">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cart List</h3>
            </div>
            <div class="list-group list-group-hoverable w-96">
                @forelse($carts as $cart)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto"><span
                                    class="status-dot status-dot-animated bg-{{ collect(['red', 'blue', 'azure', 'teal'])->random() }} d-block"></span>
                            </div>
                            <div class="col text-truncate d-flex justify-content-between align-items-center">
                                <a href="#"
                                   class="text-white d-block">
                                    {{ $cart->productVariant->product->name }} ({{ $cart->productVariant->name }})
                                </a>
                                <div class="d-flex align-items-center text-truncate mt-n1">
                                    <strong class="me-3">{{ $cart->quantity }}x </strong>
                                    <button class="btn" wire:click="deleteCart('{{ $cart->id }}')">
                                        <i class="ti ti-trash fs-2 text-red "></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($loop->last)
                        <a class="text-center mt-3" href="{{ route('customer.cart-process') }}" wire:navigate>
                            <h3 class="text-center">Proceed to Checkout</h3>
                        </a>
                    @endif
                @empty
                    <h1 class="text-center mt-3">
                        Empty Carts
                    </h1>
                @endforelse
            </div>
        </div>
    </div>
</div>
