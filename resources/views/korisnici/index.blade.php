<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista korisnika
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('korisnici.create') }}" class="bg-black hover:text-white hover:bg-black-600 text-white font-bold py-2 px-4 rounded">Dodaj korisnika</a>
            </div>
            @livewire('users-live-wire')
        </div>
    </div>
</x-app-layout>
