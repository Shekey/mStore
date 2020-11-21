<div class="w-full">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.js"></script>

    <div class="relative">
        <div wire:model="isOpen" wire:loading.attr="disabled"
             class="bg-indigo-600 w-full absolute left-0 w-full @if ($isOpen) visible @else invisible @endif"
             style="top: -64px;">
            <div class="container mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
        <span class="flex p-2 rounded-lg bg-indigo-800">
          <!-- Heroicon name: speakerphone -->
          <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
          </svg>
        </span>
                        <p class="ml-3 font-medium text-white truncate">

                            <span class="hidden md:inline">
           {{ $messageText }}
          </span>
                        </p>
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                        <button type="button" wire:click="$set('isOpen', false)"
                                class="-mr-1 flex p-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                            <span class="sr-only">Dismiss</span>
                            <!-- Heroicon name: x -->
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div wire:model="isOpen" wire:loading.attr="disabled">
    </div>
    <div class="container my-12 mx-auto">
        <div class="flex flex-wrap py-3 px-3 sm:px-6 lg:px-8">
            <x-jet-button wire:click="createShowModal">
                {{ __('Kreiraj artikal') }}
            </x-jet-button>
            <div class="flex flex-col w-full mt-5">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-800">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                     src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                                     alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                        <div class="text-sm text-gray-500">Optimization</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Active
                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Admin
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                     src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                                     alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                        <div class="text-sm text-gray-500">Optimization</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Active
                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Admin
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                     src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                                     alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                        <div class="text-sm text-gray-500">Optimization</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Active
                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Admin
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                     src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                                     alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                        <div class="text-sm text-gray-500">Optimization</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Active
                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Admin
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>

                                <!-- More rows... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($dropzone as $link)
                {{ $link }}
            @endforeach
            {{ $data->links() }}

            <x-jet-dialog-modal wire:model="displayingToken" :maxWidth="'modal-full'">
                <x-slot name="title">
                    @if($artikalId)
                        {{ __('Uredi artikal') }}
                    @else
                        {{ __('Dodaj artikal') }}
                    @endif
                </x-slot>

                <x-slot name="content">

                    <x-jet-label for="name" value="{{ __('Slike') }}"/>
                    <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data"
                          class="dropzone" id="dropzone">
                        @csrf
                    </form>

                    <form wire:submit.prevent="submit" enctype="multipart/form-data" id="addArticle">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="mt-4">
                                <x-jet-label for="name" value="{{ __('Naziv artikla') }}"/>
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                             :value="old('name')"
                                             wire:model.debounce.800ms="name"/>
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="brand" value="{{ __('Brand') }}"/>
                                <x-jet-input id="brand" class="block mt-1 w-full" type="text" name="brand"
                                             :value="old('brand')"
                                             wire:model.debounce.800ms="brand"/>
                                @error('brand') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="price" value="{{ __('Cijena') }}"/>
                                <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price"
                                             :value="old('price')"
                                             wire:model.debounce.800ms="price"/>
                                @error('price') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-2 col-span-2">
                                <x-jet-label for="desc" value="{{ __('Opis') }}"/>
                                <textarea class="form-textarea mt-1 block w-full" rows="3" name="desc"
                                          placeholder="Unesite opis ovdje."></textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="mt-4">
                                <x-jet-label for="size" value="{{ __('Veličina') }}"/>
                                <x-jet-input id="size" class="block mt-1 w-full" type="text" name="size"
                                             :value="old('size')"
                                             wire:model.debounce.800ms="size"/>
                                @error('size') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="color" value="{{ __('Boja') }}"/>
                                <x-jet-input id="color" class="block mt-1 w-full" type="text" name="color"
                                             :value="old('color')"
                                             wire:model.debounce.800ms="color"/>
                                @error('color') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="categoryId" value="{{ __('Kategorija') }}"/>
                                <select id="categoryId" name="categoryId"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                </select>
                                @error('categoryId') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="isActive" value="{{ __('Aktivan') }}"/>
                                <select id="isActive" name="isActive"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                </select>
                                @error('isActive') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="isOnSale" value="{{ __('Snizenje') }}"/>
                                <select id="isOnSale" name="isOnSale"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                </select>
                                @error('isOnSale') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>


                    </form>
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                        {{ __('Zatvori') }}
                    </x-jet-secondary-button>

                    @if($artikalId)
                        <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
                            {{ __('Uredi artikal') }}
                        </x-jet-danger-button>
                    @else
                        <x-jet-danger-button wire:click="create" wire:loading.attr="disabled">
                            {{ __('Snimi artikal') }}
                        </x-jet-danger-button>
                    @endif
                </x-slot>
            </x-jet-dialog-modal>

            <!-- Delete User Confirmation Modal -->
            <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
                <x-slot name="title">
                    {{ __('Izbriši Artikal') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Jeste li sigurni da želite izbrisati artikal? Nakon što se artikal izbriše, svi resursi i podaci trajno će se izbrisati.') }}
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')"
                                            wire:loading.attr="disabled">
                        {{ __('Zatvori') }}
                    </x-jet-secondary-button>
                </x-slot>
            </x-jet-dialog-modal>
        </div>
    </div>

    <script type="text/javascript">
        let counter = 0;

        function createHidden(value) {
            var input = document.createElement("input");

            input.setAttribute("type", "hidden");
            input.setAttribute("name", counter + "-image");
            input.setAttribute("value", value);
            input.classList.add('image-hidden');
            document.getElementById("addArticle").appendChild(input);
        }

        Dropzone.autoDiscover = false;
        new Dropzone("#dropzone",
            {
                maxFiles: 20,
                maxFilesize: 1000, // MB
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                init: function() {
                    let myDropzone = this;

                    @if (count($images))
                    let mockFile = null;
                    let callback = null; // Optional callback when it's done
                    let crossOrigin = null; // Added to the `img` tag for crossOrigin handling
                    let resizeThumbnail = false; // Tells Dropzone whether it should resize the image first
                    @foreach($images as $image)
                        mockFile = {name: "{{ $image }}", size: 1234};
                        myDropzone.displayExistingFile(mockFile, "/storage/images/articles/{{ $image }}", callback, crossOrigin, resizeThumbnail);
                    @endforeach


                        // If you use the maxFiles option, make sure you adjust it to the
                        // correct amount:
                        let fileCountOnServer = {{ count($images) }}; // The number of files already uploaded
                        myDropzone.options.maxFiles = myDropzone.options.maxFiles - fileCountOnServer;
                    @endif
                },

                removedfile: function (file) {
                    var name = file.upload === undefined ? file.name : file.upload.filename;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        },
                        type: 'POST',
                        url: '{{ url("image/delete") }}',
                        data: {filename: name},
                        success: function (data) {
                            console.log("File has been successfully removed!!");
                            console.log(data);
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                success: function (file, response) {
                    console.log(response);
                },
                error: function (file, response) {
                    return false;
                }
            }
        );

    </script>

</div>
