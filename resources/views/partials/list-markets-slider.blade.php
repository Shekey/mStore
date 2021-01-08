<div class="blog-slider__item swiper-slide">
    <div class="blog-slider__img">
        @if (!App::environment('production'))
            <img class="object-cover object-center rounded inline-block mx-auto h-full swiper-lazy w-full" alt="hero"
                 data-src="/storage/{{ $i->image }}" style="z-index: 10;">
        @else
            <img class="object-cover object-center rounded inline-block mx-auto h-full swiper-lazy w-full" alt="hero"
                 data-src="/public/storage/{{ $i->image }}" style="z-index: 10;">
        @endif
    </div>
    @php
        $carbon=Carbon\Carbon::now();
        $dayToday = $carbon->format('l');
    @endphp
    <div class="blog-slider__content">
        <span class="blog-slider__code">@if($dayToday !== 'Sunday')Pon - Pet: {{  substr($i->startTime, 0, -3) }}
            - {{  substr($i->endTime, 0, -3) }} @else Nedeljom:  {{  substr($i->startTimeSunday, 0, -3) }}
            - {{  substr($i->endTimeSunday, 0, -3) }} @endif </span>
        <div class="blog-slider__title">{{ $i->name }}</div>
        <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate
            repellendus magni illo ea animi?
        </div>
        <a href="/prodavnica/{{ $i->id }}" class="blog-slider__button">POSJETI PRODAVNICU</a>
    </div>
    <div class="swiper-lazy-preloader"></div>
</div>

