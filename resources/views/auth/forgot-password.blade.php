<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
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
    </x-jet-authentication-card>
</x-guest-layout>
