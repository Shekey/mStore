<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="m-store je stranica koja vam omogućuje da naručite artikle i dobijete ih na vašu adresu."/>
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <title>{{ config('app.name', 'm-store') }}</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

    @livewireStyles

    <script>
        function initTippy() {
            if (document.querySelector('.tooltip')) {
                tippy('.tooltip', {
                    content: document.getElementById('one').innerHTML,
                    allowHTML: true,
                });
            }
        }
    </script>
    <style>
        a[target="top"] {
            display: none;
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

        @-webkit-keyframes slide-in-top {
            0% {
                -webkit-transform: translateY(-1000px);
                transform: translateY(-1000px);
                opacity: 0
            }
            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
        }

        @keyframes slide-in-top {
            0% {
                -webkit-transform: translateY(-1000px);
                transform: translateY(-1000px);
                opacity: 0
            }
            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
        }

        @-webkit-keyframes slide-out-top {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
            100% {
                -webkit-transform: translateY(-1000px);
                transform: translateY(-1000px);
                opacity: 0
            }
        }

        @keyframes slide-out-top {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
            100% {
                -webkit-transform: translateY(-1000px);
                transform: translateY(-1000px);
                opacity: 0
            }
        }

        @-webkit-keyframes slide-in-bottom {
            0% {
                -webkit-transform: translateY(1000px);
                transform: translateY(1000px);
                opacity: 0
            }
            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
        }

        @keyframes slide-in-bottom {
            0% {
                -webkit-transform: translateY(1000px);
                transform: translateY(1000px);
                opacity: 0
            }
            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
        }

        @-webkit-keyframes slide-out-bottom {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
            100% {
                -webkit-transform: translateY(1000px);
                transform: translateY(1000px);
                opacity: 0
            }
        }

        @keyframes slide-out-bottom {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
            100% {
                -webkit-transform: translateY(1000px);
                transform: translateY(1000px);
                opacity: 0
            }
        }

        @-webkit-keyframes slide-in-right {
            0% {
                -webkit-transform: translateX(1000px);
                transform: translateX(1000px);
                opacity: 0
            }
            100% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                opacity: 1
            }
        }

        @keyframes slide-in-right {
            0% {
                -webkit-transform: translateX(1000px);
                transform: translateX(1000px);
                opacity: 0
            }
            100% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                opacity: 1
            }
        }

        @-webkit-keyframes fade-out-right {
            0% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                opacity: 1
            }
            100% {
                -webkit-transform: translateX(50px);
                transform: translateX(50px);
                opacity: 0
            }
        }

        @keyframes fade-out-right {
            0% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                opacity: 1
            }
            100% {
                -webkit-transform: translateX(50px);
                transform: translateX(50px);
                opacity: 0
            }
        }
    </style>

    @if(request()->routeIs('catalog'))
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.css" integrity="sha512-+1GzNJIJQ0SwHimHEEDQ0jbyQuglxEdmQmKsu8KI7QkMPAnyDrL9TAnVyLPEttcTxlnLVzaQgxv2FpLCLtli0A==" crossorigin="anonymous" />
    @endif

    @if(request()->routeIs('cart'))
        @php
            $allCartItems = \Overtrue\LaravelShoppingCart\Facade::all();
        @endphp
        @if(count($allCartItems))
            <link rel="stylesheet" type="text/css" href="/map/css/index.css" />
            <link rel="stylesheet" type="text/css" href="/map/css/sidebar.css" />
            <link rel="stylesheet" type="text/css" href="/map/css/search.css" />
            <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />

            <!-- JS API -->
            <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
            <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
            <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
            <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
        @endif
    @endif
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body class="font-sans antialiased theme-dark preloader-active">
<div class="preloader">
    <div class='body'>
        <span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </span>
        <div class='base'>
            <span></span>
            <div class='face'></div>
        </div>
    </div>
    <div class='longfazers'>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<div class="min-h-screen bg-gray-100">

    <!-- Page Heading -->
    <header class="bg-white shadow" style="position: fixed; z-index: 11; height: 80px; top: 0;
width: 100vw;">
        @livewire('navigation-dropdown')
    </header>

    <!-- Page Content -->
    <main class="bg-blue-lightest" style="margin-top: 80px;">
        {{ $slot }}
    </main>
