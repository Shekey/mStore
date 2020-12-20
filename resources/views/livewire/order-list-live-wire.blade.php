<div class="bg-blue-lightest py-10 wrapper container mx-auto px-10 {{ !count($orders) ? 'flex items-center justify-center':'' }}" style="min-height: calc(100vh - 82px);">
    <div class="flex flex-wrap">
        @foreach($orders as $key=>$order)
            <div class="flex flex-col lg:w-1/3 mb-8 sm:px-2 px-10">
            <img src="/assets/logo.png" alt="Logo image"
                 class="w-full object-contain object-center rounded-lg shadow-md"
                 style="border: 2px solid #f58b1e; border-radius: 10px;">
                @if(auth()->user()->isAdmin)
                    <div
                       class="p-2 flex rounded-full {{ $order->isOrdered ? 'bg-green-600' : 'bg-orange-600' }} cursor-pointer text-white ml-auto hover:text-white hover:bg-orange-500 focus:outline-none focus:bg-orange-500"
                       style="width: 36px; margin-right: 30px; margin-top: -15px; z-index: 100" wire:click.stop="toggleOrderFinished({{ $order->id }}, {{ $order->isOrdered }})">
                        @if($order->isOrdered)
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @endif
                    </div>
                @endif
            <a href="/narudzbe/{{ $order->id }}" class="relative px-4 -mt-16">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-baseline">
                      <span
                          class="bg-orange-200 text-orange-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                        {{ $order->created_at->diffForhumans() }}
                      </span>

                        <span
                            class="{{ $order->isOrdered ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}  text-xs px-2 inline-block rounded-full uppercase font-semibold tracking-wide ml-4">
                        {{ $order->isOrdered ? 'Završeno' : 'Aktivna' }}
                      </span>
                    </div>
                    <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">Narudžba # {{ $key + 1 }}</h4>

                    <div class="mt-1">
                        {{ $order->total }}
                        <span class="text-gray-600 text-sm">KM</span>
                    </div>
                    <div class="mt-4">
                        @if(auth()->user()->isAdmin)<p class="text-black text-md font-semibold mb-2">{{ $order->user->name }} </p>@endif
                        <span class="text-orange-600 text-md font-semibold">{{ count($order->orderproduct) }} {{ count($order->orderproduct) === 1 ? 'Artikal' : 'Artikala' }} </span>
                       @if($order->isOrdered) <span class="text-sm text-gray-600">(dostavljeno za {{ (new \Carbon\Carbon($order->updated_at))->diff(new \Carbon\Carbon($order->created_at))->format('%h sati i %i min') }})</span>@endif
                    </div>
                </div>
            </a>

        </div>
        @endforeach

        @if(!count($orders))
            <h2 class="text-3xl sm:text-5xl lg:text-6xl text-center leading-none font-extrabold text-gray-900 tracking-tight mb-8">Nema narudžbi</h2>
        @endif
    </div>
</div>
