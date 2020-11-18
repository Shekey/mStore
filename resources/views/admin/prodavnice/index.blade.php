<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prodavnice') }}
        </h2>
    </x-slot>

    <div class="container my-12 mx-auto">
        <div class="flex flex-wrap lg:-mx-4">

            @livewire('market-live-wire')
        </div>
    </div>
</x-app-layout>
