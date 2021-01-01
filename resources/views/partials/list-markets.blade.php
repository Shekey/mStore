<section class="text-black body-font flex flex-col lg:w-1/3 mb-8 px-0 relative">
    <div class="container mx-auto flex flex-wrap sm:px-0 py-4 md:flex-row flex-col justify-center">
        <div class="lg:flex-grow md:w-1/2 sm:pl-0 md:pl-0 items-center flex flex-col items-center text-center">
            @if($i->points > 1)<h1 class="title-font text-3xl mb-2 font-medium text-gray-900" style="flex-basis: 100%;"><a href="/prodavnica/{{ $i->id }}" class="capitalize flex items-center">{{ $i->name }}<span class="ml-4 inline-block bg-gray-900 text-white px-2 rounded-full uppercase font-semibold text-sm tracking-wide">{{ $i->points }} @if($i->points > 1) BODA @else BOD @endif GRATIS</span></a></h1>@endif
            <p class="mb-3 font-medium mt-4">
                {!! $i->freeDelivery == 0 ? '<span class="inline-block bg-red-200 text-black px-2 rounded-full uppercase font-semibold text-xl tracking-wide">Dostava se plaća (' . $i->orderPaid . 'KM )</span>' : '<span class="inline-block bg-green-200 text-black text-xl px-2 rounded-full uppercase font-semibold tracking-wide">Besplatna dostava</span>'  !!}
            </p>
            @php
                $carbon=Carbon\Carbon::now();
                $dayToday = $carbon->format('l');
            @endphp
            <div class="mb-8 leading-relaxed flex items-center justify-center font-medium" style="flex-wrap: wrap;">
                <p class="flex-1 text-center" style="flex-basis: 100%;"><b class="mr-3" style="display: block; text-align: center;">Radno vrijeme </b> @if($dayToday !== 'Sunday')Pon - Pet: {{  substr($i->startTime, 0, -3) }} - {{  substr($i->endTime, 0, -3) }} @else Nedeljom:  {{  substr($i->startTimeSunday, 0, -3) }} - {{  substr($i->endTimeSunday, 0, -3) }} @endif </p>
                {!! $i->isClosed == 1 ? '<span class="ml-4 mt-2 inline-block bg-red-300 text-black px-2 rounded-full uppercase font-semibold text-xl tracking-wide">Zatvoreno</span>' : '<span class="ml-4 mt-2 inline-block bg-green-300 text-black text-xl px-2 rounded-full uppercase font-semibold tracking-wide">Otvoreno</span>'  !!}
            </div>
        </div>
        <a href="/prodavnica/{{ $i->id }}" class="lg:max-w-xs w-full md:w-1/2 mb-10 text-center md:mb-0 order-first flex items-center market-item-img">
            @if (!App::environment('production'))
            <img class="object-cover object-center rounded inline-block mx-auto" alt="hero" src="/storage/{{ $i->image }}" style="position: relative; z-index: 10;">
            @else
                <img class="object-cover object-center rounded inline-block mx-auto" alt="hero" src="/public/storage/{{ $i->image }}" style="position: relative; z-index: 10;">

            @endif
        </a>
    </div>
</section>
