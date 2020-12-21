<div style="width: 100%; flex-basis: 100%;" class="catalog">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .custom-number-input input:focus {
            outline: none !important;
        }

        .custom-number-input button:focus {
            outline: none !important;
        }

        button span {
            line-height: 35px;
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(calc(50% - 60px));
            transform: translateY(calc(50% - 60px));
        }


        .category {
            padding: 6px 12px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 300;
        }

        .category:hover {
            color: #fff;
        }

        .min-h-screen {
            position: relative;
        }

        .cart-active {
            transform: translateX(0) !important;
        }

        .cart {
            transform: translateX(600px);
            width: 100%;
        }

        button[disabled]:hover {
            cursor: not-allowed;
        }

        /*Banner open/load animation*/
        .alert-banner {
            -webkit-animation: slide-in-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: slide-in-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        /*Banner close animation*/
        .alert-banner input:checked ~ * {
            -webkit-animation: slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
            animation: slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
        }

        /*Footer open/load animation*/
        .alert-footer {
            -webkit-animation: slide-in-bottom 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: slide-in-bottom 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        /*Footer close animation*/
        .alert-footer input:checked ~ * {
            -webkit-animation: slide-out-bottom 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
            animation: slide-out-bottom 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
        }

        /*Toast open/load animation*/
        .alert-toast {
            -webkit-animation: slide-in-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: slide-in-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        /*Toast close animation*/
        .alert-toast input:checked ~ * {
            -webkit-animation: fade-out-right 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: fade-out-right 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        /* -------------------------------------------------------------
         * Animations generated using Animista * w: http://animista.net,
         * ---------------------------------------------------------- */

        @-webkit-keyframes slide-in-top{0%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@keyframes slide-in-top{0%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@-webkit-keyframes slide-out-top{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}}@keyframes slide-out-top{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}}@-webkit-keyframes slide-in-bottom{0%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@keyframes slide-in-bottom{0%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@-webkit-keyframes slide-out-bottom{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}}@keyframes slide-out-bottom{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}}@-webkit-keyframes slide-in-right{0%{-webkit-transform:translateX(1000px);transform:translateX(1000px);opacity:0}100%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}}@keyframes slide-in-right{0%{-webkit-transform:translateX(1000px);transform:translateX(1000px);opacity:0}100%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}}@-webkit-keyframes fade-out-right{0%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}100%{-webkit-transform:translateX(50px);transform:translateX(50px);opacity:0}}@keyframes fade-out-right{0%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}100%{-webkit-transform:translateX(50px);transform:translateX(50px);opacity:0}}


    </style>


    <style>
        .swiper-container {
            width: calc(100vw - 16px);
            margin-left: calc((100vw - 100% - 16px) / 2 * -1);
            margin-bottom: 30px;
        }

        .swiper-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .articles > div:hover {
            cursor: pointer;
        }


        .cart {
            z-index: 1000;
        }

        .search__container {
            padding-top: 64px;
        }

        .search__input {
            width: 100%;
            padding: 12px 24px;
            background-color: transparent;
            transition: transform 250ms ease-in-out;
            font-size: 14px;
            line-height: 18px;
            color: #000;
            font-weight: 700;
            background-color: transparent;
            background-image: url("data:image/svg+xml; charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='%23000' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: 18px 18px;
            background-position: 95% center;
            border-radius: 50px;
            border: 2px solid #000;
            transition: all 250ms ease-in-out;
            backface-visibility: hidden;
            transform-style: preserve-3d;
            }
            .search__input::placeholder {
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .search__input:hover, .search__input:focus {
            padding: 12px 0;
            outline: 0;
            border: 1px solid transparent;
            border-bottom: 1px solid #000;
            border-radius: 0;
            background-position: 100% center;
        }

        .btn {
            display: inline-block;
            color: #555555;
            min-width: 154px;
            text-decoration: none;
            padding: 20px;
            position: relative;
            text-align: center;
            margin: 0;
        }

        .btn:hover {
            transition: color 0.3s ease-in 0.4s;
            color: #ff5a1f;
        }

        .btn.filterActive {
            color: #ff5a1f;
        }

        .btn:hover .button-stroke:nth-child(2) {
            stroke-dashoffset: 0;
        }
        .button-stroke {
            display: block;
            width: calc(100% - 40px);
            height: 20px;
            stroke: #ff5a1f;
            position: absolute;
            left: 20px;
            bottom: -10px;
            stroke-width: 4;
        }
        .button-stroke:nth-child(2) {
            stroke-dasharray: 650px;
            stroke-dashoffset: 650px;
            stroke: #555;
            stroke-width: 5;
            transition: stroke-dashoffset 800ms ease-out;
        }



    </style>

    <div class="">
        <header>
            <div class="swiper-container w-100 h-64" wire:ignore>
                <div class="swiper-wrapper">
                    @foreach($ads as $ad)
                    <div class="swiper-slide">
                        <a href="{{ $ad->url }}">
                            <img src="/storage/{{ $ad->image }}">
                        </a>
                    </div>
                    @endforeach

                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </header>
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between flex-wrap sm:no-wrap">
                <div class="w-full md:text-center text-3xl font-semibold capitalize order-1 sm:order-0">
                    {{ $market->name }}
                </div>
                @auth

                    @if(!$market->isClosed || auth()->user()->superUser)
                        <div class="flex items-center sm:justify-end w-full">
                            <p class="mt-0 mr-4">Ukupno ( {{ number_format((float)$totalPrice, 2, '.', '') }} KM )</p>
                            <button wire:click="$set('cartOpen', true)" class="focus:outline-none mx-4 sm:mx-0">
                                <svg class="h-10 w-10" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                @endauth
            </div>
            <h4 class="text-lg font-bold text-orange-400 px-2 py-2 mt-8 text-center">Odaberite kategoriju
                kako bi ste filtrirali artikle.</h4>
            @guest
                <div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm" style="z-index: 100;">
                    <input type="checkbox" class="hidden" id="not_registered">

                    <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-green-500 h-24 rounded shadow-lg text-white" title="close" for="not_registered">
                        <svg class="fill-current w-4 h-4 mr-2" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                        <p>Morate se registrirati da bi ste mogli naručivati artikle.</p>
                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </label>
                </div>
            @endguest

            <nav class="flex justify-center items-center mt-0">

                <svg id="stroke" xmlns="http://www.w3.org/2000/svg" width="0" height="0">
                    <defs>
                        <path id="line" d="M2 2c49.7 2.6 100 3.1 150 1.7-46.5 2-93 4.4-139.2 7.3 45.2-1.5 90.6-1.8 135.8-.6" fill="none" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke"/>
                    </defs>
                </svg>
                <div class="flex flex-row flex-wrap justify-center mt-5 mb-4 filters">
                    <a class="btn mt-3 mx-3 uppercase {{ $filterCat === '' ? 'filterActive' : ''}}" data-id="0" wire:click="$set('filterCat', '')"role="button">Svi artikli
                        <svg class="button-stroke" viewBox="0 0 154 13">
                            <use href="#line"></use>
                        </svg>
                        <svg class="button-stroke" viewBox="0 0 154 13">
                            <use href="#line"></use>
                        </svg>
                    </a>
                    <a class="btn mt-3 mx-3 uppercase {{ $filterCat === 'akcije' ? 'filterActive' : ''}}" data-id="0" wire:click="$set('filterCat', 'akcije')"role="button">Akcijski artikli
                        <svg class="button-stroke" viewBox="0 0 154 13">
                            <use href="#line"></use>
                        </svg>
                        <svg class="button-stroke" viewBox="0 0 154 13">
                            <use href="#line"></use>
                        </svg>
                    </a>

                    <a class="btn mt-3 mx-3 uppercase {{ $filterCat === 'novo' ? 'filterActive' : ''}}" data-id="0" wire:click="$set('filterCat', 'novo')"role="button">Novo u ponudi
                        <svg class="button-stroke" viewBox="0 0 154 13">
                            <use href="#line"></use>
                        </svg>
                        <svg class="button-stroke" viewBox="0 0 154 13">
                            <use href="#line"></use>
                        </svg>
                    </a>

                    @foreach($categories as $cat)
                        <a class="btn mt-3 mx-3 uppercase {{ $filterCat === $cat->id ? 'filterActive' : ''}}" data-id="0" wire:click="$set('filterCat', {{ $cat->id}} )" data-id="{{ $cat->id }}" wire:click="$set('filterCat', {{ $cat->id }})" role="button">{{ $cat->name }}
                            <svg class="button-stroke" viewBox="0 0 154 13">
                                <use href="#line"></use>
                            </svg>
                            <svg class="button-stroke" viewBox="0 0 154 13">
                                <use href="#line"></use>
                            </svg>
                        </a>
                    @endforeach
                </div>
            </nav>
            <div class="relative max-w-lg mx-auto">
                <div class="search__container">
                    <input class="search__input" type="text" wire:model.lazy="search" wire:keydown.enter="searchArticle($event.target.value)" placeholder="Pretražite artikle (enter)">
                </div>
            </div>
        </div>

    </div>
    <div
        class="cart fixed right-0 top-0 max-w-sm transition duration-300 ease-out transform overflow-y-auto bg-white border-l-2 border-gray-300 w-full h-full {{ $cartClass }}">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-medium text-black">Korpa ( {{ number_format((float)$totalPrice - $totalShipping, 2, '.', '') }} KM)
                <p class="text-sm text-orange-500">Sa dostavom ( {{ $totalShipping }} KM)</p>
            </h3>
            <button wire:click="$set('cartOpen', false)" class="text-black focus:outline-none">
                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <hr class="my-3">
        @foreach($allCartItems as $cartItem)
            <div class="flex mb-5">
                <img class="h-20 w-20 object-cover rounded"
                     src="{{ $cartItem->image }}"
                     alt="">
                <div class="mx-3">
                    <h3 class="text-sm text-black">{{ $cartItem->name }}</h3>
                    <div class="flex items-center mt-4">
                        <a role="button" class="text-black focus:outline-none focus:text-black" wire:click.stop="updateCartQty('{{ $cartItem->__raw_id }}', {{ $cartItem->qty - 1 }})">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </a>
                        <span class="text-black mx-2">{{ $cartItem->qty }}</span>
                        <a role="button" class="text-black focus:outline-none focus:text-black" wire:click.stop="updateCartQty('{{ $cartItem->__raw_id }}', {{ $cartItem->qty + 1 }})">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <p class="text-black flex-1 text-center">({{ number_format((float)$cartItem->price, 2, '.', '') }}  X {{ $cartItem->qty }})</p>
                    <p class="text-orange-700 text-center mt-3">{{ $cartItem->total }} KM</p>
                </div>

            </div>
        @endforeach
        @if (count($allCartItems) > 0)
            <a href="/korpa" class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                Završi narudzbu
                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        @else
            <p class="text-orange-700 text-center mt-5">Korpa je prazna.</p>
        @endif

        <button class="flex items-center justify-center block w-full mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500 clear-cart {{ count($allCartItems) ? '' : 'invisible' }}" wire:click="clearCart">
            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Očisti korpu
        </button>
    </div>

    <div class="px-4">
        <div class="container py-4">
            <h3 class="text-3xl font-bold text-uppercase mt-4 text-center md:text-left">Katalog artikala</h3>
            <span class="mt-3 text-sm text-white"></span>
            <div class="flex flex-wrap mt-6 articles">

                @foreach($articles as $article)
                    <div class="flex flex-col lg:w-1/3 mb-8 sm:px-2 px-10 relative"  wire:click.stop="showDetailsArticle({{ $article->id }})">
                        <span class="bg-orange-200 text-orange-900 text-xs px-2 inline-block rounded-full uppercase font-semibold tracking-wide" style="position: absolute; right: 2px; transform: rotateZ(40deg); top:20px;">
                                       {{ $article->created_at->format('d-m-Y')}}
                                     </span>
                        <img src="https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="Logo image"
                             class="w-full object-contain object-center rounded-lg shadow-md"
                             style="border: 2px solid #f58b1e; border-radius: 10px;">
                            @auth
                               @if(!$market->isClosed || auth()->user()->superUser)
                                    <a role="button"
                                       class="add-to-cart p-2 flex rounded-full bg-orange-600 text-white ml-auto hover:text-white hover:bg-orange-500 focus:outline-none focus:bg-orange-500"
                                       style="width: 36px; margin-right: 30px; margin-top: -15px; z-index: 10" wire:click.stop="quickAddToCart({{ $article->id }})">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                             stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                            <path
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </a>
                                @endif
                            @endauth

                        <div class="relative px-4 -mt-16">
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <div class="flex items-baseline">
                                  <span
                                      class="bg-orange-200 text-orange-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                                    {{ $article->category->name }}
                                  </span>

                                    @php
                                      $older = false;
                                        if (3 - ((new \Carbon\Carbon($article->created_at, 'UTC'))->diffInDays()) < 0) {
                                            $older = true;
                                        }
                                    @endphp
                                    @if(!$older)
                                        <span class="bg-green-200 text-green-800 text-xs px-2 inline-block rounded-full uppercase font-semibold tracking-wide ml-4">
                                            Novo
                                         </span>
                                    @endif
                                </div>
                                <h4 class="mt-4 text-xl font-semibold uppercase leading-tight truncate">{{ $article->name }}</h4>
                                <div class="mt-2">
                                    {{ $article->price }}
                                    <span class="text-gray-600 text-sm">KM</span>

                                    @if ($article->isOnSale && $article->oldPrice)
                                        <span class="text-orange-500 line-through inline-block ml-3">
                                            {{ $article->oldPrice }}
                                            <span  class="text-orange-500">KM</span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if(count($articles) == 0)
                <h3 class="text-white text-xl font-bold text-uppercase mt-4 text-center">Nažalost ne postoji ovakav
                    artikal.</h3>
            @endif
            <div class="flex justify-center">
                <div class="flex rounded-md mt-8">
                    {{ $articles->links('layouts.pagination') }}
                    {{--                    <a href="#" class="py-2 px-4 leading-tight bg-white border border-red-200 text-orange-700 border-r-0 ml-0 rounded-l hover:bg-orange-800 hover:text-white"><span>Previous</a></a>--}}
                </div>
            </div>
        </div>
    </div>

    @if(count($articles) != 0)
    <x-jet-dialog-modal wire:model="showArtikal" :maxWidth="'modal-full'">
        <x-slot name="title">
            Detalji artikla
            <button wire:click="$set('showArtikal', false)" wire:loading.attr="enabled" class="float-right w-5 h-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
            <section class="text-white body-font overflow-hidden">
                <div class="container px-5 py-24 mx-auto">
                    <div class="lg:w-4/5 mx-auto flex flex-wrap">
                        <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                            <h2 class="text-sm title-font text-black tracking-widest">{{ $articleBrand }}</h2>
                            <h1 class="text-black text-3xl title-font font-medium mb-4">{{ $articleName }}</h1>
                            <div class="flex mb-4">
                                <a class="flex-grow text-orange-500 border-b-2 border-orange-500 py-2 text-lg px-1">Detaljnije</a>
                            </div>
                            <p class="leading-relaxed mb-4 text-black">{{ $articleDesc }}</p>
                            <div class="flex border-t border-gray-300 py-2">
                                <span class="text-black">Cijena</span>
                                <span class="ml-auto text-black">{{ number_format((float)$articlePrice, 2, '.', '') }} KM</span>
                            </div>
                            @if($isOnSale)
                                <div class="flex border-t border-gray-300 py-2">
                                    <span class="text-black">Stara cijena</span>
                                    <span class="ml-auto text-black">{{ number_format((float)$articleOldPrice, 2, '.', '') }} KM</span>
                                </div>
                            @endif
                            <div class="flex border-t border-gray-300 py-2">
                                <span class="text-black">Boja</span>
                                <span class="ml-auto text-black">{{ $articleColor }}</span>
                            </div>
                            <div class="flex border-t border-gray-300 py-2">
                                <span class="text-black">Veličina</span>
                                <span class="ml-auto text-black">{{ $articleSize }}</span>
                            </div>
                            @auth
                                @if(!$market->isClosed || auth()->user()->superUser)
                                    <div class="flex border-t border-b mb-6 border-gray-300 py-2">
                                <span class="text-black flex-1">Količina</span>
                                <div class="custom-number-input h-10 w-32">
                                    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                        <button data-action="decrement" wire:click="decrement"
                                                class=" bg-orange-500 text-white hover:text-black hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">−</span>
                                        </button>
                                        <input type="number"
                                               class="outline-none focus:outline-none text-center w-full bg-orange-500 font-semibold text-md hover:text-white focus:text-white  md:text-basecursor-default flex items-center text-white  outline-none"
                                               name="custom-input-number" wire:model="qty"/>
                                        <button data-action="increment" wire:click="increment"
                                                class="bg-orange-500 text-white hover:text-white hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                            <span class="m-auto text-2xl font-thin">+</span>
                                        </button>
                                    </div>
                                </div>

                                <span class="ml-auto text-black"></span>
                            </div>
                                @endif
                            @endauth
                            <div class="flex">
                                <span class="title-font font-medium text-2xl text-black">Ukupno: {{ $articleTotal }} KM {!! $calcTempPrice != 0 ? '<span class="text-orange-500"> ( '. number_format((float)$calcTempPrice  , 2, '.', '') . ' KM) </span>' : '' !!}</span>
                                @auth
                                    @if(!$market->isClosed || auth()->user()->superUser)
                                        <button wire:click="addToCart({{ $this->articalId }}, {{ $qty }})"
                                            class="flex ml-auto text-white bg-orange-500 border-0 py-2 px-6 focus:outline-none hover:bg-orange-600 rounded">
                                            Kupi
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 class="w-5 h-5 ml-2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                             src="{{ $image }}">
                    </div>
                </div>
            </section>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showArtikal', false)" wire:loading.attr="enabled">
                {{ __('Zatvori') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    @endif
    <script>

        document.addEventListener("DOMContentLoaded", () => {

            const navigateToCart = document.querySelector('.navigateToCart');
            Livewire.hook('component.initialized', (component) => {
                console.log(component.el);
                if (component.el.classList.contains('catalog') && navigateToCart) {
                    navigateToCart.addEventListener('click', (e) => {
                        e.preventDefault();
                        component.set('cartOpen', true);
                    });
                }
            })

        });
    </script>
</div>
