<div class="bg-white pt-4 py-10 order-details">
    <style>
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

        .border-red-500 {
            border-color: rgba(239,68,68,1);
        }

    </style>
    <div class="container mx-auto mt-10">
        <div class="flex flex-wrap z-index-large">
            <div class="f-100 lg:w-3/4 px-5 py-5">
                <div class="flex flex-wrap sm:justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl f-100 mb-5 sm:mb-0">Detalji narudžbe za {{ $allOrderItems->first()->order->user->name }}</h1>
                    @if(auth()->user()->id === $allOrderItems->first()->order->customer_id)
                        <div
                            class="p-2 flex align-items rounded-full ml-0 bg-green-600 cursor-pointer text-white hover:text-white hover:bg-orange-500 focus:outline-none focus:bg-orange-500"
                            style="" wire:click.stop="repeatOrder()">
                            Ponovi narudžbu
                            <svg class="h-5 w-5 ml-4 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5 ml-6">Detaljnije</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Količina</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Cijena</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Iznos</h3>
                </div>

                @php
                    $count = 0;
                @endphp

                @foreach($allOrderItems as $item)
                    @php
                        $isActive = $item->product->first()->isActive;
                        $isMarketClosed = $item->product->first()->market->isClosed;
                        $isSuperUser = auth()->user()->superUser;
                        $isCreator = auth()->user()->id === $allOrderItems->first()->order->customer_id;
                        $showForOwner = $item->marketId == auth()->user()->isOwner || auth()->user()->isAdmin || $isCreator;
                    @endphp
                    @if($showForOwner)
                        @php
                            $count += 1;
                        @endphp
                        <div class="flex items-center hover:bg-gray-100 px-6 py-5 mt-1 w-full mr-0">
                        <div class="flex w-2/5">
                            <div class="w-20">
                                @if (!App::environment('production'))
                                    <img class="h-24 object-cover" src="{{ count($item->product->first()->images) ? "/storage/" . $item->product->first()->images->first()->url : 'https://dummyimage.com/400x400' }}" alt="Cart item image">
                                @else
                                    <img class="h-24 object-cover" src="{{ count($item->product->first()->images) ? "/public/storage/" . $item->product->first()->images->first()->url : 'https://dummyimage.com/400x400' }}" alt="Cart item image">
                                @endif
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm text-black pt-5">{{ $item->product->first()->name }}</span>
                                <a href="/prodavnica/{{ $item->marketId }}"
                                   class="text-red-500 text-lg text-underline capitalize inline-block">{{ $item->marketName }}</a>
                                @if(!$showForOwner)
                                    @if($isActive && !$isMarketClosed || $isSuperUser && $isActive)<a role="button" class="font-semibold pb-5 hover:text-red-500 text-green-800 text-sm" wire:click.stop="addToCart('{{ $item->product->first()->id }}')">Dodaj u korpu</a> @else <p class="text-xs text-red-600 pb-5">Ne radi prodavnica, ili nema na stanju </p>@endif
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5 decrease">
                            <input class="mx-2 border text-center text-black w-8" type="text" disabled value="{{ $item->quantity }}">
                        </div>
                        <span class="text-center w-1/5 font-semibold text-black text-sm">{{ $item->currentPrice }} KM</span>
                        <span class="text-center w-1/5 font-bold text-black text-sm">{{ $item->quantity * $item->currentPrice }} KM</span>
                    </div>
                    @endif
                @endforeach
            </div>

            @if($count > 0)
                <div id="summary" class="f-100 lg:w-1/4 px-6 py-5">
                    <h2 class="font-semibold text-2xl border-b mb-0 pb-8">Detalji narudžbe</h2>
                    <div class="flex justify-between mt-10 mb-5">
                        <span class="font-bold text-sm uppercase">Artikli ( {{ $count }} )</span>
                    </div>

                    <div class="border-t mt-8">
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                            <span>Ukupan iznos</span>
                            <span>{{ $allOrderItems->first()->order->total }} KM</span>
                        </div>

                        @if(auth()->user()->isAdmin || $isForAuthorOrder)
                            <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                                <span>Link za dostavu</span>
                                <span class="text-orange-600"><a class="text-orange-600" target="_blank" href="https://share.here.com/l/{{ $allOrderItems->first()->order->address }}">Link</a></span>
                            </div>

                            @if($order->message !== null)
                                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                                    <span>Dodatna poruka</span>
                                    <span class="text-orange-600"><a role="button" wire:click="$set('clickedFinish', true)" class="text-orange-600">Otvori</a></span>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if($clickedFinish && $order->message !== null)
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
                              placeholder="Ukoliko naručujete na adresu zgrade, potrebno je da napišete 3. sprat ili nešto što će olakšati dostavu, a ako živite u kući upišite boju kuće, ograde ili nešto specifićno. Sve ove informacije su nam jako korisne. Unaprijed vam hvala" readonly>{{ $order->message }}</textarea>
                </section>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-between">
                    <x-jet-secondary-button wire:click="$set('clickedFinish', false)" wire:loading.attr="disabled">
                        {{ __('Zatvori') }}
                    </x-jet-secondary-button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>

