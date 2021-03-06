<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tip prodavnice') }}
        </h2>
    </x-slot>

    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">

            @livewire('market-type-livewire')
        </div>
    </div>
</x-app-layout>
