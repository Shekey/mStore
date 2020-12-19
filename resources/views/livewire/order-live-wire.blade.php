<div class="bg-white pt-4 py-10 order-details">
    <style>
        button[disabled]:hover {
            cursor: not-allowed;
        }

        .f-100 {
            overflow-x: hidden;
        }

        @media (max-width: 1023px) {
            .f-100 {
                flex-basis: 100%;
            }
        }

        main {
            overflow: hidden;
        }

        .z-index-large {
            z-index: 100;
        }

        .order-finished {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 80px;
            width: 100vw;
            height: calc(100vh - 80px);
            background: #fff;
            z-index: 100;

        }
        .order-finished.hidden {
            display: none;
        }

        .border-red-500 {
            border-color: rgba(239,68,68,1);
        }

    </style>
    <div class="container mx-auto mt-10">
        <div class="flex flex-wrap z-index-large">
            <div class="f-100 lg:w-3/4 px-5 py-5">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl mb-0">Detalji narudžbe #{{ $orderId }}</h1>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Detaljnije</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Količina</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Cijena</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Iznos</h3>
                </div>

                @foreach($allOrderItems as $item)
                    <div class="flex items-center hover:bg-gray-100 px-6 py-5 mt-1 w-full mr-0">
                        <div class="flex w-2/5">
                            <div class="w-20">
                                <img class="h-24" src="{{ $item->product->images->first()->url !== null ? $item->product->images->first()->url : 'https://dummyimage.com/400x400' }}" alt="Cart item image">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm text-black">{{ $item->product->name }}</span>
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5 decrease">
                            <input class="mx-2 border text-center text-black w-8" type="text" disabled value="{{ $item->qty }}">
                        </div>
                        <span class="text-center w-1/5 font-semibold text-black text-sm">{{ $item->product->price }} KM</span>
                        <span class="text-center w-1/5 font-bold text-black text-sm">{{ $item->total }} KM</span>
                    </div>
                @endforeach
            </div>

            <div id="summary" class="f-100 lg:w-1/4 px-6 py-5">
                <h2 class="font-semibold text-2xl border-b mb-0 pb-8">Detalji narudžbe</h2>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-bold text-sm uppercase">Artikli ( {{ count($this->allOrderItems) }} )</span>
                </div>

                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Ukupan iznos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

