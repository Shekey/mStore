<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <img src="/assets/logo.png" alt="Image logo" width="250" height="200">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray600">
            {{ __('Zaboravili ste password? Nema problema. Samo nam javite svoju adresu e-pošte i mi ćemo vam poslati vezu za ponovno postavljanje lozinke koja će vam omogućiti da odaberete novu.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-gray600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Link za poništavanje lozinke e-pošte') }}
                </x-jet-button>
            </div>
        </form>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Logirajte se') }}
            </a>
        </div>


    </x-jet-authentication-card>
</x-guest-layout>
