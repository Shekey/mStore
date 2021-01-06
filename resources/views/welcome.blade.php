<x-app-layout>
    <style>

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
        .gradient span {
            position: relative;
            display: block;
        }

        .gradient span:before {
            content: '';
            background: rgb(2,0,36);
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(255,90,31,1) 90%);
            left: 0;
            width: calc(100% + (100vw - 100% - 16px) / 2);
            height: 2px;
            bottom: -10px;
            position: absolute;
        }

        .fade {
            transition: opacity 0.6s ease-in;
            z-index: 1;
        }

        .fadeOut { opacity: 0; }
        .fadeIn { opacity: 1; }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
    </x-slot>
        <div class="fixed-bg" style="position: fixed; opacity: 0.1; z-index: 0; top: 50%; left: 50%;transform: translate(-50%, -50%)">
            <img src="/assets/logo2.png" alt="Logo image" style="width: 80vw;">
        </div>
        <div class="relative" style="z-index: 1;">
            @if ($message = Session::get('error'))
                <div
                    class="bg-orange-600 flash-message w-full absolute left-0 w-full visible"
                    style="top: 0;z-index: 100">
                    <div class="container mx-auto py-3 px-3 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between flex-wrap">
                            <div class="w-0 flex-1 flex items-center">
                        <span class="flex p-2 rounded-lg bg-orange-800">
                          <!-- Heroicon name: speakerphone -->
                          <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                          </svg>
                        </span>
                                <p class="ml-3 font-medium text-white truncate"><span class="hidden md:inline">{{ $message }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <img src="/assets/welcome.jpg" alt="Multi Store slika" style="width: 100vw; position: relative; z-index: 110;">
            <div class="bg-green-200 text-green-dark p-4 text-center" role="alert">
                <p>Ukoliko želite da pregledate ili kupite neki od artikala, potrebno je da odaberete jednu od radnji.</p>
            </div>

            <div class="p-6 leading-normal container mx-auto flex flex-wrap">
                @if ($data->count())
                    @foreach ($data as $group => $row)
                        <h3 class="text-gray-700 text-3xl sm:text-5xl font-bold gradient-text font-bold mb-6 gradient" style="flex-basis: 100%;"><span>{{ $row->first()->type->name }}</span></h3>
                        @foreach ($row as $group => $i)
                            @include('partials.list-markets')
                        @endforeach
                    @endforeach
                @else
                    <p class="mb-8 leading-relaxed">Nema dodanih prodavnica</p>
                @endif
            </div>

            <section style="background-color: #f88c20; position: relative; z-index: 100;">
                    <div class="container mx-auto px-6 text-center py-20">
                        <h2 class="mb-1 text-4xl font-bold text-center text-white">
                            Želite povećati prodaju?
                        </h2>
                        <h3 class="my-1 text-2xl text-white mb-10">
                            Kontaktirajte nas kako bi smo dodali radnju i povećajte zaradu.
                        </h3>
                        <a href="/kontakt"
                            class="bg-white font-bold rounded-full mt-6 py-4 px-8 shadow-lg uppercase tracking-wider">
                            Kontaktirajte nas!
                        </a>
                    </div>
                </section>
        </div>
</x-app-layout>
