<div class="p-6 min-w-full leading-normal">
    <div class="px-5">
        <x-jet-button wire:click="createShowModal">
            {{ __('Kreiraj prodavnicu') }}
        </x-jet-button>
    </div>

        @if ($data->count())
            @foreach($data as $i)
                <section class="text-gray-700 body-font">
                    <div class="container mx-auto flex flex-wrap px-5 py-4 md:flex-row flex-col items-center">
                        <div class="lg:flex-grow md:w-1/2 sm:pl-0 md:pl-0 flex flex-col md:items-start md:text-left items-center text-center">
                            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900"><a href="#">{{ $i->name }}</a></h1>
                            <p class="mb-8 leading-relaxed"><b>Gratis poeni: </b>{{ $i->points }}
                                <br>
                                <b>Dostava: </b>{!! $i->freeDelivery == 0 ? '<span class="inline-block bg-red-200 text-teal-800 px-2 rounded-full uppercase font-semibold text-xl tracking-wide">Dostava se plaća (' . $i->orderPaid . 'KM )</span>' : '<span class="inline-block bg-green-200 text-teal-800 text-xl px-2 rounded-full uppercase font-semibold tracking-wide">Besplatna dostava</span>'  !!}
                            </p>
                            <p class="mb-8 leading-relaxed"><b>Radno vrijeme: </b>{{  substr($i->startTime, 0, -3) }} - {{  substr($i->endTime, 0, -3) }} {!! $i->isClosed == 0 ? '<span class="inline-block bg-red-200 text-teal-800 px-2 rounded-full uppercase font-semibold text-xl tracking-wide">Zatvoreno</span>' : '<span class="inline-block bg-green-200 text-teal-800 text-xl px-2 rounded-full uppercase font-semibold tracking-wide">Otvoreno</span>'  !!}

                            <div class="flex justify-center mb-5">
                                <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" wire:click="updateShowModal({{ $i->id }})">{{ __('Uredi') }}</button>
                                <button class="ml-4 inline-flex text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg" wire:click="deleteShowModal({{ $i->id }})">{{ __('Izbriši') }}</button>
                                <a href="/prodavnice/{{ $i->id }}/artikli" class="ml-4 inline-flex text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg">{{ __('Artikli') }}</a>
                            </div>
                        </div>
                        <a href="#" class="lg:max-w-sm lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0 order-first md:order-last">
                            <img class="object-cover object-center rounded" alt="hero" src="/storage/{{ $i->image }}">
                        </a>
                    </div>
                </section>
            @endforeach
        @else
            <p class="mb-8 leading-relaxed">Nema rezultata</p>
        @endif

    {{ $data->links() }}

    <x-jet-dialog-modal wire:model="displayingToken">
        <x-slot name="title">
            @if($modelId)
                {{ __('Uredi prodavnicu') }}
            @else
                {{ __('Snimi prodavnicu') }}
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
                    <img src="/storage/{{ $image }}" width="300" height="300">
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

                <div class="mt-4">
                    <x-jet-label for="name" value="{{ __('Naziv prodavnice') }}"/>
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                 wire:model.debounce.800ms="name"/>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>


                <div class="mt-4">
                    <x-jet-label for="points" value="{{ __('Bodovi') }}"/>
                    <x-jet-input id="points" class="block mt-1 w-full" type="text" name="points" :value="old('points')"
                                 wire:model.debounce.800ms="points"/>
                    @error('points') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4 mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" {{ $freeDelivery == 0 ? '': 'checked' }} wire:click="$toggle('freeDelivery')"  wire.model="freeDelivery"  class="form-checkbox h-6 w-6 text-green-500">
                        <span class="ml-3 text-sm">Besplatna dostava?</span>
                    </label>
                </div>

                <div class="mt-4">
                    <x-jet-label for="points" value="{{ __('Početak radnog vremena') }}"/>
                    <x-jet-input id="points" class="block mt-1 w-full" placeholder="08:00:00" type="text" name="startTime" :value="old('startTime')"
                                 wire:model.debounce.800ms="startTime"/>
                    @error('startTime') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-jet-label for="points" value="{{ __('Kraj radnog vremena') }}"/>
                    <x-jet-input id="points" class="block mt-1 w-full" placeholder="16:30:00" type="text" name="endTime" :value="old('endTime')"
                                 wire:model.debounce.800ms="endTime"/>
                    @error('endTime') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-jet-label for="points" value="{{ __('Početak radnog vremena (nedelja)') }}"/>
                    <x-jet-input id="points" class="block mt-1 w-full" placeholder="08:00:00" type="text" name="startTimeSunday" :value="old('startTimeSunday')"
                                 wire:model.debounce.800ms="startTimeSunday"/>
                    @error('startTimeSunday') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-jet-label for="points" value="{{ __('Kraj radnog vremena (nedelja)') }}"/>
                    <x-jet-input id="points" class="block mt-1 w-full" placeholder="16:30:00" type="text" name="endTimeSunday" :value="old('endTimeSunday')"
                                 wire:model.debounce.800ms="endTimeSunday"/>
                    @error('endTimeSunday') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4 mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" {{ $isClosed == 0 ? '': 'checked' }} wire:click="$toggle('isClosed')"  wire.model="isClosed"  class="form-checkbox h-6 w-6 text-green-500">
                        <span class="ml-3 text-sm">Da li želite zatvoriti prodavnicu sad?</span>
                    </label>
                </div>

                <p>Preporučujem da prodavnica ostane zatvorena dok ne završite sa dodavanjem artikala.</p>

            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('Zatvori') }}
            </x-jet-secondary-button>

            @if($modelId)
                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
                    {{ __('Uredi prodavnicu') }}
                </x-jet-danger-button>
            @else
                <x-jet-danger-button wire:click="create" wire:loading.attr="disabled">
                    {{ __('Dodaj novu prodavnicu') }}
                </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Izbriši prodavnicu') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Jeste li sigurni da želite izbrisati svoju prodavnicu? Nakon što izbrišete svoju prodavnicu, svi njezini resursi i podaci trajno će se izbrisati.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Zatvori') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteCategory" wire:loading.attr="disabled">
                {{ __('Izbriši prodavnicu') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
