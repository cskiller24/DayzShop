<div class="table-responsive border border-light-subtle rounded pb-0">
    <div class="pt-2 px-2">
        {{ $invites->links() }}
    </div>
    <table class="table table-vcenter">
        <thead>
        <tr>
            <th>Code</th>
            <th>Expiration Time</th>
            <th>Type</th>
            <th>Status</th>
            <th class="w-1">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invites as $invite)
            <tr>
                <td scope="row"
                    id="{{ $invite->code }}" @click="$clipboard('{{ $invite->code }}')">
                    {{ $invite->code }}
                </td>
                <td title="{{ $invite->expire_at->diffForHumans() }}">
                    {{ $invite->expire_at->format('F j, Y h:i A') }}
                </td>
                <td class="py-1">
                    @switch($invite->type)
                        @case(\App\Enums\InvitationTypes::COURIER)
                            <span
                                class="badge bg-indigo text-light">Courier</span>
                            @break

                        @case(\App\Enums\InvitationTypes::STORE)
                            <span
                                class="badge bg-azure text-light">Store</span>
                            @break

                            No Category

                        @default
                    @endswitch
                </td>
                <td>
                    {{ $invite->status }}
                </td>
                <td class="" x-data="emailSender">
                        <span class="cursor-pointer" @click="sendEmail('{{ $invite->code }}')">
                            <i class="ti ti-mail icon"></i>
                        </span>
                    <span class="cursor-pointer text-red" wire:click="delete('{{ $invite->code }}')"
                          wire:confirm="Are you sure?">
                            <i class="ti ti-trash icon"></i>
                        </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pt-2 px-2">
        {{ $invites->links() }}
    </div>
</div>

@script
<script>
    Alpine.data('emailSender', () => {
        return {
            sendEmail(code) {
                let email = prompt(`Send a notification using the code ${code}. Type the email.`);

                $wire.notify(code, email);
            },
        }
    })
</script>
@endscript
