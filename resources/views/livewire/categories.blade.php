<div class="p-6 min-w-full leading-normal">
    <style>
        html,
        body {
            height: 100%;
        }

        @media (min-width: 640px) {
            table {
                display: inline-table !important;
            }

            thead tr:not(:first-child) {
                display: none;
            }
        }

        td:not(:last-child) {
            border-bottom: 0;
        }

        th:not(:last-child) {
            border-bottom: 2px solid rgba(0, 0, 0, .1);
        }
    </style>

    <x-jet-button wire:click="createShowModal">
        {{ __('Kreiraj kategoriju') }}
    </x-jet-button>

    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
    <thead class="text-white">
        @if ($data->count())
            @foreach($data as $i)
            <tr class="bg-gray-800 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                <th class="p-3 text-left" width="200px">Slika</th>
                <th class="p-3 text-left">Naziv</th>
                <th class="p-3 text-left" width="220px">Akcije</th>
            </tr>
            @endforeach
        @endif
        </thead>
        <tbody>
        @if ($data->count())
            @foreach($data as $i)
                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                    <td class="border-grey-light border hover:bg-gray-100 p-3">
                        @if (!App::environment('production'))
                            {!! $i->image !== null ? "<img class='w-50 h-50 rounded-full' width='130' height='130' src='/storage/$i->image' />" : '<p class="text-gray-900 whitespace-no-wrap">Nema slike</p>'  !!}
                        @else
                            {!! $i->image !== null ? "<img class='w-50 h-50 rounded-full' width='130' height='130' src='/public/storage/$i->image' />" : '<p class="text-gray-900 whitespace-no-wrap">Nema slike</p>'  !!}
                        @endif
                    </td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{ $i->name }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">
                        <x-jet-button wire:click="updateShowModal({{ $i->id }})">
                            {{ __('Uredi') }}
                        </x-jet-button>

                        <x-jet-danger-button wire:click="deleteShowModal({{ $i->id }})">
                            {{ __('Izbriši') }}
                        </x-jet-danger-button>

                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="" colspan="3">Nema rezultata</td>
            </tr>
        @endif
        </tbody>
    </table>

    {{ $data->links() }}

    <x-jet-dialog-modal wire:model="displayingToken">
        <x-slot name="title">
            @if($modelId)
                {{ __('Uredi kategoriju') }}
            @else
                {{ __('Dodaj kategoriju') }}
            @endif
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-wrap -mx-2 justify-center">
                @if ($image  && $uploadedNewImage)
                    <p style="flex-basis: 100%; text-align: center;">Pregled slike</p>
                    <div style="flex-basis: 100%; text-align: center">
                        <img src="{{ $image->temporaryUrl() }}" width="200" height="200"
                             style="display: inline-block; margin-top: 20px;">
                    </div>
                @endif

                @if($modelId != null)
                        @if (!App::environment('production'))
                            <img src="/storage/{{ $image }}" width="200" height="200">
                        @else
                            <img src="/public/storage/{{ $image }}" width="200" height="200">

                        @endif
                @endif
            </div>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="mt-4">
                    <x-jet-label for="name" value="{{ __('Naziv kategorije') }}"/>
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                 wire:model.debounce.800ms="name"/>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <x-jet-label for="image" value="{{ __('Slika (opcionalno)') }}"/>
                        <input id="{{ $fileId }}" type="file" wire:change="$emit('uploadedNew')" accept="image/x-png,image/gif,image/jpeg"
                               wire:model="image" class=""/>
                        <div>
                            @error('image') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div x-show="isUploading" style="width: 100%">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('Zatvori') }}
            </x-jet-secondary-button>

            @if($modelId)
                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
                    {{ __('Uredi kategoriju') }}
                </x-jet-danger-button>
            @else
                <x-jet-danger-button wire:click="create" wire:loading.attr="disabled">
                    {{ __('Snimi kategoriju') }}
                </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Izbriši kategoriju') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Jeste li sigurni da želite izbrisati svoju kategoriju? Nakon što se kategorija izbriše, svi njezini resursi i podaci trajno će se izbrisati.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Zatvori') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteCategory" wire:loading.attr="disabled">
                {{ __('Izbriši kategoriju') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
