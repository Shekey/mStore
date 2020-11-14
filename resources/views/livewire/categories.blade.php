<div class="p-6">
    <x-jet-button wire:click="createShowModal">
        {{ __('Create Category') }}
    </x-jet-button>


    <table>
        <thead>
            <tr>
                <th class="px-4 py-2 text-xs leading-4 text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-4 py-2 text-xs leading-4 text-gray-500 uppercase tracking-wider">Photo</th>
                <th class="px-4 py-2 text-xs leading-4 text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
        @if ($data->count())
            @foreach($data as $i)
                <tr>
                    <td class="px-4 py-2 text-sm">{{ $i->name }}</td>
                    <td class="px-4 py-2 text-sm"><a href="{{ $i->image }}">Link for image</a></td>
                    <td class="px-4 py-2 text-sm">
                        <x-jet-button wire:click="updateShowModal({{ $i->id }})">
                            {{ __('Edit') }}
                        </x-jet-button>

                        <x-jet-danger-button wire:click="deleteShowModal({{ $i->id }})">
                            {{ __('Delete') }}
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

    <x-jet-dialog-modal wire:model="displayingToken">
        <x-slot name="title">
            {{ __('Save new category') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="submit" enctype="multipart/form-data">
            <div class="mt-4">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" wire:model.debounce.800ms="name" />
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>


                <div class="mt-4">
                    <x-jet-label for="image" value="{{ __('Image (optional)') }}" />
                    <input type="file" wire:model="image" class="" />
                    <div>
                        @error('image') <span class="text-sm text-red-500 italic">{{ $message }}</span>@enderror
                    </div>
                    <div wire:loading wire:target="image" class="text-sm text-gray-500 italic">Uploading...</div>
                </div>
            </form>

            <div class="flex flex-wrap -mx-2">
                @if ($image)
                    Photo Preview:
                    <img src="{{ $image->temporaryUrl() }}">
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>

            @if($modelId)
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
                {{ __('Update category') }}
            </x-jet-danger-button>
            @else
                <x-jet-danger-button wire:click="create" wire:loading.attr="disabled">
                    {{ __('Add new category') }}
                </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
