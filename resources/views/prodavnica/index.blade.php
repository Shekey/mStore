<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous"></script>

    <div class="container my-12 mx-auto mt-0 mb-0">
        <div class="flex flex-wrap lg:-mx-4">
            @livewire('catalog-live-wire', ['id' => $id])
        </div>
    </div>
</x-app-layout>
