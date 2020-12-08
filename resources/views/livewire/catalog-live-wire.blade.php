<div style="width: 100%; flex-basis: 100%;">
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
            padding-bottom: 70px;
        }

        .min-h-screen > main {
            background: #373737;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css?dp-version=1578490236"/>
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

    <div x-data="{ cartOpen: false, isOpen: false }" class="">
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
                    <div class="flex items-center sm:justify-end w-full">
                        <p class="text-white mt-0 mr-4">Ukupno ( {{ $totalPrice }} KM )</p>
                        <button @click="cartOpen = !cartOpen" class="text-white focus:outline-none mx-4 sm:mx-0">
                            <svg class="h-10 w-10" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <h4 class="text-lg font-bold text-orange-700 bg-white px-2 py-2 mt-8 text-center">Odaberite kategoriju
                    kako bi ste filtrirali artikle.</h4>
                <nav :class="isOpen ? '' : ''" class="flex justify-center items-center mt-0">

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
        <div :class="cartOpen ? 'translate-x-0 ease-out w-full h-full px-6 py-4' : 'translate-x-full ease-in'"
             class="cart fixed right-0 top-0 max-w-sm w-0 transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-medium text-black">Korpa ( {{ $totalPrice }} KM)</h3>
                <button @click="cartOpen = !cartOpen" class="text-black focus:outline-none">
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
            <a class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                <span>Završi narudzbu</span>
                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
    <main class="">
        <div class="container">
            <h3 class="text-white text-3xl font-bold text-uppercase mt-4 text-center md:text-left">Katalog artikala</h3>
            <span class="mt-3 text-sm text-white"></span>
            <div class="grid gap-10 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mt-6 articles">

                @foreach($articles as $article)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                             wire:click.stop="showDetailsArticle({{ $article->id }})"
                             style="background-image: url('https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
                            <a role="button"
                               class="add-to-cart p-2 rounded-full bg-orange-600 text-white mx-5 -mb-4 hover:bg-orange-200 focus:outline-none focus:bg-blue-500"
                               style="position: relative; z-index: 10" wire:click.stop="addToCart({{ $article->id }})">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </a>
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
    <div id="map" class="hidden" style="position:absolute; width:49%; height:100%; background:grey"></div>
    <div id="panel" class="hidden"
         style="position:absolute; width:49%; left:51%; height:100%; background:inherit"></div>

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
                            <div class="flex">
                                <span class="title-font font-medium text-2xl text-black">{{ $articleTotal }} KM {!! $calcTempPrice != 0 ? '<span class="text-orange-500"> ( '. $calcTempPrice . ' KM) </span>' : '' !!}</span>
                                <button wire:click="addToCart({{ $this->articalId }}, {{ $this->qty }})"
                                    class="flex ml-auto text-white bg-orange-500 border-0 py-2 px-6 focus:outline-none hover:bg-orange-600 rounded"  wire:click.stop="addToCart({{ $article->id }})">
                                    Kupi
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         class="w-5 h-5 ml-2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </button>
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

    <script>
        var AUTOCOMPLETION_URL = 'https://autocomplete.geocoder.ls.hereapi.com/6.2/suggest.json',
            ajaxRequest = new XMLHttpRequest(),
            query = '';

        /**
         * If the text in the text box  has changed, and is not empty,
         * send a geocoding auto-completion request to the server.
         *
         * @param {Object} textBox the textBox DOM object linked to this event
         * @param {Object} event the DOM event which fired this listener
         */
        function autoCompleteListener(textBox, event) {

            if (query != textBox.value) {
                if (textBox.value.length >= 1) {

                    /**
                     * A full list of available request parameters can be found in the Geocoder Autocompletion
                     * API documentation.
                     *
                     */
                    var params = '?' +
                        'query=' + encodeURIComponent(textBox.value) +   // The search text which is the basis of the query
                        '&beginHighlight=' + encodeURIComponent('<mark>') + //  Mark the beginning of the match in a token.
                        '&endHighlight=' + encodeURIComponent('</mark>') + //  Mark the end of the match in a token.
                        '&maxresults=5' +  // The upper limit the for number of suggestions to be included
                        // in the response.  Default is set to 5.
                        '&apikey=' + APIKEY;
                    ajaxRequest.open('GET', AUTOCOMPLETION_URL + params);
                    ajaxRequest.send();
                }
            }
            query = textBox.value;
        }


        /**
         *  This is the event listener which processes the XMLHttpRequest response returned from the server.
         */
        function onAutoCompleteSuccess() {
            /*
             * The styling of the suggestions response on the map is entirely under the developer's control.
             * A representitive styling can be found the full JS + HTML code of this example
             * in the functions below:
             */
            clearOldSuggestions();
            addSuggestionsToPanel(this.response);  // In this context, 'this' means the XMLHttpRequest itself.
            addSuggestionsToMap(this.response);
        }


        /**
         * This function will be called if a communication error occurs during the XMLHttpRequest
         */
        function onAutoCompleteFailed() {
            alert('Ooops!');
        }

        // Attach the event listeners to the XMLHttpRequest object
        ajaxRequest.addEventListener("load", onAutoCompleteSuccess);
        ajaxRequest.addEventListener("error", onAutoCompleteFailed);
        ajaxRequest.responseType = "json";


        /**
         * Boilerplate map initialization code starts below:
         */


// set up containers for the map  + panel
        var mapContainer = document.getElementById('map'),
            suggestionsContainer = document.getElementById('panel');

        //Step 1: initialize communication with the platform
        var APIKEY = 'obSf2Hrwgm1IxeXv12ai09KHpbH4bQncYYFJLThl8QM';

        var platform = new H.service.Platform({
            apikey: APIKEY,
            useCIT: false,
            useHTTPS: true
        });
        var defaultLayers = platform.createDefaultLayers();
        var geocoder = platform.getGeocodingService();
        var group = new H.map.Group();

        group.addEventListener('tap', function (evt) {
            map.setCenter(evt.target.getGeometry());
            openBubble(
                evt.target.getGeometry(), evt.target.getData());
        }, false);


        //Step 2: initialize a map - this map is centered over Europe
        var map = new H.Map(mapContainer,
            defaultLayers.vector.normal.map, {
                center: {lat: 52.5160, lng: 13.3779},
                zoom: 3
            });

        map.addObject(group);

        //Step 3: make the map interactive
        // MapEvents enables the event system
        // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
        var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

        // Create the default UI components
        var ui = H.ui.UI.createDefault(map, defaultLayers);

        // Hold a reference to any infobubble opened
        var bubble;

        /**
         * Function to Open/Close an infobubble on the map.
         * @param  {H.geo.Point} position     The location on the map.
         * @param  {String} text              The contents of the infobubble.
         */
        function openBubble(position, text) {
            if (!bubble) {
                bubble = new H.ui.InfoBubble(
                    position,
                    // The FO property holds the province name.
                    {content: '<small>' + text + '</small>'});
                ui.addBubble(bubble);
            } else {
                bubble.setPosition(position);
                bubble.setContent('<small>' + text + '</small>');
                bubble.open();
            }
        }


        /**
         * The Geocoder Autocomplete API response retrieves a complete addresses and a `locationId`.
         * for each suggestion.
         *
         * You can subsequently use the Geocoder API to geocode the address based on the ID and
         * thus obtain the geographic coordinates of the address.
         *
         * For demonstration purposes only, this function makes a geocoding request
         * for every `locationId` found in the array of suggestions and displays it on the map.
         *
         * A more typical use-case would only make a single geocoding request - for example
         * when the user has selected a single suggestion from a list.
         *
         * @param {Object} response
         */
        function addSuggestionsToMap(response) {
            /**
             * This function will be called once the Geocoder REST API provides a response
             * @param  {Object} result          A JSONP object representing the  location(s) found.
             */
            var onGeocodeSuccess = function (result) {
                    var marker,
                        locations = result.Response.View[0].Result,
                        i;

                    // Add a marker for each location found
                    for (i = 0; i < locations.length; i++) {
                        marker = new H.map.Marker({
                            lat: locations[i].Location.DisplayPosition.Latitude,
                            lng: locations[i].Location.DisplayPosition.Longitude
                        });
                        marker.setData(locations[i].Location.Address.Label);
                        group.addObject(marker);
                    }

                    map.getViewModel().setLookAtData({
                        bounds: group.getBoundingBox()
                    });
                    if (group.getObjects().length < 2) {
                        map.setZoom(15);
                    }
                },
                /**
                 * This function will be called if a communication error occurs during the JSON-P request
                 * @param  {Object} error  The error message received.
                 */
                onGeocodeError = function (error) {
                    alert('Ooops!');
                },
                /**
                 * This function uses the geocoder service to calculate and display information
                 * about a location based on its unique `locationId`.
                 *
                 * A full list of available request parameters can be found in the Geocoder API documentation.
                 * see: http://developer.here.com/rest-apis/documentation/geocoder/topics/resource-search.html
                 *
                 * @param {string} locationId    The id assigned to a given location
                 */
                geocodeByLocationId = function (locationId) {
                    geocodingParameters = {
                        locationId: locationId
                    };

                    geocoder.geocode(
                        geocodingParameters,
                        onGeocodeSuccess,
                        onGeocodeError
                    );
                }

            /*
             * Loop through all the geocoding suggestions and make a request to the geocoder service
             * to find out more information about them.
             */

            response.suggestions.forEach(function (item, index, array) {
                geocodeByLocationId(item.locationId);
            });
        }


        /**
         * Removes all H.map.Marker points from the map and adds closes the info bubble
         */
        function clearOldSuggestions() {
            group.removeAll();
            if (bubble) {
                bubble.close();
            }
        }

        /**
         * Format the geocoding autocompletion repsonse object's data for display
         *
         * @param {Object} response
         */
        function addSuggestionsToPanel(response) {
            var suggestions = document.getElementById('suggestions');
            suggestions.innerHTML = JSON.stringify(response, null, ' ');
        }


        var content = '<strong style="font-size: large;">' + 'Geocoding Autocomplete' + '</strong></br>';

        content += '<br/><input type="text" id="auto-complete" style="margin-left:5%; margin-right:5%; min-width:90%"  onkeyup="return autoCompleteListener(this, event);"><br/>';
        content += '<br/><strong>Response:</strong><br/>';
        content += '<div style="margin-left:5%; margin-right:5%;"><pre style="max-height:235px"><code  id="suggestions" style="font-size: small;">' + '{}' + '</code></pre></div>';

        suggestionsContainer.innerHTML = content;

    </script>
    <script>
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
        addToCartButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                $.notify("Uspjesno ste dodali artikal u korpu.", "success");
            });
        });
    </script>

</div>
