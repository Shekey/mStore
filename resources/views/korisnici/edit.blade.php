<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('korisnici.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('name', $user->name) }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('email', $user->email) }}" />
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="phone" class="block font-medium text-sm text-gray-700">Telefon</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('phone')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="address" class="block font-medium text-sm text-gray-700">Adresa</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('address')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="idFront" class="block font-medium text-sm text-gray-700">Licna karta(prednja strana)</label>
                            <input type="file" name="idFront" id="idFront" value="{{ old('idFront', $user->front_ID) }}" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('idFront')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="idBack" class="block font-medium text-sm text-gray-700">Licna karta(zadnja strana)</label>
                            <input type="file" name="idBack" id="idBack" value="{{ old('idBack', $user->back_ID) }}" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('idBack')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="roles" class="block font-medium text-sm text-gray-700">Uloge</label>
                            <select name="roles[]" id="roles" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}"{{ in_array($id, old('roles', $user->roles->pluck('id')->toArray())) ? ' selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="isOwner" class="block font-medium text-sm text-gray-700">Primati obavještenja za koju prodavnicu?</label>
                            <select name="isOwner" id="isOwner" class="form-singleselect block rounded-md shadow-sm mt-1 block w-full">
                                <option value="">Niti jednu</option>

                                @foreach($markets as $id => $market)
                                    <option value="{{ $id }}"{{ $id == $user->isOwner ? ' selected' : '' }}>{{ $market }}</option>
                                @endforeach
                            </select>
                            @error('isOwner')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="newAddress" class="block font-medium text-sm text-gray-700 mb-4 inline-block">Nova adresa korisnika</label>
                            <input type="hidden" value="" name="newAddress">
                            @error('newAddress')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @include("partials.map-admin")
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Snimi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('addedMarkers', function (e) {
            const hiddenValue = document.querySelector('input[name=newAddress]');
            if(e.detail !== null) {
                if(hiddenValue) {
                    hiddenValue.value = e.detail.lat + ',' + e.detail.lng;
                }
            } else {
                hiddenValue.value = '';
            }
        });
    </script>
</x-app-layout>
