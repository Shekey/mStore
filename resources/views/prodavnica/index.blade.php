<x-app-layout>
    <div class="my-12 mx-auto mt-0 mb-0">
        <header>
            @php
                $ads = App\Models\Ads::all();
            @endphp
            <div class="swiper-container">
                <div class="swiper-wrapper">
                @foreach($ads as $ad)
                    <div class="swiper-slide">
                        <a href="{{ $ad->url }}" target="_blank">
                            @if (!App::environment('production'))
                            <img data-src="/storage/{{ $ad->image }}" class="swiper-lazy">
                            @else
                                <img data-src="/public/storage/{{ $ad->image }}" class="swiper-lazy">
                            @endif
                        </a>
                        <div class="swiper-lazy-preloader"></div>
                    </div>
                @endforeach
                </div>
            </div>
        </header>

        <div class="flex flex-wrap container mx-auto">
            @livewire('catalog-live-wire', ['id' => $id])
        </div>
    </div>
</x-app-layout>
