<div class="p-6 min-w-full leading-normal">
    <x-jet-button wire:click="createShowModal">
        {{ __('Kreiraj reklamu') }}
    </x-jet-button>

    <table class="min-w-full leading-normal">
        <thead>
        <tr>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Slika
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Opis
            </th>

            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Bodovi
            </th>

            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Link
            </th>

            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Datum Kreiranja
            </th>

            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Akcije
            </th>
        </tr>
        </thead>
        <tbody>
        @if ($data->count())
            @foreach($data as $i)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center text-center">
                            <div class="flex-shrink-0 w-20 h-20">
                                {!! $i->image !== null ? "<img class='w-full h-full rounded-full' src='/storage/$i->image' />" : '<p class="text-gray-900 whitespace-no-wrap">Nema slike</p>'  !!}
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $i->desc }}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $i->points }}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $i->url }}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $i->created_at->diffForHumans() }}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                        <x-jet-button wire:click="updateShowModal({{ $i->id }})">
                            {{ __('Uredi') }}
                        </x-jet-button>

                        <x-jet-danger-button wire:click="deleteShowModal({{ $i->id }})">
                            {{ __('Izbriši') }}
                        </x-jet-danger-button>
                    </span>
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
                {{ __('Uredi reklamu') }}
            @else
                {{ __('Snimi reklame') }}
            @endif
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-wrap -mx-2 justify-center">
                @if ($image && strpos($image, 'Temp') && $uploadedNewImage)
                    <p style="flex-basis: 100%; text-align: center;">Pregled slike</p>
                    <div style="flex-basis: 100%; text-align: center">
                        <img src="{{ $image->temporaryUrl() }}" width="200" height="200"
                             style="display: inline-block; margin-top: 20px;">
                    </div>
                @endif

                @if($modelId != null && !strpos($image, 'Temp'))
                    <img src="/storage/{{ $image }}" width="200" height="200">
                @endif
            </div>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="mt-4">
                    <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <x-jet-label for="image" value="{{ __('Slika') }}"/>
                        <input type="file" wire:change="$emit('uploadedNew')" accept="image/x-png,image/gif,image/jpeg"
                               wire:model="image" class=""/>
                        <div>
                            @error('image') <span class="text-sm text-red-500 italic">{{ $message }}</span>@enderror
                        </div>
                        <div x-show="isUploading" style="width: 100%">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>

                {{--                <div class="mt-4 mb-4">--}}
                {{--                    <label class="inline-flex items-center">--}}
                {{--                        <input type="checkbox" {{ $image === null ? 'disabled': '' }} value="{{ $deleteImage }}" wire:change="$emit('deleteImageEvent')" wire.model="deleteImage"  class="form-checkbox h-6 w-6 text-green-500">--}}
                {{--                        <span class="ml-3 text-sm">Da li zelite izbrisati staru sliku?</span>--}}
                {{--                    </label>--}}
                {{--                </div>--}}

                <div class="mt-4">
                    <x-jet-label for="name" value="{{ __('Bodovi') }}"/>
                    <x-jet-input id="points" class="block mt-1 w-full" type="text" name="points" :value="old('points')"
                                 wire:model.debounce.800ms="points"/>
                    @error('points') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-jet-label for="desc" value="{{ __('Opis') }}"/>
                    <x-jet-input id="desc" class="block mt-1 w-full" type="text" name="desc" :value="old('desc')"
                                 wire:model.debounce.800ms="desc"/>
                    @error('desc') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-jet-label for="url" value="{{ __('URL') }}"/>
                    <x-jet-input id="url" class="block mt-1 w-full" type="text" name="url" :value="old('url')"/>
                    @error('url') <span class="error">{{ $message }}</span> @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>

            @if($modelId)
                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
                    {{ __('Uredi reklamu') }}
                </x-jet-danger-button>
            @else
                <x-jet-danger-button wire:click="create" wire:loading.attr="disabled">
                    {{ __('Dodaj novu reklamu') }}
                </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Izbriši rekalmu') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Jeste li sigurni da želite izbrisati svoju reklamu? Nakon što izbrišete svoju reklamu, svi njezini resursi i podaci trajno će se izbrisati.') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Zatvori') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteCategory" wire:loading.attr="disabled">
                {{ __('Izbriši reklamu') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
