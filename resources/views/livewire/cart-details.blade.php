<div class="bg-white pt-4 py-10 cart-details">
    <style>
        .disable-select {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .disable-select::selection {
            background: #fff;
        }

        @keyframes swipe-x {
            0% {
                transform: translateX(0px);
            }
            25% {
                transform: translateX(50px);
            }
            50% {
                transform: translateX(0px);
            }
            75% {
                transform: translateX(-50px);
            }
        }

        .hand-x {
            animation: swipe-x 1.25s ease-in-out backwards;
            animation-iteration-count:infinite;
        }

        /* SVG RULES */

        .hand,
        .hand-double,
        .hand-flick,
        .hand-hold,
        .hand-rock,
        .hand-tap,
        .hand-x,
        .hand-y {
            fill: #fff;
            stroke: #000;
            stroke-width: 3px;
            stroke-linecap: round;
            stroke-linejoin: round;
        }


        button[disabled]:hover {
            cursor: not-allowed;
        }

        .f-100 {
            overflow-x: hidden;
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
            position: absolute;
            top: 80px;
            width: 100vw;
            height: calc(100% - 80px);
            background: #fff;
            z-index: 9;

        }

        .order-finished.hidden {
            display: none;
        }

        .border-red-500 {
            border-color: rgba(239, 68, 68, 1);
        }

    </style>
    <div class="container mx-auto mt-10">
        <div class="flex flex-wrap z-index-large">
            <div class="w-full lg:w-3/4 px-5 py-5" style="overflow-x: auto;">
                <div class="flex justify-between">
                    <h1 class="font-semibold text-2xl mb-0 flex">Korpa
                        <div class="show-mobile ml-2">
                            <div class="flex justify-center">
                                <svg id="Swipe-horizontal_1" width="50" height="50" data-name="Swipe horizontal 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                                    <path class="hand-x" d="M139.93,113.56l-41.12-6.93V76.08a9.25,9.25,0,0,0-9.25-9.25h0a9.25,9.25,0,0,0-9.25,9.25v57.36L71,122.65c-3.61-3.61-8.44-3.89-13.08,0,0,0-7.24,5.84-3.83,9.25l34,34h42.63a9.25,9.25,0,0,0,9.07-7.43l6.82-34.09A9.28,9.28,0,0,0,139.93,113.56Z"/>
                                    <g class="swipe-horizontal">
                                        <path class="line-horizontal" d="M70.85,42c19.69-12.46,37,0,37,0"/>
                                        <polyline class="arrow-left" points="76.6 46.01 68.37 43.43 68.38 43.41 70.96 35.18"/>
                                        <polyline class="arrow-right" points="100.21 44.66 108.43 42.08 108.43 42.06 105.85 33.84"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </h1>
                    @if($cartTotalItems !== 0)<h2
                        class="font-semibold text-2xl mb-0">{{ $cartTotalItems }} {{ $cartTotalItems === 1 ? 'Artikal' : 'Artikla' }}</h2>@endif
                </div>
                <div class="flex mt-10 mb-5 border-t pt-8" style="min-width: 500px;">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Detaljnije</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">
                        Količina</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Cijena</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Iznos</h3>
                </div>

                @foreach($allCartItems as $item)
                    <div
                        class="flex items-center hover:bg-gray-100 md:px-6 py-5 mt-1 w-full mr-0 {{ $item->isActive ? '' : 'border-2 border-red-500' }}" style="min-width: 500px;">
                        <div class="flex w-2/5"> <!-- product -->
                            <div class="w-20 hidden sm:block disable-select">
                                @if (!App::environment('production'))
                                    <img class="h-24 object-cover" src="{{ $item->image }}" alt="Cart item image">
                                @else
                                    @if (strpos($item->image, "/assets/logo.png") === 0)
                                        <img class="h-24 object-cover" src="{{ $item->image }}"
                                             alt="Cart item image">
                                    @else
                                        <img class="h-24 object-cover" src="/public/storage/{{ $item->image }}"
                                             alt="Cart item image">
                                    @endif

                                @endif
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-xs md:text-sm text-black disable-select">{{ $item->name }}</span>
                                <a href="/prodavnica/{{ $item->marketId }}"
                                   class="text-red-500 text-lg text-underline capitalize my-2 inline-block disable-select">{{ $item->market }}</a>
                                <a role="button" class="font-semibold hover:text-red-500 text-black text-xs md:text-sm capitalize disable-select"
                                   wire:click.stop="removeFromCart('{{ $item->__raw_id }}')">Izbriši</a>
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5 ">
                            <svg class="fill-current text-gray-600 w-3 decrease" viewBox="0 0 448 512" wire:click.stop="updateCartQty('{{ $item->__raw_id }}', {{ $item->qty - 1 }})">
                                <path
                                    d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                            </svg>

                            <input class="mx-5 border text-center text-black w-12 disable-select" type="text" value="{{ $item->qty }}" wire:change="fireUpdate($event.target.value, '{{ $item->__raw_id }}')">

                            <svg class="fill-current text-gray-600 w-3 increase" viewBox="0 0 448 512"
                                 wire:click.stop="updateCartQty('{{ $item->__raw_id }}', {{ $item->qty + 1 }})">
                                <path
                                    d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                            </svg>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-black text-sm disable-select">{{ $item->price }} KM</span>
                        <span class="text-center w-1/5 font-bold text-black text-sm disable-select">{{ $item->total }} KM</span>
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
                    <div class="flex font-semibold justify-between py-4 text-sm uppercase">
                        <span>Ukupan iznos</span>
                        <span>{{ $totalPrice }} KM</span>
                    </div>
                    @if($usePoints)
                    <div class="mb-2">
                        <div class="flex font-semibold justify-between pb-4 text-sm uppercase">
                            <span>Popust </span>
                            <span>{{ $totalPrice - auth()->user()->points < 0 ? floatval($totalPrice) : auth()->user()->points   }} KM</span>
                        </div>
                        <div class="border-t">
                            <div class="flex font-semibold justify-between py-2 text-sm uppercase">
                                <span>Ukupno za platiti </span>
                                <span>{{ $totalPrice - auth()->user()->points < 0 ? 0 : round($totalPrice - auth()->user()->points, true) }} KM</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <label class="items-center flex mb-2">
                        <input type="checkbox" {{ $usePoints == 0 ? '': 'checked' }}  wire:click="$toggle('usePoints')" wire.model="usePoints"  class="form-checkbox h-6 w-6 text-green-500" {{ auth()->user()->points <= 20 ? 'disabled' : '' }}>
                        <span class="ml-3 text-sm">Da li želite iskorititi bodove da platite?</span>
                    </label>

                    @if(auth()->user()->points <= 50)
                        <div  class="text-sm text-orange-600 mb-3">Ova opcija će Vam biti dostupna nakon što skupite 50 bodova.</div>
                    @endif

                    <button wire:click="$set('clickedFinish', true)"
                            class="bg-orange-500 font-semibold py-3 text-sm text-white uppercase w-full finishOrderBtn {{ $locationAddress === '' ? 'disabled:opacity-50' : '' }}" {{ $locationAddress === '' ? 'disabled' : '' }}>
                        Završi
                    </button>
                    <button wire:click="clearCart"
                            class="bg-orange-500 mt-2 font-semibold py-3 text-sm text-white uppercase w-full finishOrderBtn {{ $cartTotalItems === 0 ? 'disabled:opacity-50' : '' }}" {{ $cartTotalItems === 0 ? 'disabled' : '' }}>
                        Očisti korpu
                    </button>
                </div>
            </div>
        </div>

        @if(count($allCartItems))
           @include("partials.map");
        @endif
    </div>

    <div class="order-finished {{ $orderFinished  ? '' : 'hidden' }}">
        <div class="text-center">
            <svg style="width: 210px; height: 210px; margin: 0 auto 30px;" fill="none" stroke="#f58b1e"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
            </svg>
            <h3 class="text-3xl px-2">Uspješno ste obavili narudžbu.</h3>
            <p class="text-xl mt-1 px-2">Očekujte narudžbu u roku od 1h.</p>
            <a href="/"
               class="border border-orange-500 mt-4 inline-block text-orange-500 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:text-white hover:bg-orange-500 focus:outline-none focus:shadow-outline"
            >Povratak na početnu stranu.</a>
        </div>
    </div>

    @if($clickedFinish)
        <x-jet-dialog-modal wire:model="clickedFinish">
            <x-slot name="title">
                Dodatne infromacije o adresi
                <button wire:click="$set('clickedFinish', false)" wire:loading.attr="disabled" class="float-right w-5 h-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <section class="text-white body-font overflow-hidden">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        Poruka
                    </label>
                    <textarea rows="10" class="appearance-none block w-full text-black rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                              placeholder="Ukoliko naručujete na adresu zgrade, potrebno je da napišete 3. sprat ili nešto što će olakšati dostavu, a ako živite u kući upišite boju kuće, ograde ili nešto specifično. Sve ove informacije su nam jako korisne. Unaprijed vam hvala " name="poruka" wire:model="poruka"></textarea>
                    <p class="text-red-500 text-sm mb-4 {{ $errorClass ? 'block' : 'hidden' }}" >Poruka polje ne smije biti prazno</p>
                </section>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-between">
                    <button wire:click="finishOrder"
                            class="bg-orange-500 font-semibold py-3 inline-block px-5 text-sm text-white uppercase finishOrderBtn {{ $locationAddress === '' ? 'disabled:opacity-50' : '' }}" {{ $locationAddress === '' ? 'disabled' : '' }}>
                        Završi
                    </button>
                    <x-jet-secondary-button wire:click="$set('clickedFinish', false)" wire:loading.attr="disabled">
                        {{ __('Zatvori') }}
                    </x-jet-secondary-button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif

@if(count($allCartItems))
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('component.initialized', (component) => {
                    if (component.el.classList.contains('cart-details')) {
                        document.addEventListener('addedMarkers', function (e) {
                            if(e.detail.registred) {
                                console.log("event reg" + "eeee" + e.detail.value);
                                @if(auth()->user()->newAddress == null || auth()->user()->newAddress == "")
                                    component.set('locationAddress', "{{ auth()->user()->address }}");
                                @else
                                    component.set('locationAddress', e.detail.value);
                                console.log("event reg" + "e" + e.detail.value);

                                @endif
                            } else  {
                                component.set('locationAddress', e.detail);
                            }
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
