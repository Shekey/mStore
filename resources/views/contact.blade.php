
<x-app-layout>
    <style>
        .ball {
            position: fixed;
            border-radius: 100%;
            opacity: 0.7;
            z-index: 10;
        }

        label,
        input {
            position: relative;
            z-index: 11;
        }
    </style>
    <div class="container mx-auto" style="padding: 60px 0;">
        @if(session('message'))
            <div class="bg-green-200 text-green-dark p-10 text-center" role="alert">
                {{ session('message') }}
            </div>
        @endif
        @if($errors->any())
                <div class="bg-red-200 text-red-dark p-10 text-center" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form class="p-10" method="POST" action="/kontakt" x-data="{ime: '',prezime: '', telefon: '', poruka: '', enabled : false }" x-on:submit="if(ime == '' || prezime == '' || telefon.length <= 9 || poruka.length <= 10) { event.preventDefault(); }">
        <h1 class="text-center md:text-3xl text-xl font-bold mb-10">Kontaktirajte nas</h1>
        {{ csrf_field() }}
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                   Ime
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="ime" type="text" placeholder="Ime" x-model="ime">
                <p class="text-red-500 text-sm" x-show="ime == '' && enabled">Molim vas unesite ime</p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Prezime
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="prezime" type="text" placeholder="Prezime" x-model="prezime">
                <p class="text-red-500 text-sm" x-show="prezime == '' && enabled">Molim vas unesite prezime</p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                    Broj Telefona ili Email Adresa
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="telefon" type="text" placeholder="387******** ili xxx@mail.com" x-model="telefon">
                <p class="text-red-500 text-sm" x-show="telefon < 3 && enabled">Ovaj podatak je obavezan, jer ćemo vas kontaktirati preko ovog podatka.</p>
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Poruka
                </label>
                <textarea rows="10" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="poruka" x-model="poruka">
      </textarea>
                <p class="text-red-500 text-sm mb-4" x-show="poruka.length < 10 && enabled">Poruka mora imati najmanje 10 slova</p>
            </div>
            <div class="flex justify-between w-full px-3" @click="enabled = true;">
                <button class="shadow bg-orange-400 hover:bg-orange-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded"
                        type="submit">
                    Pošalji poruku
                </button>
            </div>

        </div>

    </form>
</div>

</x-app-layout>

