<div class="blog-slider__item swiper-slide">
    <a href="/prodavnica/{{ $i->id }}" class="blog-slider__img relative">
        @if (!App::environment('production'))
            <img class="object-cover object-center rounded inline-block mx-auto h-full swiper-lazy w-full" alt="hero"
                 data-src="/storage/{{ $i->image }}" style="z-index: 10;">
        @else
            <img class="object-cover object-center rounded inline-block mx-auto h-full swiper-lazy w-full" alt="hero"
                 data-src="/public/storage/{{ $i->image }}" style="z-index: 10;">
        @endif
    </a>
    @php
        $carbon=Carbon\Carbon::now();
        $dayToday = $carbon->format('l');
    @endphp
    <div class="blog-slider__content" style="width: 100%;">
        <span class="text-black font-black rounded-full p-2 mb-2 inline-block @if(!$i->isClosed) open @else bg-orange-400 @endif">@if($i->isClosed) Zatvoreno @else Otvoreno @endif<br />
        </span>
        <span class="blog-slider__code">Radno vrijeme<br />
            @if($dayToday !== 'Sunday')Pon - Pet: {{  substr($i->startTime, 0, -3) }}h
            - {{  substr($i->endTime, 0, -3) }}h @else Nedeljom:  {{  substr($i->startTimeSunday, 0, -3) }}h
            - {{  substr($i->endTimeSunday, 0, -3) }}h @endif
        </span>
        <a href="/prodavnica/{{ $i->id }}" class="blog-slider__title">{{ $i->name }}</a>
        @if($i->points >= 1 && $i->hasDelivery)
            <div class="blog-slider__text flex">
                {{ $i->points }} @if($i->points > 1) BODA @else BOD @endif GRATIS za kupovinu preko 50 KM
            </div>
        @elseif($i->points < 1 && $i->hasDelivery)
            <div class="blog-slider__text flex">
                U ovoj radnji ne ostvarujete gratis bodove za kupovinu preko 50 KM.
            </div>
        @else
            <div class="blog-slider__text flex">
                Za ovu radnju nije omogućena online kupovina.
            </div>
        @endif

        @if($i->hasDelivery)
        <div class="flex gradient text-black font-bold mb-10">
            {!! $i->freeDelivery == 0 ? 'Dostava se plaća (' . $i->orderPaid . 'KM )' : 'Besplatna dostava'  !!}
        </div>
        @endif

        <a href="/prodavnica/{{ $i->id }}" class="blog-slider__button">POSJETI RADNJU</a>
    </div>
    <div class="swiper-lazy-preloader"></div>
</div>