</div>

@auth
    @php
        $notifications = auth()->user()->unreadNotifications;
    @endphp
    <div
        class="alert-toast alert-toast-ads fixed bottom-0 right-0 m-8 w-4/6 md:w-full max-w-sm {{ count($notifications) ? '' : 'hidden' }}" style="z-index: 101;">
        <input type="checkbox" class="hidden" id="ads_created">

        <label
            class="close cursor-pointer flex items-start justify-between w-full p-2 bg-green-500 py-2 rounded shadow-lg text-white"
            title="close" for="ads_created">
            <svg class="fill-current w-5 h-6 mr-2" width="18" height="18" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
            </svg>
            <div>
                <p>Na vaš račun su uplaćeni bodovi.</p>
                <ul>
                    @foreach($notifications as $notification)
                        <li><a class="text-white mt-3 block"
                               href="{{ $notification->data['url'] }}">{{ $notification->data['name'] }}
                                - {{ $notification->data['points'] }} {{ $notification->data['points'] === 1 ? 'Bod' : 'Bodova' }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                 viewBox="0 0 18 18">
                <path
                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
        </label>
    </div>
    <div
        class="alert-toast alert-toast-location fixed bottom-0 right-0 m-8 w-4/6 md:w-full max-w-sm hidden" style="z-index: 101;">
        <input type="checkbox" class="hidden" id="ads_created">

        <label
            class="close cursor-pointer flex items-start justify-between w-full p-2 bg-green-500 py-2 rounded shadow-lg text-white"
            title="close" for="ads_created">
            <svg class="fill-current w-5 h-6 mr-2" width="18" height="18" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
            </svg>
            <div>
                <p>Molim vas da uključite lokaciju</p>
            </div>
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                 viewBox="0 0 18 18">
                <path
                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
        </label>
    </div>

@endauth

@stack('modals')

@livewireScripts
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6" onload="initTippy()"></script>
{{--<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>--}}
{{--<script async src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js" onload="initTippy()"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
        integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
        crossorigin="anonymous"></script>
<!-- Scripts -->

@if(count(\Overtrue\LaravelShoppingCart\Facade::all()) && request()->routeIs('cart'))
    <script type="module" src="/map/js/app.js"></script>
@endif

@if(request()->routeIs('catalog'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js" integrity="sha512-Gfrxsz93rxFuB7KSYlln3wFqBaXUc1jtt3dGCp+2jTb563qYvnUBM/GP2ZUtRC27STN/zUamFtVFAIsRFoT6/w==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".swiper-wrapper").lightSlider({
                item: 1,
                autoWidth: false,
                slideMove: 1,
                slideMargin: 10,

                addClass: '',
                mode: "slide",
                useCSS: true,
                cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
                easing: 'linear', //'for jquery animation',////

                speed: 400, //ms'
                auto: true,
                loop: true,
                slideEndAnimation: true,
                pause: 2000,

                keyPress: false,
                controls: false,
                prevHtml: '',
                nextHtml: '',

                rtl:false,
                adaptiveHeight:false,

                vertical:false,
                verticalHeight:500,
                vThumbWidth:100,

                thumbItem:10,
                pager: false,
                gallery: false,
                galleryMargin: 5,
                thumbMargin: 5,
                currentPagerPosition: 'middle',

                enableTouch:true,
                enableDrag:true,
                freeMove:true,
                swipeThreshold: 40,

                responsive : [],
            });

            window.addEventListener('initSlider', event => {
                $("#images").lightSlider({
                    item: 1,
                    autoWidth: false,
                    slideMove: 1,
                    slideMargin: 10,
                    pauseOnHover: true,
                    adaptiveHeight: true,

                    addClass: '',
                    mode: "slide",
                    useCSS: true,
                    cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
                    easing: 'linear', //'for jquery animation',////

                    speed: 400, //ms'
                    auto: false,
                    loop: false,
                    slideEndAnimation: true,
                    pause: 2000,

                    keyPress: false,
                    controls: false,
                    prevHtml: '',
                    nextHtml: '',

                    rtl:false,

                    vertical:false,
                    verticalHeight:500,
                    vThumbWidth:100,

                    thumbItem:10,
                    pager: true,
                    gallery: false,
                    galleryMargin: 5,
                    thumbMargin: 5,
                    currentPagerPosition: 'middle',

                    enableTouch:true,
                    enableDrag:true,
                    freeMove:true,
                    swipeThreshold: 40,

                    responsive : [],

                    onBeforeStart: function (el) {},
                    onSliderLoad: function (el) {},
                    onBeforeSlide: function (el) {},
                    onAfterSlide: function (el) {},
                    onBeforeNextSlide: function (el) {},
                    onBeforePrevSlide: function (el) {}
                });
            });
        });
    </script>

@endif
<script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('markNotification') }}", {
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    function paginationEvents() {
        $('.pagination').click(function () {
            $("header+div")[0].scrollIntoView({
                behavior: "smooth", // or "auto" or "instant"
                block: "start",
            });
        });

        $('.admin-articles nav').click(function () {
            $(".admin-articles")[0].scrollIntoView({
                behavior: "smooth", // or "auto" or "instant"
                block: "start",
            });
        });
    }

    $(function () {
        $('.mark-as-read').click(function () {
            let request = sendMarkRequest($(this).data('id'));
        });

        $('.alert-toast-ads').click(function () {
            let request = sendMarkRequest();
        });

        paginationEvents();

        const swiper = document.querySelector('.swiper-container');
        if (swiper) {
            var mySwiper = new Swiper(swiper, {
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
        }

        window.addEventListener('addedArticleCart', event => {
            $.notify("Uspjesno ste dodali artikal u korpu.", "success");
        });

        window.addEventListener('removeIgnore', event => {
            $(".w-full.text-black").removeAttr("wire:ignore","");
        });


        window.addEventListener('repeatedOrder', event => {
            $.notify("Uspjesno ste dodali artikle.", "success");
        });

        window.addEventListener('articlesInActive', event => {
            $.notify("Nažalost ne možemo vam isporučiti artikle označeni sa crvenom linijom", "error");
        });

        window.addEventListener('updatedArticleCart', event => {
            $.notify("Uspjesno ste ažurirali količinu artikla.", "success");
        })

        window.addEventListener('removedArticleCart', event => {
            $.notify("Uspješno ste obrisali artikal iz korpe.", "warn");
        });

        window.addEventListener('clearedArticleCart', event => {
            $.notify("Uspješno ste obrisali sve artikale iz korpe.", "error");
        });

        document.addEventListener('processed', event => {
            removePreloader(300, "slow");
            paginationEvents();
        });

        document.addEventListener('foundLocation', event => {
            removePreloader(300, "slow");
        });

        document.addEventListener('locationEnable', event => {
            $('.alert-toast-location').removeClass('hidden');

            setTimeout(() => {
                $('.alert-toast-location').addClass('hidden');
            }, 5000)
        });

        document.addEventListener('startLocation', event => {
            $('body').addClass('preloader-active');
            $('.preloader').css("display", "");
        });

        document.addEventListener('sent', event => {
            $('body').addClass('preloader-active');
            $('.preloader').css("display", "");

            $("header+div")[0].scrollIntoView({
                behavior: "instant", // or "auto" or "instant"
                block: "start",
            });
        });

        const btnFinishOrder = document.querySelector('.finishOrderBtn');

        if(btnFinishOrder) {
            btnFinishOrder.addEventListener('click', event => {
                const eventSent = new CustomEvent("sent");
                document.dispatchEvent(eventSent);
            });
        }

        function removePreloader(time, speed) {
            setTimeout(() => {
                $('.preloader').fadeOut(speed, () => {
                    $('body').removeClass('preloader-active');
                });
            }, time)
        }

        $(window).bind("load", function() {
            @if(request()->routeIs('cart'))
                removePreloader(800, "slow");
            @else
                removePreloader(300, "slow");
            @endif
        });

    });
</script>

<script id="_waun4f">var _wau = _wau || []; _wau.push(["dynamic", "iyvz1vwz2w", "n4f", "c4302bffffff", "small"]);</script><script async src="//waust.at/d.js"></script>
</body>
</html>
