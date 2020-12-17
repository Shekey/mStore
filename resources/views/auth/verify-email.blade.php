<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <img src="/assets/logo.png" alt="Image logo" width="250" height="200">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Hvala što ste se prijavili! Prije početka, biste li mogli potvrditi svoju adresu e-pošte klikom na vezu koju smo vam upravo poslali e-poštom? Ako niste dobili e-poštu, rado ćemo vam poslati drugu.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-gray-600">
                {{ __('Novi link za provjeru poslana je na adresu e-pošte koju ste naveli tijekom registracije.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('Ponovno pošalji e-poštu za potvrdu') }}
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Odjava') }}
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
