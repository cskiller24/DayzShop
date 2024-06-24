<div class="table-responsive rounded pb-0">
    <div class="pt-2 px-2">
        {{ $roles->links() }}
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
        @forelse ($roles as $role)
            <tr>
                <td scope="row">
                    {{ $role->name }}
                </td>
                <td>
                    {{ $role->created_at->format('F j, Y h:i A') }}
                </td>
                <td class="">
                    <a wire:navigate href="{{ route('admin.roles-and-permissions.roles.update', $role->id) }}"
                       class="nav-link d-inline">
                        <i class="ti ti-pencil icon"></i>
                    </a>
                    <span class="cursor-pointer text-red" wire:click="delete('{{ $role->id }}')"
                          wire:confirm="Are you sure?">
                            <i class="ti ti-trash icon"></i>
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <h3 class="text-center">
                        No Roles Available
                    </h3>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="pt-2 px-2">
        {{ $roles->links() }}
    </div>
</div>
