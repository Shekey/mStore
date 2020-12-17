<div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 justify-center py-3 mb-6" role="alert">
    <svg class="fill-current w-4 h-4 mr-2" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
    <p>Molimo Vas da popunite sva polja. Ukoliko ne unesete ispravne podatke, račun vam neće biti odobren od strane administratora.</p>
</div>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <img src="/assets/logo.png" alt="Image logo" width="250" height="200">
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
                <div>
                <x-jet-label for="name" value="{{ __('Ime i prezime') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Telefon') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Adresa') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="front_ID" value="{{ __('Slika lične karte (prednja strana)') }}" />
                <x-jet-input id="front_ID" class="block mt-1 w-full" type="file" name="front_ID" :value="old('front_ID')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="back_ID" value="{{ __('Slika lične karte (zadnja strana)') }}" />
                <x-jet-input id="back_ID" class="block mt-1 w-full" type="file" name="back_ID" :value="old('back_ID')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Potvrdite password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray900" href="{{ route('login') }}">
                    {{ __('Već imate account?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrujte se') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>

</x-guest-layout>
