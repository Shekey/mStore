<section class="text-gray-700 body-font">
    <div class="container mx-auto flex flex-wrap px-5 py-4 md:flex-row flex-col items-center">
        <div class="lg:flex-grow md:w-1/2 sm:pl-0 md:pl-0 flex flex-col md:items-start md:text-left items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-2 font-medium text-gray-900"><a href="/prodavnica/{{ $i->id }}" class="capitalize flex items-center">{{ $i->name }}<span class="ml-4 inline-block bg-gray-900 text-white px-2 rounded-full uppercase font-semibold text-xl tracking-wide">{{ $i->points }} @if($i->points > 1) BODA @else BOD @endif GRATIS</span></a></h1>
            <p class="mb-3">
                {!! $i->freeDelivery == 0 ? '<span class="inline-block bg-red-200 text-teal-800 px-2 rounded-full uppercase font-semibold text-xl tracking-wide">Dostava se plaća (' . $i->orderPaid . 'KM )</span>' : '<span class="inline-block bg-green-200 text-teal-800 text-xl px-2 rounded-full uppercase font-semibold tracking-wide">Besplatna dostava</span>'  !!}
            </p>
            @php
                $carbon=Carbon\Carbon::now();
                $dayToday = $carbon->format('l');
            @endphp
            <div class="mb-8 leading-relaxed flex items-center justify-center" style="flex-wrap: wrap;">
                <p class="flex-1" style="flex-basis: 100%;"><b class="mr-3" style="display: block;">Radno vrijeme</b> @if($dayToday !== 'Sunday')Pon - Pet: {{  substr($i->startTime, 0, -3) }} - {{  substr($i->endTime, 0, -3) }} @else Nedeljom:  {{  substr($i->startTimeSunday, 0, -3) }} - {{  substr($i->endTimeSunday, 0, -3) }} @endif </p>
                {!! $i->isClosed == 1 ? '<span class="ml-4 mt-2 inline-block bg-red-300 text-teal-800 px-2 rounded-full uppercase font-semibold text-xl tracking-wide">Zatvoreno</span>' : '<span class="ml-4 mt-2 inline-block bg-green-300 text-teal-800 text-xl px-2 rounded-full uppercase font-semibold tracking-wide">Otvoreno</span>'  !!}
            </div>
            @auth
                <div class="flex justify-center flex-wrap mb-5">
                    <button class="inline-flex text-white mt-2 bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" wire:click="updateShowModal({{ $i->id }})">{{ __('Uredi') }}</button>
                    <button class="ml-4 inline-flex mt-2 text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg" wire:click="deleteShowModal({{ $i->id }})">{{ __('Izbriši') }}</button>
                    <a href="/prodavnice/{{ $i->id }}/artikli" class="ml-4 mt-2 inline-flex text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg">{{ __('Artikli') }}</a>
                </div>
            @endauth
        </div>
        <a href="/prodavnica/{{ $i->id }}" class="lg:max-w-xs lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0 order-first md:order-last">
            @if (!App::environment('production'))
            <img class="object-cover object-center rounded" alt="hero" src="/storage/{{ $i->image }}">
            @else
                <img class="object-cover object-center rounded" alt="hero" src="/public/storage/{{ $i->image }}">
            @endif
        </a>
    </div>
</section>
