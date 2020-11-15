<div class="p-6 min-w-full leading-normal">
    <x-jet-button wire:click="createShowModal">
        {{ __('Create reklame') }}
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
                        <p class="text-gray-900 whitespace-no-wrap">{{ $i->url }}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $i->created_at }}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                        <x-jet-button wire:click="updateShowModal({{ $i->id }})">
                            {{ __('Edit') }}
                        </x-jet-button>

                        <x-jet-danger-button wire:click="deleteShowModal({{ $i->id }})">
                            {{ __('Delete') }}
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
            {{ __('Save new reklame') }}
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-wrap -mx-2 justify-center">
                @if ($image && strpos($image, 'Temp'))
                    Pregled slike:
                    <img src="{{ $image->temporaryUrl() }}" width="100" height="100">
                @endif

                @if($modelId != null && !strpos($image, 'Temp'))
                        <img src="/storage/{{ $image }}" width="100" height="100">
                @endif
            </div>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">

                <div class="mt-4">
                    <x-jet-label for="image" value="{{ __('Slika') }}"/>
                    <input type="file" wire:model="image" class=""/>
                    <div>
                        @error('image') <span class="text-sm text-red-500 italic">{{ $message }}</span>@enderror
                    </div>
                    <div wire:loading wire:target="image" class="text-sm text-gray-500 italic">Uploading...</div>
                </div>

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
                    {{ __('Update reklame') }}
                </x-jet-danger-button>
            @else
                <x-jet-danger-button wire:click="create" wire:loading.attr="disabled">
                    {{ __('Add new reklame') }}
                </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Ads') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete your reklame? Once your reklame is deleted, all of its resources and data will be permanently deleted.') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteCategory" wire:loading.attr="disabled">
                {{ __('Delete Ads') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
