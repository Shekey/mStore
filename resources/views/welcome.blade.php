<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
    </x-slot>
        <div class="relative">
            <img src="/assets/welcome.jpg" alt="Multi Store slika" style="width: 100vw; height: calc(100vh - 80px); object-fit: cover;">
            <div class="bg-green-200 text-green-dark p-4 text-center" role="alert">
                <p class="font-bold">Odaberite prodavnicu</p>
                <p>Ukoliko želite da pregledate ili kupite neki od artikala, potrebno je da odaberete jednu od prodavnica.</p>
            </div>
            <div class="p-6 min-w-full leading-normal">
                @if ($data->count())
                    @foreach($data as $i)
                        @include('partials.list-markets')
                    @endforeach
                @else
                    <p class="mb-8 leading-relaxed">Nema dodanih prodavnica</p>
                @endif
            </div>
        </div>
</x-app-layout>
