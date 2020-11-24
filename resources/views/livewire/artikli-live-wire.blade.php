<div class="w-full">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <style>
        nav {
            margin-top: 15px;
        }
    </style>

    <div class="relative">
        <div wire:model="isOpen" wire:loading.attr="disabled"
             class="bg-indigo-600 flash-message w-full absolute left-0 w-full @if ($isOpen) visible @else invisible @endif"
             style="top: -64px;">
            <div class="container mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <span class="flex p-2 rounded-lg bg-indigo-800">
                          <!-- Heroicon name: speakerphone -->
                          <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                          </svg>
                        </span>
                        <p class="ml-3 font-medium text-white truncate"><span class="hidden md:inline">{{ $messageText }}</span></p>
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                        <button type="button" wire:click="$set('isOpen', false)"
                                class="-mr-1 flex p-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                            <span class="sr-only">Dismiss</span>
                            <!-- Heroicon name: x -->
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-12 mx-auto">
        <div class="flex flex-wrap py-3 px-3 sm:px-6 lg:px-8">
            <x-jet-button wire:click="createShowModal">
                {{ __('Kreiraj artikal') }}
            </x-jet-button>
            <div class="flex flex-col w-full mt-5">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            @if(count($data))
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Naziv
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Cijena
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Sniženje
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Kategorija
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Aktivan
                                        </th>

                                        <th scope="col" class="px-6 py-3 bg-gray-800">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($data as $d)
                                        <tr>
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                         src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                                         alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $d->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $d->brand }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                                            <div class="text-sm text-gray-900">KM {{ $d->price }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                                            <div class="text-sm text-gray-500">{!! $d->isOnSale ? '<span class="uppercase px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Da</span>': '<span class="uppercase px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-green-800">Ne</span>' !!}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                            {{ $d->category->name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="text-sm text-gray-500">{!! $d->isActive ? '<span class="uppercase px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Da</span>': '<span class="uppercase px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-green-800">Ne</span>' !!}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-indigo-600 hover:text-indigo-900" wire:click="updateShowModal({{ $d->id }})">Uredi</button> |
                                            <button class="text-indigo-600 hover:text-indigo-900" wire:click="deleteShowModal({{ $d->id }})">Izbriši</button>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                {{ $data->links() }}
                            @else
                                <h1 class="text-center">Nemate dodatih artikala</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <x-jet-dialog-modal wire:model="displayingToken" :maxWidth="'modal-full'">
                <x-slot name="title">
                    @if($artikalId)
                        {{ __('Uredi artikal') }}
                    @else
                        {{ __('Dodaj artikal') }}
                    @endif
                </x-slot>

                <x-slot name="content">

                    <div class="flex flex-wrap -mx-2 justify-center">
                        @if( !empty( $images ) && $artikalId == null )
                        <p style="flex-basis: 100%; text-align: center;">Pregled slika</p>
                            <div style="flex-basis: 100%; text-align: center">
                                @foreach($images as $image)
                                <img src="{{ $image->temporaryUrl() }}" width="200" height="200"
                                     style="display: inline-block; margin-top: 20px;">
                                @endforeach
                            </div>
                        @endif

                        @if($artikalId != null && count($images))
                            @foreach($images as $image)
                                <div class="mr-4 text-center">
                                    <div class="mb-4">
                                        @if(isset($image->url))
                                         <img src="/storage/{{ $image->url }}" width="200" height="200">
                                        @else
                                            <img src="{{ $image->temporaryUrl() }}" width="200" height="200">
                                        @endif
                                    </div>
                                    @if(isset($image->url))
                                    <x-jet-danger-button wire:click="removeImage({{ $image->id }})" wire:loading.attr="disabled">
                                        {{ __('Izbriši sliku') }}
                                    </x-jet-danger-button>
                                    @else
                                        <p>Pregled slike</p>
                                    @endif

                                </div>
                            @endforeach
                        @endif
                    </div>

                    <form wire:submit.prevent="submit" enctype="multipart/form-data" id="addArticle">
                        <div class="mt-4">
                            <div
                                x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <x-jet-label value="{{ __('Slike') }}"/>
                                <input id="{{ $fileId }}" type="file" wire:change="$emit('uploadedNew')" multiple accept="image/x-png,image/gif,image/jpeg"
                                       wire:model="images" class=""/>
                                <div>
                                    @error('images.*') <span class="text-sm text-red-500 italic">{{ $message }}</span>@enderror
                                </div>
                                <div x-show="isUploading" style="width: 100%">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="mt-4">
                                <x-jet-label for="name" value="{{ __('Naziv artikla') }}"/>
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="name"
                                             :value="old('name')" />
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="brand" value="{{ __('Brand') }}"/>
                                <x-jet-input id="brand" class="block mt-1 w-full" type="text" name="brand" wire:model="brand"
                                             :value="old('brand')"/>
                                @error('brand') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="price" value="{{ __('Cijena') }}"/>
                                <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price" wire:model="price"
                                             :value="old('price')"/>
                                @error('price') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-2 col-span-2">
                                <x-jet-label for="desc" value="{{ __('Opis') }}"/>
                                <textarea class="form-textarea mt-1 block w-full" value="old(desc)" rows="3" name="desc" wire:model="desc"
                                          placeholder="Unesite opis ovdje."></textarea>
                                @error('desc') <span class="error">{{ $message }}</span> @enderror

                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="mt-4">
                                <x-jet-label for="size" value="{{ __('Veličina') }}"/>
                                <x-jet-input id="size" class="block mt-1 w-full" type="text" name="size" wire:model="size"
                                             :value="old('size')"/>
                                @error('size') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="color" value="{{ __('Boja') }}"/>
                                <x-jet-input id="color" class="block mt-1 w-full" type="text" name="color" wire:model="color"
                                             :value="old('color')"/>
                                @error('color') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="category_id" value="{{ __('Kategorija') }}"/>
                                <select id="category_id" name="category_id"  wire:model="category_id"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="0">Odaberite kategoriju</option>
                                @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categoryId') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="isActive" value="{{ __('Aktivan') }}"/>
                                <select wire:model="isActive"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="1">Aktivan</option>
                                    <option value="0">Neaktivan</option>
                                </select>
                                @error('isActive') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="isOnSale" value="{{ __('Snizenje') }}"/>
                                <select wire:model="isOnSale"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="0">Ne</option>
                                    <option value="1">Da</option>
                                </select>
                                @error('isOnSale') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="profitMake" value="{{ __('Ima li zarade') }}"/>
                                <select wire:model="profitMake"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="1">Da</option>
                                    <option value="0">Ne</option>
                                </select>
                                @error('profitMake') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                        {{ __('Zatvori') }}
                    </x-jet-secondary-button>

                    @if($artikalId)
                        <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
                            {{ __('Uredi artikal') }}
                        </x-jet-danger-button>
                    @else
                        <x-jet-danger-button wire:click="create" wire:loading.attr="disabled">
                            {{ __('Snimi artikal') }}
                        </x-jet-danger-button>
                    @endif
                </x-slot>
            </x-jet-dialog-modal>

            <!-- Delete User Confirmation Modal -->
            <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
                <x-slot name="title">
                    {{ __('Izbriši Artikal') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Jeste li sigurni da želite izbrisati artikal? Nakon što se artikal izbriše, svi resursi i podaci trajno će se izbrisati.') }}
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')"
                                            wire:loading.attr="disabled">
                        {{ __('Zatvori') }}
                    </x-jet-secondary-button>

                    <x-jet-danger-button class="ml-2" wire:click="deleteCategory" wire:loading.attr="disabled">
                        {{ __('Izbriši artikal') }}
                    </x-jet-danger-button>
                </x-slot>
            </x-jet-dialog-modal>
        </div>
    </div>
</div>
