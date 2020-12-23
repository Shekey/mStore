<div>
    <div class="mb-10 lg:w-1/2 w-full mx-auto">
        <div class="search__container">
            <input class="search__input" type="text" wire:model.lazy="search"
                   wire:keydown.enter="searchUser($event.target.value)"
                   placeholder="Pretražite korisnike (enter)">
        </div>
    </div>
    <div class="px-3 sm:px-6 lg:px-8 flex justify-center items-center">
        <div class="relative inline-block text-left">
            <button
                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-black text-sm font-medium text-white hover:bg-white-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                wire:click="resetFilters">
                Resetuj filtere
            </button>
        </div>
        <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false"
             class="relative inline-block text-left ml-2">
            <div>
                <button @click="open = !open" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                        id="options-menu" aria-haspopup="true" aria-expanded="true" x-bind:aria-expanded="open">
                    Filtriraj artikle
                    <svg class="-mr-1 ml-2 h-5 w-5" x-description="Heroicon name: chevron-down"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div x-show="open" x-description="Dropdown panel, show/hide based on dropdown state."
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <a wire:click="$set('filter', '')" @click="open = !open" role="button"
                       class="block px-4 py-2 text-sm text-gray-400 {{ $filter === '' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900"
                       role="menuitem">Prikaži sve korisnike</a>
                    <a wire:click="$set('filter', 'active')" @click="open = !open" role="button"
                       class="block px-4 py-2 text-sm text-gray-400 {{ $filter === 'active' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900"
                       role="menuitem">Aktivni korisnici</a>
                    <a wire:click="$set('filter', 'inactive')" @click="open = !open" role="button"
                       class="block px-4 py-2 text-sm text-gray-400 {{ $filter === 'inactive' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900"
                       role="menuitem">Neaktivni korisnici</a>
                </div>
            </div>
        </div>

        <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false"
             class="relative inline-block text-left ml-2">
            <div>
                <button @click="open = !open" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                        id="options-menu" aria-haspopup="true" aria-expanded="true" x-bind:aria-expanded="open">
                    Sortiraj korisnike
                    <svg class="-mr-1 ml-2 h-5 w-5" x-description="Heroicon name: chevron-down"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div x-show="open" x-description="Dropdown panel, show/hide based on dropdown state."
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <a wire:click="$set('sort', '')" @click="open = !open" role="button"
                       class="block px-4 py-2 text-sm text-gray-400 {{ $sort === '' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900"
                       role="menuitem">Zadnji registrovani</a>
                    <a wire:click="$set('sort', 'asc')" @click="open = !open" role="button"
                       class="block px-4 py-2 text-sm text-gray-400 {{ $sort === 'asc' ? 'text-gray-700' : '' }} hover:bg-gray-100 hover:text-gray-900"
                       role="menuitem">Prvi registrovani</a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col mt-5">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 w-full">
                        <thead>
                        <tr>
                            <th scope="col" width="50"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ime i prezime
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Telefon
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Adresa
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Uloge
                            </th>
                            <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->id }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->phone }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->address }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $role->title }}
                                                </span>
                                    @endforeach
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('korisnici.show', $user->id) }}"
                                       class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Pregled</a>
                                    <a href="{{ route('korisnici.edit', $user->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Uredi</a>
                                    <form class="inline-block" action="{{ route('korisnici.destroy', $user->id) }}"
                                          method="POST" onsubmit="return confirm('Da li ste sigurni?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                               value="Obriši">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $users->links() }}
    </div>
</div>
