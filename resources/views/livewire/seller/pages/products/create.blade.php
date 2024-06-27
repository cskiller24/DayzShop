<div class="card border-light">
    <div class="card-body">
        <div class="card-title">Create Product</div>

        <form wire:submit="create">
            <div class="mb-2">
                <x-base.label>Name</x-base.label>
                <x-base.text-input placeholder="Enter product name" errorKey="name" wire:model="description"/>
                <x-base.error key="name"/>
            </div>
            <div class="mb-2">
                <x-base.label>Description</x-base.label>
                <textarea wire:model="description"
                          @class(['form-control', 'is-invalid' => $errors->has('description')]) rows="5"></textarea>
                <x-base.error key="description"/>
            </div>

            {{--            TODO LATER --}}
            {{--            <div class="mb-3" x-data="{--}}
            {{--                specification : @entangle('specification'),--}}
            {{--                count: 1,--}}
            {{--                get numbers() {--}}
            {{--                    return Array.from({length: this.count}, (_, i) => i + 1);--}}
            {{--                }--}}
            {{--            }">--}}
            {{--                <div class="d-flex justify-content-between">--}}
            {{--                    <div>--}}
            {{--                        <x-base.label>Specifications</x-base.label>--}}
            {{--                    </div>--}}
            {{--                    <div>--}}
            {{--                        <x-base.button type="button" @click="count++">--}}
            {{--                            <i class="ti ti-plus"></i>--}}
            {{--                        </x-base.button>--}}

            {{--                        <x-base.button class="btn-danger" type="button" @click="if (count > 1) count--">--}}
            {{--                            <i class="ti ti-minus"></i>--}}
            {{--                        </x-base.button>--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            {{--                             !! TODO !! --}}
            {{--                <template x-for="(number, index) in numbers" :key="index">--}}
            {{--                    <div class="d-flex mb-1">--}}
            {{--                        <input class="form-control"--}}
            {{--                               x-model="specification[index].details"--}}
            {{--                               placeholder="Key"--}}
            {{--                        />--}}
            {{--                        <input class="form-control"--}}
            {{--                               placeholder="Value"--}}
            {{--                               x-model="specification[index].key"--}}
            {{--                        />--}}
            {{--                    </div>--}}
            {{--                </template>--}}
            {{--            </div>--}}

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <x-base.label>Specifications</x-base.label>
                    </div>
                    <div>
                        <x-base.button type="button" wire:click="addSpecification">
                            <i class="ti ti-plus"></i>
                        </x-base.button>


                    </div>
                </div>
                @foreach($specifications as $index => $specification)
                    <div class="d-flex mb-1" wire:key="{{ $index }}">
                        <input class="form-control"
                               wire:model="specifications.{{ $index }}.key"
                               placeholder="Key"
                        />
                        <input class="form-control"
                               placeholder="Value"
                               wire:model="specifications.{{ $index }}.value"
                        />
                        <x-base.button class="btn-danger" type="button"
                                       wire:click="removeSpecification('{{ $index }}')">
                            <i class="ti ti-minus"></i>
                        </x-base.button>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-end">
                <x-base.button type="submit" class="border-light">
                    <i class="ti ti-plus"></i>Save
                </x-base.button>
            </div>
        </form>
    </div>
</div>

