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

        .min-h-screen > main {
            background: #373737;
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
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css?dp-version=1578490236" />
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="/map/css/index.css" />
    <link rel="stylesheet" type="text/css" href="/map/css/sidebar.css" />
    <link rel="stylesheet" type="text/css" href="/map/css/search.css" />

    <!-- JS API -->
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <!-- Turf for area calculations -->
    <script src="https://npmcdn.com/@turf/turf/turf.min.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

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

        .articles > div {
            box-shadow: 8px 8px 15px 8px #000000;
        }

        .cart {
            z-index: 1000;
        }
    </style>

    <div class="">
        <header>
            <div class="swiper-container w-100 h-64">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <img src="https://source.unsplash.com/weekly?water">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://source.unsplash.com/weekly?mountain">
                    </div>
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>

            <div class="container mx-auto px-6">
                <div class="flex items-center justify-between flex-wrap sm:no-wrap">
                    <div class="hidden w-full text-white md:flex md:items-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.06298 10.063 6.27212 12.2721 6.27212C14.4813 6.27212 16.2721 8.06298 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16755 11.1676 8.27212 12.2721 8.27212C13.3767 8.27212 14.2721 9.16755 14.2721 10.2721Z"
                                  fill="currentColor"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.39409 5.48178 3.79417C8.90918 0.194243 14.6059 0.054383 18.2059 3.48178C21.8058 6.90918 21.9457 12.6059 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.97318 6.93028 5.17324C9.59603 2.3733 14.0268 2.26452 16.8268 4.93028C19.6267 7.59603 19.7355 12.0268 17.0698 14.8268Z"
                                  fill="currentColor"/>
                        </svg>
                        <span class="mx-1 text-lg">Bugojno</span>
                    </div>

                    <div class="w-full text-white md:text-center text-3xl font-semibold capitalize order-1 sm:order-0">
                        {{ $market->name }}
                    </div>
                    @auth
                        @php
                            $carbon=Carbon\Carbon::now();
                            $m = null;
                            $dayToday = $carbon->format('l');

                           if ($dayToday === 'Sunday') {
                            $m = $carbon->lte($market->endTimeSunday) && $carbon->gte($market->startTimeSunday);
                           } else {
                            $m = $carbon->lte($market->endTime) && $carbon->gte($market->startTime);
                           }
                        @endphp
                        @if($m)
                            <div class="flex items-center sm:justify-end w-full">
                                <p class="text-white mt-0 mr-4">Ukupno ( {{ $totalPrice }} KM )</p>
                                <button wire:click="$set('cartOpen', true)" class="text-white focus:outline-none mx-4 sm:mx-0">
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
                <h4 class="text-lg font-bold text-orange-700 bg-white px-2 py-2 mt-8 text-center">Odaberite kategoriju
                    kako bi ste filtrirali artikle.</h4>

                @guest
                    <div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm">
                        <input type="checkbox" class="hidden" id="footertoast">

                        <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-green-500 h-24 rounded shadow-lg text-white" title="close" for="footertoast">
                            <svg class="fill-current w-4 h-4 mr-2" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p>Morate se registrirati da bi ste mogli naručivati artikle.</p>
                            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </label>
                    </div>
                @endguest

                <nav class="flex justify-center items-center mt-0">

                    <div class="flex flex-row flex-wrap mt-5 mb-4 filters">
                        <a class="mt-3 mx-3 mt-0 category bg-orange-600 text-white uppercase" data-id="0" role="button"
                           wire:click="$set('filterCat', '')">Svi artikli</a>
                        @foreach($categories as $cat)
                            <a class="mt-3 category mx-3 mt-0 uppercase bg-orange-600 text-white"
                               data-id="{{ $cat->id }}" wire:click="$set('filterCat', {{ $cat->id }})"
                               role="button">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </nav>
                <div class="relative mt-6 max-w-lg mx-auto">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
                    <input
                        class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline"
                        type="text" wire:model.debounce.250ms="search" placeholder="Pretraga po nazivu artikla">
                </div>
            </div>
        </header>
        <div
             class="cart fixed right-0 top-0 max-w-sm transition duration-300 ease-out transform overflow-y-auto bg-white border-l-2 border-gray-300 w-full h-full {{ $cartClass }}">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-medium text-black">Korpa ( {{ $totalPrice - $totalShipping }} KM)
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
                         src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80"
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
                        <p class="text-black flex-1 text-center">({{ $cartItem->price }}  X {{ $cartItem->qty }})</p>
                        <p class="text-orange-700 text-center mt-3">{{ $cartItem->total }} KM</p>
                    </div>

                </div>
            @endforeach
            @if (count($allCartItems) > 0)
                <a href="/cart" class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
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
    </div>
    <main class="px-4">
        <div class="container py-4">
            <h3 class="text-white text-3xl font-bold text-uppercase mt-4 text-center md:text-left">Katalog artikala</h3>
            <span class="mt-3 text-sm text-white"></span>
            <div class="grid gap-10 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mt-6 articles">

                @foreach($articles as $article)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                             wire:click.stop="showDetailsArticle({{ $article->id }})"
                             style="background-image: url('https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
                            @auth
                                @php
                                    $carbon=Carbon\Carbon::now();
                                    $m = null;
                                    $dayToday = $carbon->format('l');

                                   if ($dayToday === 'Sunday') {
                                    $m = $carbon->lte($market->endTimeSunday) && $carbon->gte($market->startTimeSunday);
                                   } else {
                                    $m = $carbon->lte($market->endTime) && $carbon->gte($market->startTime);
                                   }
                                @endphp
                               @if($m)
                                    <a role="button"
                                       class="add-to-cart p-2 rounded-full bg-orange-600 text-white mx-5 -mb-4 hover:bg-orange-200 focus:outline-none focus:bg-blue-500"
                                       style="position: relative; z-index: 10" wire:click.stop="quickAddToCart({{ $article->id }})">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                             stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                            <path
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </a>
                                @endif
                            @endauth
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-white uppercase">{{ $article->name }}</h3>
                            <p class="text-white mt-2">{{ $article->price }} KM</p>
                            <p class="text-white mt-2">{{ $article->category->name }}</p>
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
    </main>

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
                                <span class="ml-auto text-black">{{ $articlePrice }} KM</span>
                            </div>
                            <div class="flex border-t border-gray-300 py-2">
                                <span class="text-black">Boja</span>
                                <span class="ml-auto text-black">{{ $articleColor }}</span>
                            </div>
                            <div class="flex border-t border-gray-300 py-2">
                                <span class="text-black">Veličina</span>
                                <span class="ml-auto text-black">{{ $articleSize }}</span>
                            </div>
                            @auth
                                @php
                                    $carbon=Carbon\Carbon::now();
                                    $m = null;
                                    $dayToday = $carbon->format('l');

                                   if ($dayToday === 'Sunday') {
                                    $m = $carbon->lte($market->endTimeSunday) && $carbon->gte($market->startTimeSunday);
                                   } else {
                                    $m = $carbon->lte($market->endTime) && $carbon->gte($market->startTime);
                                   }
                                @endphp
                                @if($m)
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
                                <span class="title-font font-medium text-2xl text-black">Ukupno: {{ $articleTotal }} KM {!! $calcTempPrice != 0 ? '<span class="text-orange-500"> ( '. $calcTempPrice . ' KM) </span>' : '' !!}</span>
                                @auth
                                    @php
                                        $carbon=Carbon\Carbon::now();
                                        $m = null;
                                        $dayToday = $carbon->format('l');

                                       if ($dayToday === 'Sunday') {
                                        $m = $carbon->lte($market->endTimeSunday) && $carbon->gte($market->startTimeSunday);
                                       } else {
                                        $m = $carbon->lte($market->endTime) && $carbon->gte($market->startTime);
                                       }
                                    @endphp
                                    @if($m)
                                        <button wire:click="addToCart({{ $this->articalId }}, {{ $this->qty }})"
                                            class="flex ml-auto text-white bg-orange-500 border-0 py-2 px-6 focus:outline-none hover:bg-orange-600 rounded"  wire:click.stop="addToCart({{ $article->id }})">
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

    <x-jet-dialog-modal wire:model="showCart" :maxWidth="'modal-full'">
        <x-slot name="title">
            Detalji korpe
            <button wire:click="$set('showCart', false)" wire:loading.attr="enabled" class="float-right w-5 h-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
            <div id="sidebar">
                <div class="gradient-line"></div>
                <div class="header">
                    <h1>Odaberite lokaciju za dostavu</h1>
                    <p class="py-4">
                        Ukoliko želite da dostavite na trenutnu adresu, odaberite "trenutna adresa"
                    </p>
                    <div class="gradient-line"></div>
                    <p class="py-4">
                        Ukoliko želite da dostavite na pronadjete adresu, odaberite "pronadji adresu" a zatim upisite neke dodatne detalje oko vaše adrese.
                    </p>
                    <div class="gradient-line"></div>
                    <p class="py-4">
                        Ukoliko niste pronašli vašu tačnu adresu, možete nam pomoći tako što ćete kliknuti na kuću, zgradu ili površinu. Na taj način ste 100% sigruni da je to adersa gdje želite da dostavimo.
                    </p>
                    <div class="gradient-line"></div>

                    <label for="current" class="py-4">
                        Koristi trenutnu adresu
                        <input type="radio" name="address" id="current" value="current">
                    </label>

                    <label for="select">
                        Izaberite adresu
                        <input type="radio" name="address" id="select" value="select">
                    </label>
                    <div class="search-container">
                        <h2 class="city-label">Unesite vasu adresu</h2>
                        <div class="outer-city-field-container">
                            <img src="/map/resources/outline-search-24px.svg">
                            <div class="inner-city-field-container">
                                <div contenteditable="true" class="city-field"></div>
                                <div class="city-field-suggestion"></div>
                            </div>
                        </div>
                    </div>

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
            <div>
            <div id="map"></div>
            </div>
            <div class="container mx-auto mt-10">
                <div class="flex shadow-md my-10">
                    <div class="w-3/4 bg-white px-5 py-5">
                        <div class="flex justify-between border-b pb-8">
                            <h1 class="font-semibold text-2xl">Korpa</h1>
                            <h2 class="font-semibold text-2xl">{{ $cartTotalItems }} Artikla</h2>
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
                                    <span class="font-bold text-sm">{{ $item->name }}</span>
                                    <span class="text-red-500 text-xs">{{ $item->market }}</span>
                                    <a role="button" class="font-semibold hover:text-red-500 text-gray-500 text-xs" wire:click="removeFromCart('{{ $item->__raw_id }}')">Izbriši</a>
                                </div>
                            </div>
                            <div class="flex justify-center w-1/5"  wire:click.stop="updateCartQty('{{ $item->__raw_id }}', {{ $item->qty - 1 }})">
                                <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                                </svg>

                                <input class="mx-2 border text-center w-8" type="text" value="{{ $item->qty }}">

                                <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512" wire:click.stop="updateCartQty('{{ $item->__raw_id }}', {{ $item->qty + 1 }})">
                                    <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                                </svg>
                            </div>
                            <span class="text-center w-1/5 font-semibold text-sm">{{ $item->price }} KM</span>
                            <span class="text-center w-1/5 font-semibold text-sm">{{ $item->total }} KM</span>
                        </div>
                        @endforeach

                        <a role="button" class="flex font-semibold text-indigo-600 text-sm mt-10" wire:click="$set('showCart', false)">
                            <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                            Nastavite kupovati
                        </a>
                    </div>
                    <div id="summary" class="w-1/4 px-8 py-10">
                        <h1 class="font-semibold text-2xl border-b pb-8">Detalji narudžbe</h1>
                        <div class="flex justify-between mt-10 mb-5">
                            <span class="font-semibold text-sm uppercase">Artikli ( {{ $cartTotalItems }} )</span>
                            <span class="font-semibold text-sm">{{ $totalPrice - $totalShipping }} KM</span>
                        </div>
                        <div>
                            <label class="font-medium inline-block mb-3 text-sm uppercase">Dostava</label>
                            <p class="block p-2 text-gray-600 w-full text-sm">Standardna dostava - {{ $totalShipping }} KM</p>
                        </div>

                        <div class="border-t mt-8">
                            <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                                <span>Ukupan iznos</span>
                                <span>{{ $totalPrice }} KM</span>
                            </div>
                            <button class="bg-indigo-500 font-semibold py-3 text-sm text-white uppercase w-full disabled:opacity-50" disabled>Završi</button>
                        </div>
                    </div>

                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showCart', false)" wire:loading.attr="enabled">
                {{ __('Zatvori') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    @endif
    <script>

        document.addEventListener("DOMContentLoaded", () => {
        var mySwiper = new Swiper('.swiper-container', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            autoplay: {
                delay: 5000,
            },

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        })

        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        const clearCart = document.querySelector('.clear-cart');
        addToCartButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                $.notify("Uspjesno ste dodali artikal u korpu.", "success");
            });
        });

        clearCart.addEventListener('click', () => {$cartOpen
            $.notify("Korpa je očišćena.", "warn");
        });

        const navigateToCart = document.querySelector('.navigateToCart');

        Livewire.hook('component.initialized', (component) => {
            console.log(component.el);
            if (component.el.classList.contains('catalog')) {
                navigateToCart.addEventListener('click', (e) => {
                    e.preventDefault();
                    component.set('cartOpen', true);
                });
            }
        })
        });
    </script>
    <script type="module" src="/map/js/app.js"></script>
</div>
