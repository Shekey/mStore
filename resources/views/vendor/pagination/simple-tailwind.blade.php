@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 mr-2 text-sm font-medium text-black bg-orange-500 border border-black cursor-default leading-5 rounded-md">
                {!! __('Prethodna strana') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center mr-2 px-4 py-2 text-sm font-medium text-black bg-orange-500 border border-black leading-5 rounded-md hover:text-gray-800 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                {!! __('Prethodna strana') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex ml-2 items-center px-4 py-2 text-sm font-medium text-black bg-orange-500 border border-black leading-5 rounded-md hover:text-gray-800 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                {!! __('Sljedeća strana') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium ml-2 text-black bg-orange-500 border border-black cursor-default leading-5 rounded-md">
                {!! __('Sljedeća strana') !!}
            </span>
        @endif
    </nav>
@endif
