<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <title>{{ config('app.name', 'm-store') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>

        body {
            overflow-x: hidden;
        }

        body.preloader-active .preloader {
            display: block;
            background-color: #f1c40f;
            position: fixed;
            height: 100vh;
            width: 100vw;
            z-index: 99999;
        }

        .preloader-active  h1 {
            position: fixed;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            left: 50%;
            top: 58%;
            margin-left: -20px;
        }

        .preloader-active .body {
            position: fixed;
            top: 50%;
            margin-left: -50px;
            left: 50%;
            animation: speeder .4s linear infinite;
            z-index: 9999;
        }

        .preloader-active .body > span {
            height: 5px;
            width: 35px;
            background: #000;
            position: absolute;
            top: -19px;
            left: 60px;
            border-radius: 2px 10px 1px 0;
        }

        .preloader-active .base span {
            position: absolute;
            width: 0;
            height: 0;
            border-top: 6px solid transparent;
            border-right: 100px solid #000;
            border-bottom: 6px solid transparent;
        }

        .preloader-active .base span:after {
            content: "";
            height: 22px;
            width: 22px;
            border-radius: 50%;
            background: #000;
            position: absolute;
            right: -110px;
            top: -16px;
        }

        .preloader-active .base span:before {
            content: "";
            position: fixed;
            width: 0;
            height: 0;
            border-top: 0 solid transparent;
            border-right: 55px solid #000;
            border-bottom: 16px solid transparent;
            top: -16px;
            right: -98px;
        }

        .preloader-active .face {
            position: fixed;
            height: 12px;
            width: 20px;
            background: #000;
            border-radius: 20px 20px 0 0;
            transform: rotate(-40deg);
            right: -125px;
            top: -15px;
            z-index: 9999;
        }

        .preloader-active .face:after {
            content: "";
            height: 12px;
            width: 12px;
            background: #000;
            right: 4px;
            top: 7px;
            position: absolute;
            transform: rotate(40deg);
            transform-origin: 50% 50%;
            border-radius: 0 0 0 2px;
        }

        .preloader-active .body > span > span:nth-child(1),
        .preloader-active .body > span > span:nth-child(2),
        .preloader-active.body > span > span:nth-child(3),
        .preloader-active .body > span > span:nth-child(4) {
            width: 30px;
            height: 1px;
            background: #000;
            position: absolute;
            animation: fazer1 .2s linear infinite;
        }

        .preloader-active .body > span > span:nth-child(2) {
            top: 3px;
            animation: fazer2 .4s linear infinite;
        }

        .preloader-active .body > span > span:nth-child(3) {
            top: 1px;
            animation: fazer3 .4s linear infinite;
            animation-delay: -1s;
        }

        .preloader-active .body > span > span:nth-child(4) {
            top: 4px;
            animation: fazer4 1s linear infinite;
            animation-delay: -1s;
        }

        @keyframes fazer1 {
            0% {
                left: 0;
            }
            100% {
                left: -80px;
                opacity: 0;
            }
        }

        @keyframes fazer2 {
            0% {
                left: 0;
            }
            100% {
                left: -100px;
                opacity: 0;
            }
        }

        @keyframes fazer3 {
            0% {
                left: 0;
            }
            100% {
                left: -50px;
                opacity: 0;
            }
        }

        @keyframes fazer4 {
            0% {
                left: 0;
            }
            100% {
                left: -150px;
                opacity: 0;
            }
        }

        @keyframes speeder {
            0% {
                transform: translate(2px, 1px) rotate(0deg);
            }
            10% {
                transform: translate(-1px, -3px) rotate(-1deg);
            }
            20% {
                transform: translate(-2px, 0px) rotate(1deg);
            }
            30% {
                transform: translate(1px, 2px) rotate(0deg);
            }
            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }
            50% {
                transform: translate(-1px, 3px) rotate(-1deg);
            }
            60% {
                transform: translate(-1px, 1px) rotate(0deg);
            }
            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }
            80% {
                transform: translate(-2px, -1px) rotate(1deg);
            }
            90% {
                transform: translate(2px, 1px) rotate(0deg);
            }
            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
        }

        .longfazers {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 9998;
        }

        .longfazers span {
            position: fixed;
            height: 2px;
            width: 20%;
            background: #000;
        }

        .longfazers span:nth-child(1) {
            top: 20%;
            animation: lf .6s linear infinite;
            animation-delay: -5s;
        }

        .longfazers span:nth-child(2) {
            top: 40%;
            animation: lf2 .8s linear infinite;
            animation-delay: -1s;
        }

        .longfazers span:nth-child(3) {
            top: 60%;
            animation: lf3 .6s linear infinite;
        }

        .longfazers span:nth-child(4) {
            top: 80%;
            animation: lf4 .5s linear infinite;
            animation-delay: -3s;
        }

        @keyframes lf {
            0% {
                left: 200%;
            }
            100% {
                left: -200%;
                opacity: 0;
            }
        }

        @keyframes lf2 {
            0% {
                left: 200%;
            }
            100% {
                left: -200%;
                opacity: 0;
            }
        }

        @keyframes lf3 {
            0% {
                left: 200%;
            }
            100% {
                left: -100%;
                opacity: 0;
            }
        }

        @keyframes lf4 {
            0% {
                left: 200%;
            }
            100% {
                left: -100%;
                opacity: 0;
            }
        }

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <!-- Styles -->

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
<!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Development -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script async src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js" onload="initTippy()"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
            integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
            crossorigin="anonymous"></script>

    <style>
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
    @endif


    {{--        <!-- Production -->--}}
    {{--        <script src="https://unpkg.com/@popperjs/core@2"></script>--}}
    {{--        <script src="https://unpkg.com/tippy.js@6"></script>--}}
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
    <header class="bg-white shadow">
        @livewire('navigation-dropdown')
    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

@auth
    @php
        $notifications = auth()->user()->unreadNotifications;
    @endphp
    <div
        class="alert-toast alert-toast-ads fixed bottom-0 right-0 m-8 w-4/6 md:w-full max-w-sm {{ count($notifications) ? '' : 'hidden' }}">
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
@endauth

@stack('modals')

@livewireScripts

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

    $(function () {
        $('.mark-as-read').click(function () {
            let request = sendMarkRequest($(this).data('id'));
        });
        $('.alert-toast').click(function () {
            let request = sendMarkRequest();
        });

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

        $(window).bind("load", function() {
            $('.preloader').fadeOut('1000', () => {
                $('body').removeClass('preloader-active');
                const addToCartButtons = document.querySelectorAll('.add-to-cart');
                const clearCart = document.querySelector('.clear-cart');
                addToCartButtons.forEach((btn) => {
                    btn.addEventListener('click', () => {
                        $.notify("Uspjesno ste dodali artikal u korpu.", "success");
                    });
                });

                if(clearCart) {
                    clearCart.addEventListener('click', () => {
                        $.notify("Korpa je očišćena.", "warn");
                    });
                }
            });

        });


    });
</script>

</body>
</html>
