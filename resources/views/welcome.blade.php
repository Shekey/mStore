<x-app-layout>
    <style>
        .parallax__container {
            clip: rect(0, auto, auto, 0);
            height: 100%;
            left: 0;
            overflow: hidden;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: -100;
        }

        .parallax {
            position: fixed;
            top: 0;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            width: 100%;

            /* BG behaviour */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            z-index: 12;
        }

        .content > section > * {
            z-index: 12;
            position: relative;
        }

        .content > div {
            z-index: 12;
            position: relative;
        }

        .gradient-bg {
            background: linear-gradient(90deg, #d53369 0%, #f88c20 100%);
        }

        .ball {
            position: fixed;
            border-radius: 100%;
            opacity: 0.7;
            z-index: 10;
        }

        .aspect-100 {
            position: relative;
            height: 0;
            padding-bottom: 100%;
            z-index: 1;
        }

        .aspect-100 > * {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            max-height: 100%;
        }

        .gradient {
            position: relative;
            display: block;
        }

        .gradient:before {
            content: '';
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(255, 90, 31, 1) 90%);
            left: 0;
            width: 100%;
            height: 2px;
            bottom: -10px;
            position: absolute;
        }

        .fade {
            transition: opacity 0.2s ease-in, transform 0.3s ease-in-out;
            z-index: 20;
        }

        .fadeOut {
            opacity: 0;
        }

        .fadeRightOut {
            opacity: 0;
            transform: translateX(-50px);
        }

        .fadeLeftOut {
            opacity: 0;
            transform: translateX(50px);
        }

        .fadeIn {
            opacity: 1;
        }

        .fadeLeft {
            transform: translateX(0);
            opacity: 1;
        }

        .fadeRight {
            transform: translateX(0);
            opacity: 1;
        }

        .open {
           background-color:  #83d2b8;
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



        @media (max-width: 768px) {
            .how-works img {
                max-width: 100px;
            }
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
    </x-slot>
    <div class="relative content overflow-x-hidden">
        @guest
            @if ($message = Session::get('error'))
                <div
                    class="bg-orange-600 flash-message w-full absolute left-0 w-full visible"
                    style="top: 0;z-index: 100">
                    <div class="container mx-auto py-3 px-3 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between flex-wrap">
                            <div class="w-0 flex-1 flex items-center">
                            <span class="flex p-2 rounded-lg bg-orange-800">
                              <!-- Heroicon name: speakerphone -->
                              <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                   viewBox="0 0 24 24"
                                   stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                              </svg>
                            </span>
                                <p class="ml-3 font-medium text-white"><span
                                        class="inline">{{ $message }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endguest
        <div style="height: 0; padding-bottom: calc(70.6% + 80px); width: 100%;">
            <div class="parallax" data-parallax-image="/assets/welcome.jpg"></div>
        </div>
        </div>
        <section class="relative bg-gray-100 how-works px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-20 text-center overflow-x-hidden">
                <div>
                    <h2 class="text-xl sm:text-3xl leading-tight font-bold fade fadeOut">Kako MSTORE funkcionira?</h2>
                </div>

                <div class="flex flex-col md:flex-row justify-between mt-12">
                    <div class="w-full bg-white shadow-lg rounded-lg px-4 py-6 lg:p-8 md:mx-2 lg:mx-4 fadeRightOut fade">
                        <img data-src="/assets/icon-home-2.svg" alt="" class="mx-auto h-32 lozad">
                        <h4 class="text-xl font-bold leading-tight mt-4 md:mt-8">Registracija</h4>
                        <p class="text-gray-700 mt-2">Ispunite formu i registrujte se, a admin će pregledati podatke.</p>
                    </div>

                    <div class="w-full bg-white shadow-lg rounded-lg px-4 py-6 lg:p-8 md:mx-2 lg:mx-4 mt-4 md:mt-0 fadeOut fade">
                        <img data-src="/assets/icon-home-3.svg" alt="" class="mx-auto h-32 lozad">
                        <h4 class="text-xl font-bold leading-tight mt-4 md:mt-8">Narudžba</h4>
                        <p class="text-gray-700 mt-2">Prijavite se, odaberite radnju, pregledajte artikle i naručite.</p>
                    </div>

                    <div class="w-full bg-white shadow-lg rounded-lg px-4 py-6 lg:p-8 md:mx-2 lg:mx-4 mt-4 md:mt-0 fadeLeftOut fade">
                        <img data-src="/assets/icon-home-1.svg" alt="" class="mx-auto h-32 lozad">
                        <h4 class="text-xl font-bold leading-tight mt-4 md:mt-8">Adresa za dostavu</h4>
                        <p class="text-gray-700 mt-2">Unesite adresu za dostavu, i završite narudžbu. Lako zar ne?</p>
                    </div>
                </div>
            </section>
        <section class="p-6 leading-normal relative bg-gray-100 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 flex flex-wrap overflow-x-hidden">
            @if ($data->count())
                @foreach ($data as $group => $row)
                    <div class="blog-slider relative">
                        <div class="blog-slider__wrp swiper-wrapper">
                                @foreach ($row as $group => $i)
                                    @if ($loop->index == 0)
                                        @include('partials.list-markets-slider-start')
                                    @endif
                                    @include('partials.list-markets-slider')
                                @endforeach
                        </div>
                        <div class="blog-slider__pagination"></div>
                    </div>
                @endforeach
            @else
                <p class="mb-8 leading-relaxed">Nema dodanih prodavnica</p>
            @endif

        </section>
        <div class="gradient-bg pb-4 md:pb-8">
            <svg class="wave-top" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
                        <g class="wave" fill="#f4f5f7">
                            <path
                                d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z"></path>
                        </g>
                        <g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
                            <g transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) ">
                                <path
                                    d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                                    opacity="0.100000001"></path>
                                <path
                                    d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                                    opacity="0.100000001"></path>
                                <path
                                    d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                                    opacity="0.200000003"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <section class="container mx-auto text-center px-6 mb-12 relative">
                <h1 class="w-full my-2 text-2xl md:text-5xl py-5 font-bold leading-tight text-center text-white">Želite povećati
                    prodaju?</h1>
                <div class="w-full mb-4">
                    <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <h3 class="my-4 text-xl md:text-3xl px-5 leading-tight text-white">Kontaktirajte nas kako bismo dodali radnju i povećajte
                    zaradu.</h3>

                <a href="/kontakt" target="_blank"
                   class="mx-auto inline-block lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg">Konktaktirajte
                    nas!</a>
            </section>
        </div>
    </div>
</x-app-layout>
