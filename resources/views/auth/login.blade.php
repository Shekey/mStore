<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <img src="/assets/logo.png" alt="Image logo" width="250" height="200">
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-gray600">
                {{ session('status') }}
            </div>
        @endif
        @if ($message = Session::get('needActivation'))
            <div
                class="bg-orange-600 flash-message w-full absolute left-0 w-full visible"
                style="top: 0;">
                <div class="container mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">
                        <span class="flex p-2 rounded-lg bg-orange-800">
                          <!-- Heroicon name: speakerphone -->
                          <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                          </svg>
                        </span>
                            <p class="ml-3 font-medium text-white truncate"><span class="hidden md:inline">{{ $message }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif



        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray600">{{ __('Ostanite logirani') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Da li ste zaboravili password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Prijavite se') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
