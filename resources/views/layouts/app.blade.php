<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="/favicon.png"/>
        <title>{{ config('app.name', 'm-store') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Development -->
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
        <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>

{{--        <!-- Production -->--}}
{{--        <script src="https://unpkg.com/@popperjs/core@2"></script>--}}
{{--        <script src="https://unpkg.com/tippy.js@6"></script>--}}
    </head>
    <body class="font-sans antialiased theme-dark">
        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            <header class="bg-white shadow">
                @livewire('navigation-dropdown')
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @auth

            <div class="alert-toast alert-toast-ads fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm hidden">
                <input type="checkbox" class="hidden" id="ads_created">

                <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-green-500 h-24 rounded shadow-lg text-white" title="close" for="ads_created">
                    <svg class="fill-current w-4 h-4 mr-2" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    <p>Dobili ste bodove od</p>
                    <ul>
                        <li>konzum</li>
                        <li>best</li>
                    </ul>
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </label>
            </div>
        @endauth

        @stack('modals')

        @livewireScripts

        <script>
            function cookies() {
                const adsCreated = document.querySelector('.alert-toast-ads');

                const init = () => {
                    const cookieExists = document.cookie.match(/^(.*;)?\s*adsCreated\s*=\s*[^;]+(.*)?$/);

                    if (!cookieExists) {
                        adsCreated.classList.remove('hidden');

                        adsCreated.addEventListener('click', () => {
                            const date = new Date();
                            date.setDate(date.getDate() + 1);
                            document.cookie = `adsCreated=true; expires=${date}; path=/`;
                            adsCreated.classList.add('hidden');
                        });
                    }
                };

                if (adsCreated) {
                    init();
                }
            }

            cookies();
        </script>

    </body>
</html>
