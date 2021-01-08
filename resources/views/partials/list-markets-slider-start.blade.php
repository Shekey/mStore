<div class="blog-slider__item swiper-slide">
    <div class="blog-slider__img relative">
        @if (!App::environment('production'))
            <img class="object-cover object-center rounded inline-block mx-auto h-full swiper-lazy w-full" alt="hero"
                 data-src="/assets/logo.png" style="z-index: 10; object-cover: cover !important;">
        @else
            <img class="object-cover object-center rounded inline-block mx-auto h-full swiper-lazy w-full" alt="hero"
                 data-src="/assets/logo.png" style="z-index: 10; object-cover: cover !important;">
        @endif
    </div>
    @php
        $carbon=Carbon\Carbon::now();
        $dayToday = $carbon->format('l');
    @endphp
    <div class="blog-slider__content">
        <div class="blog-slider__title">
            {{ $row->first()->type->name }}
        </div>
    </div>
    <div class="swiper-lazy-preloader"></div>
</div>

