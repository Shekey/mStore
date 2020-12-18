<div class="bg-blue-lightest py-10 wrapper container mx-auto" style="min-height: calc(100vh - 80px);">
    <div class="flex flex-wrap">
        @foreach($orders as $order)
            <a href="/narudzbe/{{ $order->id }}" class="flex flex-col lg:w-1/3 mb-8 sm:px-2 px-10">
            <img src="/assets/logo.png" alt="Logo image"
                 class="w-full object-contain object-center rounded-lg shadow-md"
                 style="border: 2px solid #f58b1e; border-radius: 10px;">
            <div class="relative px-4 -mt-16">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-baseline">
                      <span
                          class="bg-orange-200 text-orange-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                        {{ $order->created_at->diffForhumans() }}
                      </span>

                        <span
                            class="bg-green-200 text-green-800 text-xs px-2 inline-block rounded-full uppercase font-semibold tracking-wide ml-4">
                        Završeno
                      </span>
                    </div>
                    <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">Narudžba # {{ $order->id }}</h4>

                    <div class="mt-1">
                        {{ $order->total }}
                        <span class="text-gray-600 text-sm">KM</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-orange-600 text-md font-semibold">{{ count($order->orderproduct) }} {{ count($order->orderproduct) === 1 ? 'Artikal' : 'Artikala' }} </span>
                        <span class="text-sm text-gray-600">(dostavljeno za 45 min)</span>
                    </div>
                </div>
            </div>

        </a>
        @endforeach
    </div>
</div>
