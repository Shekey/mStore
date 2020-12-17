<div class="bg-white pt-4 py-10 cart-details">
      <style>
        button[disabled]:hover {
            cursor: not-allowed;
        }

        @media (max-width: 1023px) {
            .f-100 {
                flex-basis: 100%;
            }
        }

        main {
            overflow: hidden;
        }

        .z-index-large {
            z-index: 100;
        }

      .order-finished {
          display: flex;
          justify-content: center;
          align-items: center;
          position: fixed;
          top: 80px;
          width: 100vw;
          height: calc(100vh - 80px);
          background: #fff;
          z-index: 100;

      }
        .order-finished.hidden {
            display: none;
        }

      </style>
    <div class="container mx-auto mt-10">
        <div class="flex flex-wrap z-index-large">
            <div class="f-100 lg:w-3/4 px-5 py-5">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl mb-0">Korpa</h1>
                    @if($cartTotalItems !== 0)<h2 class="font-semibold text-2xl mb-0">{{ $cartTotalItems }} {{ $cartTotalItems === 1 ? 'Artikal' : 'Artikla' }}</h2>@endif
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Detaljnije</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Količina</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Cijena</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Iznos</h3>
                </div>

                @foreach($allCartItems as $item)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/5"> <!-- product -->
                            <div class="w-20">
                                <img class="h-24" src="{{ $item->image }}" alt="Cart item image">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm text-black">{{ $item->name }}</span>
                                <span class="text-red-500 text-xs">{{ $item->market }}</span>
                                <a role="button" class="font-semibold hover:text-red-500 text-black text-xs" wire:click.stop="removeFromCart('{{ $item->__raw_id }}')">Izbriši</a>
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5 decrease"  wire:click.stop="updateCartQty('{{ $item->__raw_id }}', {{ $item->qty - 1 }})">
                            <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                            </svg>

                            <input class="mx-2 border text-center text-black w-8" type="text" value="{{ $item->qty }}">

                            <svg class="fill-current text-gray-600 w-3 increase" viewBox="0 0 448 512" wire:click.stop="updateCartQty('{{ $item->__raw_id }}', {{ $item->qty + 1 }})">
                                <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                            </svg>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-black text-sm">{{ $item->price }} KM</span>
                        <span class="text-center w-1/5 font-bold text-black text-sm">{{ $item->total }} KM</span>
                    </div>
                @endforeach
            </div>
            <div id="summary" class="f-100 lg:w-1/4 px-6 py-5">
                <h2 class="font-semibold text-2xl border-b mb-0 pb-8">Detalji narudžbe</h2>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-bold text-sm uppercase">Artikli ( {{ $cartTotalItems }} )</span>
                    <span class="font-bold text-sm">{{ $totalPrice - $totalShipping }} KM</span>
                </div>
                <div>
                    <label class="font-bold inline-block mb-3 text-sm uppercase">Dostava</label>
                    <p class="block p-2 text-gray-700 w-full text-sm">Standardna dostava - {{ $totalShipping }} KM</p>
                </div>

                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Ukupan iznos</span>
                        <span>{{ $totalPrice }} KM</span>
                    </div>
                    <button wire:click="finishOrder" class="bg-orange-500 font-semibold py-3 text-sm text-white uppercase w-full {{ $locationAddress === '' ? 'disabled:opacity-50' : '' }}" {{ $locationAddress === '' ? 'disabled' : '' }}>Završi</button>
                </div>
            </div>
        </div>


        @if(count($allCartItems))
            <div class="relative" style="overflow: hidden">
            <div id="sidebar">
                <div class="gradient-line"></div>

                <div class="header">
                    <h1>Odaberite lokaciju za dostavu</h1>

                    <label for="current" class="block" wire:click.stop>
                        Trenutna lokacija
                        <input type="checkbox" name="address" id="current" value="current">
                    </label>
                    <div class="search-container">
                        <h2 class="city-label">Unesite vašu adresu</h2>
                        <div class="outer-city-field-container">
                            <img src="/map/resources/outline-search-24px.svg">
                            <div class="inner-city-field-container">
                                <div contenteditable="true" class="city-field"></div>
                                <div class="city-field-suggestion"></div>
                            </div>
                        </div>
                    </div>
                    <p class="py-4">
                        Ukoliko želite da dostavite na trenutnu adresu, odaberite "trenutna adresa"
                    </p>
                    <div class="gradient-line"></div>
                    <p class="py-4">
                        Ukoliko niste pronašli vašu tačnu adresu, možete nam pomoći tako što ćete kliknuti na kuću, zgradu ili površinu. Na taj način ste 100% sigruni da je to adersa gdje želite da dostavimo.
                    </p>
                    <div class="gradient-line"></div>

                </div>
                <div class="tabs">
                    <div class="tab-container" style="display: none;">
                        <div class="tab tab-active" id="tab-1">
                            Isoline Options
                        </div>
                    </div>
                    <div class="tab-bar"></div>
                </div>
                <div class="content">
                    <div class="content-group" id="content-group-1">
                        <div class="group columns" style="display: none;">
                            <div class="col">
                                <h2>Mode</h2>
                                <label class="radio-container">
                                    <input class="isoline-controls" type="radio" id="car" name="mode" checked>
                                    <span class="checkmark"></span>
                                    Car
                                </label>
                            </div>
                        </div>

                        <div class="group" style="display: none;">
                            <h2>Date</h2>
                            <input class="isoline-controls text-input" id="date-value" type="date" name="date" >
                        </div>

                        <div class="group" style="display: none;">
                            <div class="h2-row">
                                <h2>Time</h2>
                                <div id="hour-slider-val" class="h2-val"></div>
                            </div>
                            <div class="graph-container">
                                <div class="no-graph-text">Distribution is only available in range type time and mode car.</div>
                                <div class="graph"></div>
                            </div>
                            <input class="isoline-controls slider" id="hour-slider" type="range" min="0" max="23" value="10" />
                        </div>
                    </div>

                </div>
            </div>
            <div id="map" wire:ignore></div>
        </div>
        @endif
    </div>

    <div class="order-finished {{ $orderFinished  ? '' : 'hidden' }}">
        <div class="text-center">
            <svg style="width: 210px; height: 210px; margin: 0 auto 30px;" fill="none" stroke="#f58b1e" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            <h3 class="text-3xl">Uspješno ste obavili narudžbu.</h3>
            <p class="text-xl mt-1">Oćekujte naruđžbu u roku od 1h.</p>
            <a href="/" class="border border-orange-500 mt-4 inline-block text-orange-500 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:text-white hover:bg-orange-500 focus:outline-none focus:shadow-outline"
            >Povratak na početnu stranu.</a>
        </div>
    </div>

    @if(count($allCartItems))
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('component.initialized', (component) => {
                    if (component.el.classList.contains('cart-details')) {
                        document.addEventListener('addedMarkers', function (e) {
                            component.set('locationAddress', e.detail);
                        });

                        document.addEventListener('removedMarkers', function (e) {
                            component.set('locationAddress', '');
                        });
                    }
                });
            });
        </script>
    @endif
</div>
