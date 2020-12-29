<div class="w-full admin-articles">
    <style>
        nav {
            margin-top: 15px;
        }
    </style>

    <div class="relative">
        <div wire:model="isOpen" wire:loading.attr="disabled"
             class="bg-orange-600 flash-message w-full absolute left-0 w-full @if ($isOpen) visible @else invisible @endif"
             style="top: -64px;">
            <div class="container mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <span class="flex p-2 rounded-lg bg-orange-800">
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
                                class="-mr-1 flex p-2 rounded-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
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
    <div class="my-12 mx-auto">
        <div class="mb-10 lg:w-1/2 w-full mx-auto">
            <div class="search__container">
                <input class="search__input" type="text" wire:model.lazy="search"
                       wire:keydown.enter="searchArticle($event.target.value)"
                       placeholder="Pretražite artikle (enter)">
            </div>
        </div>
        <div class="px-3 sm:px-6 lg:px-8 flex justify-center items-center">
            <div class="relative inline-block text-left">
                <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-black text-sm font-medium text-white hover:bg-white-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" wire:click="resetFilters">
                    Resetuj filtere
                </button>
            </div>
            <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false" class="relative inline-block text-left ml-2">
                <div>
                    <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true" x-bind:aria-expanded="open">
                        Filtriraj artikle
                        <svg class="-mr-1 ml-2 h-5 w-5" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <div x-show="open" x-description="Dropdown panel, show/hide based on dropdown state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <a wire:click="$set('filter', '')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $filter === '' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Prikaži sve artikle</a>
                        <a wire:click="$set('filter', 'active')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $filter === 'active' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Aktivni artikli</a>
                        <a wire:click="$set('filter', 'inactive')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $filter === 'inactive' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Neaktivni artikli</a>
                        <a wire:click="$set('filter', 'sale')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $filter === 'sale' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Akcijski artikli</a>
                        <a wire:click="$set('filter', 'profitMake')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $filter === 'profitMake' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Artikli sa zaradom</a>
                        <a wire:click="$set('filter', 'notProfitMake')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $filter === 'notProfitMake' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Artikli bez zarade</a>
                    </div>
                </div>
            </div>

            <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false" class="relative inline-block text-left ml-2">
                <div>
                    <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true" x-bind:aria-expanded="open">
                        Sortiraj artikle
                        <svg class="-mr-1 ml-2 h-5 w-5" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <div x-show="open" x-description="Dropdown panel, show/hide based on dropdown state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <a wire:click="$set('sort', '')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $sort === '' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Najnoviji artikli</a>
                        <a wire:click="$set('sort', 'asc')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $sort === 'asc' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Najstariji artikli</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap py-3 px-3 sm:px-6 lg:px-8">
            <x-jet-button wire:click="createShowModal">
                {{ __('Kreiraj artikal') }}
            </x-jet-button>
            <div class="flex flex-col w-full mt-5">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            @if(count($data))
                                <table class="min-w-full divide-y divide-gray-200" style="overflow: auto; width: 100%;">
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
                                                    @if (!App::environment('production'))
                                                        <img class="h-10 w-10 rounded-full object-cover"
                                                             src="{{ count($d->images) > 0 ? "/storage/". $d->images[0]->url : 'https://dummyimage.com/400x400' }}"
                                                             alt="">
                                                    @else
                                                        <img class="h-10 w-10 rounded-full object-cover"
                                                             src="{{ count($d->images) > 0 ? "/public/storage/". $d->images[0]->url : 'https://dummyimage.com/400x400' }}"
                                                             alt="">
                                                    @endif

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
                                            <button class="text-orange-600 hover:text-orange-900" wire:click="updateShowModal({{ $d->id }})">Uredi</button> |
                                            <button class="text-orange-600 hover:text-orange-900" wire:click="deleteShowModal({{ $d->id }})">Izbriši</button>
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
                                            @if (!App::environment('production'))
                                                <img src="/storage/{{ $image->url }}" width="200" height="200">
                                            @else
                                                <img src="/public/storage/{{ $image->url }}" width="200" height="200">
                                            @endif
                                        @else
                                            @if (!App::environment('production'))
                                                <img src="{{ $image->temporaryUrl() }}" width="200" height="200">
                                            @else
                                                <img src="/public/{{ $image->temporaryUrl() }}" width="200" height="200">
                                            @endif

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
                                <input id="{{ $fileId }}" type="file" wire:change="$emit('uploadedNew')" multiple accept="image/x-png,image/jpeg"
                                       wire:model="images" class=""/>
                                <div>
                                    @error('images.*') <span class="text-red-500">{{ $message }}</span>@enderror
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
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="category_id" value="{{ __('Kategorija') }}"/>
                                <select  wire:model="category_id"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="0">Odaberite kategoriju</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4">
                                <x-jet-label for="price" value="{{ __('Cijena') }}"/>
                                <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price" wire:model="price"
                                             :value="old('price')"/>
                                @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">

                            <div class="mt-4">
                                <x-jet-label for="isActive" value="{{ __('Aktivan') }}"/>
                                <select wire:model="isActive"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="1">Aktivan</option>
                                    <option value="0">Neaktivan</option>
                                </select>
                                @error('isActive') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4">
                                <x-jet-label for="profitMake" value="{{ __('Ima li zarade') }}"/>
                                <select wire:model="profitMake"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="1">Da</option>
                                    <option value="0">Ne</option>
                                </select>
                                @error('profitMake') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="size" value="{{ __('Veličina') }}"/>
                                <x-jet-input id="size" class="block mt-1 w-full" type="text" name="size" wire:model="size"
                                             :value="old('size')"/>
                                @error('size') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="brand" value="{{ __('Brand') }}"/>
                                <x-jet-input id="brand" class="block mt-1 w-full" type="text" name="brand" wire:model="brand"
                                             :value="old('brand')"/>
                                @error('brand') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="color" value="{{ __('Boja') }}"/>
                                <x-jet-input id="color" class="block mt-1 w-full" type="text" name="color" wire:model="color"
                                             :value="old('color')"/>
                                @error('color') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-2 col-span-2">
                                <x-jet-label for="desc" value="{{ __('Opis') }}"/>
                                <textarea class="form-textarea mt-1 block w-full" value="old(desc)" rows="3" name="desc" wire:model="desc"
                                          placeholder="Unesite opis ovdje."></textarea>
                                @error('desc') <span class="text-red-500">{{ $message }}</span> @enderror

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
