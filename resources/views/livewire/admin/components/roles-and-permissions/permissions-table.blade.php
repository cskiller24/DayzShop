<div class="table-responsive rounded pb-0">
    <div class="pt-2 px-2">
        {{ $permissions->links() }}
    </div>
    <table class="table table-vcenter">
        <thead>
        <tr>
            <th>Unparsed Name</th>
            <th>Created At</th>
            <th class="w-1">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($permissions as $permission)
            <tr>
                <td scope="row">
                    {{ $permission->name }}
                </td>
                <td>
                    {{ $permission->created_at->format('F j, Y h:i A') }}
                </td>
                <td class="" x-data="emailSender">
                    <span class="cursor-pointer text-red" wire:click="delete('{{ $invite->code }}')"
                          wire:confirm="Are you sure?">
                            <i class="ti ti-trash icon"></i>
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <h3 class="text-center">
                        No Permissions Available
                    </h3>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="pt-2 px-2">
        {{ $permissions->links() }}
    </div>
</div>
