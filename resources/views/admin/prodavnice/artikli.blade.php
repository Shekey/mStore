<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artikli') }}
        </h2>
    </x-slot>

    @livewire('artikli-live-wire')

</x-app-layout>
