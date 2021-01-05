<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="m-store je stranica koja vam omogućuje da naručite artikle i dobijete ih na vašu adresu."/>
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <title>{{ config('app.name', 'm-store') }}</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-83WC5E1FXR"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-83WC5E1FXR');
    </script>

    <style>
        body {
            overflow-x: hidden;
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
            padding: 13px 0;
            outline: 0;
            border: 1px solid transparent;
            border-bottom: 1px solid #000;
            border-radius: 0;
            background-position: 100% center;
        }

        .preloader {
            background-color: #f58b1e;
            position: fixed;
            height: 100%;
            width: 100vw;
            z-index: -1;
            top: 0;
        }

        body.preloader-active .preloader {
            display: block;
            z-index: 999;
        }

        .preloader-active .body {
            position: absolute;
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
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
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

        @media only screen and (max-width: 600px) {
            .logo {
                width: 130px !important;
            }
        }

        @media only screen and (min-width: 1000px) {
            .market-item-img {
                min-height: 320px;
            }
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
            <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" crossorigin="anonymous"/>

            <!-- JS API -->
            <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js" crossorigin="anonymous"></script>
            <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js" crossorigin="anonymous"></script>
            <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" crossorigin="anonymous"></script>
            <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" crossorigin="anonymous"></script>
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

        <footer class="footer bg-white relative pt-1 border-b-2 border-blue-700">
            <div class="container mx-auto px-6">

                <div class="sm:flex sm:mt-8">
                    <div class="mt-8 sm:mt-0 sm:w-full sm:px-8 flex flex-col md:flex-row justify-between">
                        <div class="flex flex-col md:w-1/3 pb-6 md:pb-0">
                            <img data-src="/assets/logo2.png" class="lozad" alt="Image logo" width="150" height="80">
                            <p class="my-2 mt-4">Multi store je mjesto gdje možete naručivati online.</p>
                            <p>Za svakih potrošenih 50km dobijate bodove gratis, koje kasnije možete da potrošite. Sve što je potrebno jeste da se registrujete i krenete kupovati.</p>
                        </div>
                        <div class="flex flex-col border-t-2 border-gray-300 md:border-0">
                            <span class="font-bold text-gray-700 uppercase mt-4 md:mt-0 mb-6">Radnje</span>
                            <span class="my-2"><a href="#" class="text-orange-700 text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-orange-700  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-orange-700 text-md hover:text-blue-500">link 1</a></span>
                        </div>
                        <div class="flex flex-col border-t-2 border-gray-300 md:border-0">
                            <span class="font-bold text-gray-700 uppercase mt-4 md:mt-0 mb-6">Brzi linkovi</span>
                            <span class="my-2"><a href="/login" class="text-orange-700 text-md hover:text-blue-500">Logirajte se</a></span>
                            <span class="my-2"><a href="/register" class="text-orange-700  text-md hover:text-blue-500">Registrujte se</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-auto px-6">
                <div class="mt-16 border-t-2 border-gray-300 flex flex-col items-center">
                    <div class="sm:w-2/3 text-center py-6">
                        <p class="text-sm text-orange-700 font-bold mb-2">
                            © 2021 MULTI STORE
                        </p>
                    </div>
                </div>
            </div>
        </footer>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>

{{--<script src="https://unpkg.com/@popperjs/core@2"></script>--}}
{{--<script src="https://unpkg.com/tippy.js@6" onload="initTippy()"></script>--}}
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script async src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js" onload="initTippy()"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
        integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
        crossorigin="anonymous"></script>
<!-- Scripts -->

@if(count(\Overtrue\LaravelShoppingCart\Facade::all()) && request()->routeIs('cart'))
    <script type="module" src="/map/js/app.js"></script>
@endif

@if(request()->routeIs('catalog'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js" integrity="sha512-Gfrxsz93rxFuB7KSYlln3wFqBaXUc1jtt3dGCp+2jTb563qYvnUBM/GP2ZUtRC27STN/zUamFtVFAIsRFoT6/w==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js" crossorigin="anonymous"></script>
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

    @auth
        @if(request()->routeIs('orders'))
            setTimeout(() => {
                Livewire.emit('orderNumber:update')
            },60000);
        @endif
    @endauth

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
            if($("header+div")[0]) {
                $("header+div")[0].scrollIntoView({
                    behavior: "smooth", // or "auto" or "instant"
                    block: "start",
                });
            }
        });

        $('.admin-articles nav').click(function () {
            if ($(".admin-articles")) {
                $(".admin-articles")[0].scrollIntoView({
                    behavior: "smooth", // or "auto" or "instant"
                    block: "start",
                });
            }
        });
    }

    function removePreloader(time, speed) {
        setTimeout(() => {
            $('.preloader').fadeOut(speed, () => {
                $('body').removeClass('preloader-active');
            });
        }, time)
    }

    $(function () {
        $('.mark-as-read').click(function () {
            let request = sendMarkRequest($(this).data('id'));
        });

        $('.alert-toast-ads').click(function () {
            let request = sendMarkRequest();
        });

        @if(request()->routeIs('home'))

            var wasAbove = false;
            const observerOptions = {
                    root: null,
                    rootMargin: "0px",
                    threshold: 0.6
                };

            function observerCallback(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // fade in observed elements that are in view
                        entry.target.classList.replace('fadeOut', 'fadeIn');
                    }
                });
            }

            const fadeElms = document.querySelectorAll('.fade');

            const observer = new IntersectionObserver(observerCallback, observerOptions);
            fadeElms.forEach(el => observer.observe(el))
        @endif

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

            if($("header+div")[0]) {
                $("header+div")[0].scrollIntoView({
                    behavior: "instant", // or "auto" or "instant"
                    block: "start",
                });
            }
        });

        const btnFinishOrder = document.querySelector('.finishOrderBtn');

        if(btnFinishOrder) {
            btnFinishOrder.addEventListener('click', event => {
                const eventSent = new CustomEvent("sent");
                document.dispatchEvent(eventSent);
            });
        }
    });

    $(window).bind("load", function() {
        @if(request()->routeIs('cart'))
            removePreloader(800, "slow");
        @else
            removePreloader(300, "slow");
        @endif
    });
</script>

</body>
</html>
