<div class="bg-blue-lightest py-10 wrapper container cart-list mx-auto px-10" style="min-height: calc(100vh - 82px);">
    <style>
        [type="date"] {
            background:#fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
        }
        [type="date"]::-webkit-inner-spin-button {
            display: none;
        }
        [type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0;
        }

        button[disabled]:hover {
            cursor: not-allowed;
        }

        button[disabled] {
           opacity: 0.3;
        }

        label {
            display: block;
        }
        input {
            border: 1px solid #c4c4c4;
            border-radius: 5px;
            background-color: #fff;
            padding: 3px 5px;
            box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
            width: 190px;
        }
    </style>
    <div class="mb-10">
        <div class="relative inline-block text-left">
            <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-black text-sm font-medium text-white hover:bg-white-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" wire:click="resetFilters">
                Resetuj filtere
            </button>

            @if(auth()->user()->isAdmin)
                <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-black text-sm font-medium text-white hover:bg-white-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500 {{ !$market ? 'disabled' : '' }}" {{ !$market ? 'disabled' : '' }} wire:click="exportCSV">
                    Export u Excel
                </button>
            @endif
        </div>
        @if(auth()->user()->isAdmin)
        <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false" class="relative block sm:inline-block text-left mt-2">
            <div>
                <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true" x-bind:aria-expanded="open">
                    Odaberi radnju
                    <svg class="-mr-1 ml-2 h-5 w-5" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div x-show="open" x-description="Dropdown panel, show/hide based on dropdown state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" style="z-index: 12;">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <a wire:click="$set('market', '')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $market == '' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Sve radnje</a>

                    @foreach($markets as $mar)
                        <a wire:click="$set('market', {{ $mar->id }})" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $mar->id === $market }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">{{ $mar->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false" class="relative inline-block text-left mt-2" style="z-index: 11;">
            <div>
                <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true" x-bind:aria-expanded="open">
                    Filtriraj narudžbe
                    <svg class="-mr-1 ml-2 h-5 w-5" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div x-show="open" x-description="Dropdown panel, show/hide based on dropdown state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <a wire:click="$set('filter', '')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $filter === '' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Prikaži sve narudže</a>
                    <a wire:click="$set('filter', 'active')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $filter === 'active' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Aktivne narudžbe</a>
                    <a wire:click="$set('filter', 'inactive')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $filter === 'inactive' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Završene narudžbe</a>
                </div>
            </div>
        </div>

        <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false" class="relative inline-block text-left mt-2" style="z-index: 10;">
            <div>
                <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true" x-bind:aria-expanded="open">
                    Sortiraj narudžbe
                    <svg class="-mr-1 ml-2 h-5 w-5" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div x-show="open" x-description="Dropdown panel, show/hide based on dropdown state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <a wire:click="$set('sort', '')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $sort === '' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Najnovije narudžbe</a>
                    <a wire:click="$set('sort', 'asc')" @click="open = !open" role="button" class="block px-4 py-2 text-sm text-gray-400 {{ $sort === 'asc' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900" role="menuitem">Najstarije narudžbe</a>
                </div>
            </div>
        </div>
        @if(auth()->user()->isAdmin)
            <div class="relative inline-block text-left mt-2">
                <label for="startFrom">Filtriraj od</label>
                <input type="date" wire:model="startFrom" name="startFrom" id="startFrom">
            </div>
            <div class="relative inline-block text-left mt-2">
                <label for="startTo">Filtriraj do</label>
                <input type="date" wire:model="startTo" name="startTo" id="startTo">
            </div>
        @endif
        <input type="hidden" name="filters" id="filtersHidden" value="{{ $filter }}">
        <input type="hidden" name="sort" id="sortHidden" value="{{ $sort }}">
    </div>
    <div class="flex flex-wrap">

        @foreach($orders as $key=>$order)
            <div class="flex flex-col lg:w-1/3 mb-8 px-2">
            <img src="/assets/logo.png" alt="Logo image"
                 class="w-full object-contain object-center rounded-lg shadow-md"
                 style="border: 2px solid #f58b1e; border-radius: 10px;">

                @if(auth()->user()->isAdmin && Carbon\Carbon::now()->diffInDays( $order->created_at ) < 2 )
                    <div
                       class="p-2 flex rounded-full {{ $order->isOrdered ? 'bg-green-600' : 'bg-orange-600' }} cursor-pointer text-white ml-auto hover:text-white hover:bg-orange-500 focus:outline-none focus:bg-orange-500"
                       style="width: 36px; margin-right: 30px; margin-top: -15px; z-index: 100" wire:click.stop="toggleOrderFinished({{ $order->id }}, {{ $order->isOrdered }})">
                        @if($order->isOrdered)
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @endif
                    </div>
                @endif
            <a href="/narudzbe/{{ $order->id }}" class="relative px-4 -mt-16">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-baseline">
                      <span
                          class="bg-orange-200 text-orange-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                        {{ $order->created_at->diffForhumans() }}
                      </span>

                        <span
                            class="{{ $order->isOrdered ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}  text-xs px-2 inline-block rounded-full uppercase font-semibold tracking-wide ml-4">
                        {{ $order->isOrdered ? 'Završeno' : 'Aktivna' }}
                      </span>
                    </div>
                    <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">Narudžba # {{ $order->id }}</h4>

                    <div class="mt-1">
                        {{ $order->total }}
                        <span class="text-gray-600 text-sm">KM</span>
                    </div>
                    <div class="mt-4">
                        @if(auth()->user()->isAdmin)<p class="text-black text-md font-semibold mb-2">{{ $order->user !== null ? $order->user->name : "NN KORISNIK" }} </p>@endif
                        <span class="text-orange-600 text-md font-semibold">{{ count($order->orderproduct) }} {{ count($order->orderproduct) === 1 ? 'Artikal' : 'Artikala' }} </span>
                       @if($order->isOrdered) <span class="text-sm text-gray-600">(dostavljeno za {{ (new \Carbon\Carbon($order->updated_at))->diff(new \Carbon\Carbon($order->created_at))->format('%h sati i %i min') }})</span>@endif
                    </div>
                </div>
            </a>

        </div>
        @endforeach

        @if(!count($orders))
            <h2 class="text-3xl sm:text-5xl lg:text-6xl text-center leading-none font-extrabold text-gray-900 tracking-tight mb-8 flex items-center justify-center" style="height: calc(100vh - 300px); flex: 1;">Nema narudžbi</h2>
        @endif
    </div>
    <div>
        {{ $orders->links() }}
    </div>
</div>

<script>
@if(auth()->user()->isAdmin)
    document.addEventListener("livewire:load", (component) => {
        setTimeout(() => {
            const value = document.getElementById('startFrom').value;
            const valueTo = document.getElementById('startTo').value;
            const filters = document.getElementById('filtersHidden').value;
            const sort = document.getElementById('sortHidden').value;
            @this.startFrom = value;
            @this.startTo = valueTo;
            @this.filter = filters;
            @this.sort = value;
        }, 20)
    });
@endif
</script>
