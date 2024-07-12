<div class="nav-item dropdown d-none d-md-flex me-3">
    <a href="#" class="nav-link px-0 show" data-bs-toggle="dropdown" tabindex="-1"
       aria-label="Show notifications" aria-expanded="true">
        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
        <i class="ti ti-shopping-cart icon"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card show"
         data-bs-popper="static">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cart List</h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable w-96">
                @forelse($carts as $cart)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto"><span
                                    class="status-dot status-dot-animated bg-{{ collect(['red', 'blue', 'azure', 'teal'])->random() }} d-block"></span>
                            </div>
                            <div class="col text-truncate d-flex justify-content-between">
                                <a href="#" class="text-white d-block">{{ $cart->productVariant->name }}</a>
                                <div class="d-block text-truncate mt-n1">
                                    <strong>{{ $cart->quantity }}x </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    Empty Carts
                @endforelse
            </div>
        </div>
    </div>
</div>
