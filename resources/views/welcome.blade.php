<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
    </x-slot>
        <div class="relative">
            <div class="p-6 min-w-full leading-normal">
                @if ($data->count())
                    @foreach($data as $i)
                        <section class="text-gray-700 body-font">
                            <div class="container mx-auto flex flex-wrap px-5 py-4 md:flex-row flex-col">
                                <div class="lg:flex-grow md:w-1/2 sm:pl-0 md:pl-0 flex flex-col md:items-start md:text-left">
                                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900 capitalize"><a href="#">{{ $i->name }}</a></h1>
                                    <p class="mb-8 leading-relaxed"><b>Gratis poeni </b>{{ $i->points }}
                                        <br>
                                        <b>Dostava</b>
                                        {!! $i->freeDelivery == 0 ? '<span class="inline-block bg-red-200 text-teal-800 px-2 rounded-full uppercase font-semibold text-xl tracking-wide">Dostava se plaća (' . $i->orderPaid . 'KM )</span>' : '<span class="inline-block bg-green-200 text-teal-800 text-xl px-2 rounded-full uppercase font-semibold tracking-wide">Besplatna dostava</span>'  !!}
                                    </p>
                                    <p class="mb-8 leading-relaxed"><b>Radno vrijeme </b>{{  substr($i->startTime, 0, -3) }} - {{  substr($i->endTime, 0, -3) }}
                                        <br>
                                    {!! $i->isClosed == 0 ? '<span class="inline-block bg-red-200 text-teal-800 px-2 rounded-full uppercase font-semibold text-xl tracking-wide">Zatvoreno</span>' : '<span class="inline-block bg-green-200 text-teal-800 text-xl px-2 rounded-full uppercase font-semibold tracking-wide">Otvoreno</span>'  !!}
                                </div>
                                <a href="#" class="lg:max-w-xs lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0 order-first md:order-last">
                                    <img class="object-cover object-center rounded" alt="hero" src="/storage/{{ $i->image }}">
                                </a>
                            </div>
                        </section>
                    @endforeach
                @else
                    <p class="mb-8 leading-relaxed">Nema dodanih prodavnica</p>
                @endif
            </div>
        </div>
</x-app-layout>
