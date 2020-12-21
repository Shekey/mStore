<x-app-layout>
    <style>
        .gradient span{
            position: relative;
        }

        .gradient span:before {
            content: '';
            background: rgb(2,0,36);
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(255,90,31,1) 90%);
            left: calc((100vw - 100% - 16px) / 2 * -1);
            left: -10px;
            width: calc(100% + 20px);
            height: 6px;
            bottom: -10px;
            position: absolute;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
    </x-slot>
        <div class="relative">
            <img src="/assets/welcome.jpg" alt="Multi Store slika" style="width: 100vw; height: calc(100vh - 80px); object-fit: cover; position: relative; z-index: 10;">
            <div class="bg-green-200 text-green-dark p-4 text-center" role="alert">
                <p>Ukoliko želite da pregledate ili kupite neki od artikala, potrebno je da odaberete jednu od radnji.</p>
            </div>
            <div class="p-6 leading-normal container mx-auto">
                @if ($data->count())
                    @foreach ($data as $group => $row)
                        <h3 class="text-gray-700 text-4xl font-medium gradient-text text-center font-bold mb-4 gradient"><span>{{ $row->first()->type->name }}</span></h3>
                        @foreach ($row as $group => $i)
                            @include('partials.list-markets')
                        @endforeach
                    @endforeach
                @else
                    <p class="mb-8 leading-relaxed">Nema dodanih prodavnica</p>
                @endif
            </div>
        </div>
</x-app-layout>
