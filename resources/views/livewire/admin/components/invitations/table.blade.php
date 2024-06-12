<div class="">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Code
                </th>
                <th scope="col" class="px-6 py-3">
                    Expires at
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invites as $invite)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        id="{{ $invite->code }}" @click="$clipboard('{{ $invite->code }}')">
                        {{ $invite->code }}
                    </th>
                    <td class="px-6 py-4" title="{{ $invite->expire_at->diffForHumans() }}">
                        {{ $invite->expire_at->toString() }}
                    </td>
                    <td class="px-6 py-4">
                        @switch($invite->type)
                            @case(\App\Enums\InvitationTypes::COURIER)
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Courier</span>
                            @break

                            @case(\App\Enums\InvitationTypes::STORE)
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Store</span>
                            @break

                            No Category

                            @default
                        @endswitch
                    </td>
                    <td class="px-6 py-4">
                        {{ $invite->status }}
                    </td>
                    <td class="px-6 py-4 flex">
                        <x-heroicon-m-document-duplicate @click="$clipboard('{{ $invite->url }}')" class="h-5 dark:text-primary text-secondary cursor-pointer" />
                        <x-heroicon-o-trash wire:click="delete('{{ $invite->code }}')"
                            class="h-5 text-red-500 cursor-pointer" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <h1 class="text-2xl text-center mt-10">
                            No Invitations
                        </h1>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@script
    <script>
        Alpine.magic('clipboard', () => {
            return function (subject) {
                const textArea = document.createElement('textarea');
                textArea.value = subject;
                textArea.style.opacity = 0;
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                alert('Code copied');
            }
        })
    </script>
@endscript
