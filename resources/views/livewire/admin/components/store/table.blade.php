<div class="table-responsive border border-light-subtle rounded pb-0">
    <div class="pt-2 px-2">
        {{ $stores->links() }}
    </div>
    <table class="table table-vcenter">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Logo</th>
                <th class="w-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stores as $store)
                <tr>
                    <td>{{ $store->name }}</td>
                    <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $store->description }}">{{ str($store->description)->limit(20) }}</td>
                    <td>{{ $store->email }}</td>
                    <td>{{ $store->phone_number }}</td>
                    <td>
                        @if($store->logo)
                            <img src="{{ $store->logo }}" alt="" srcset="">
                        @else
                            <small>No Logo</small>
                        @endif
                    </td>
                    <td >
                        <span class="cursor-pointer text-red" wire:click="delete('{{ $store->id }}')" wire:confirm="Are you sure?" >
                            <i class="ti ti-trash icon"></i>
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <h1 class="text-center">No store available.</h1>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="pt-2 px-2">
        {{ $stores->links() }}
    </div>
</div>

