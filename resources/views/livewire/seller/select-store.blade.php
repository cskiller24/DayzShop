<div class="page page-center">
    <div class="container container-tight">
        <div class="text-center mb-4">
            <a href="{{ route('welcome') }}" wire:navigate class="navbar-brand navbar-brand-autodark">
                <x-base::logo class="" style="width: 5rem" />
            </a>
        </div>
        <h3 class="text-center">Select a store</h3>
        @foreach ($stores as $store)
        <form action="{{ route('seller.activate', $store->id)}}" method="POST">
            @csrf
            <div class="card-body">
                <x-base::button class="w-full border-light">{{ $store->name }}</x-base::button>
            </div>
        </form>
        @endforeach
    </div>
    {{-- Care about people's approval and you will be their prisoner. --}}
</div>
