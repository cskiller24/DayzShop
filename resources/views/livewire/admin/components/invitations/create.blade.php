<div id="{{ $modalId }}" tabindex="-1" aria-hidden="true" wire:ignore.self
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create Invitation
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="flex">
                    <div>
                        <div class="relative max-w-sm">
                            <input type="date"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary-500 focus:border-tertiary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-tertiary-500 dark:focus:border-tertiary-500"
                                placeholder="Select date" wire:model="date" min="{{ date('Y-m-d') }}">
                            @if ($errors->has('date'))
                                <p class="text-sm text-red-700 ">
                                    {{ $errors->first('date') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="max-w-[8rem] mx-auto ms-3">
                            <div class="relative">
                                <input type="time" id="time"
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary-500 focus:border-tertiary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-tertiary-500 dark:focus:border-tertiary-500"
                                    min="09:00" max="18:00" wire:model="time" required  />
                                @if ($errors->has('time'))
                                    <p class="text-sm text-red-700 ms-3">
                                        {{ $errors->first('time') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <select id="countries" wire:model="type"
                            class="ms-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose Invitation Type</option>
                            <option value="{{ \App\Enums\InvitationTypes::STORE->value }}">Store</option>
                            <option value="{{ \App\Enums\InvitationTypes::COURIER->value }}">Courier</option>
                        </select>
                        @if ($errors->has('type'))
                            <p class="text-sm text-red-700 ms-3">
                                {{ $errors->first('type') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <x-base::button reversed wire:click="save">Create</x-base::button>
            </div>
        </div>
    </div>
</div>
@assets
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
@endassets
