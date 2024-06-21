<div {{ $attributes->merge(['class' => 'nav-item dropdown']) }} >
    <a href="#" class="nav-link d-flex dropdown-toggle" data-bs-toggle="dropdown"
       aria-label="Open user menu">
        <div class="d-none d-xl-block ps-2">
            <div>{{ auth()->user()->store->name }}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        @foreach(auth()->user()->stores as $store)
            @if($store->id !== auth()->user()->active_store_id)
                <form action="{{ route('seller.activate', $store->id) }}" method="post" >
                    @csrf
                    <button class="dropdown-item">
                        <i class="ti ti-building-store me-1"></i>{{ $store->name }}
                    </button>
                </form>
            @else
                <a class="dropdown-item" href="#">
                    <h4 class="text-reset m-0">
                        <i class="ti ti-check me-1"></i>{{ $store->name }}
                    </h4>
                </a>
            @endif
        @endforeach
    </div>
</div>
