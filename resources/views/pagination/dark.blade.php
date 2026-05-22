@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="tw-flex tw-items-center tw-justify-between">

    {{-- Mobile: prev/next only --}}
    <div class="tw-flex tw-justify-between tw-flex-1 sm:tw-hidden">
        @if ($paginator->onFirstPage())
            <span class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-500 tw-bg-gray-800 tw-border tw-border-gray-700 tw-cursor-default tw-rounded-lg">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" onclick="if (typeof loadContent === 'function') { loadContent(event, this.href); }" class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-300 tw-bg-gray-800 tw-border tw-border-gray-700 tw-rounded-lg hover:tw-bg-gray-700 tw-transition-colors">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" onclick="if (typeof loadContent === 'function') { loadContent(event, this.href); }" class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-ml-3 tw-text-sm tw-font-medium tw-text-gray-300 tw-bg-gray-800 tw-border tw-border-gray-700 tw-rounded-lg hover:tw-bg-gray-700 tw-transition-colors">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-ml-3 tw-text-sm tw-font-medium tw-text-gray-500 tw-bg-gray-800 tw-border tw-border-gray-700 tw-cursor-default tw-rounded-lg">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </div>

    {{-- Desktop --}}
    <div class="tw-hidden sm:tw-flex-1 sm:tw-flex sm:tw-items-center sm:tw-justify-between">
        {{-- Result count --}}
        <div>
            <p class="tw-text-sm tw-text-gray-400">
                @if ($paginator->firstItem())
                    Showing
                    <span class="tw-font-semibold tw-text-white">{{ $paginator->firstItem() }}</span>
                    –
                    <span class="tw-font-semibold tw-text-white">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="tw-font-semibold tw-text-white">{{ $paginator->total() }}</span>
                    results
                @else
                    {{ $paginator->count() }} results
                @endif
            </p>
        </div>

        {{-- Page buttons --}}
        <div>
            <span class="tw-relative tw-z-0 tw-inline-flex tw-rounded-md tw-gap-1">

                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="tw-relative tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-600 tw-bg-gray-800 tw-border tw-border-gray-700 tw-cursor-default tw-rounded-lg" aria-disabled="true">
                        <i class="fas fa-chevron-left tw-text-xs"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" onclick="if (typeof loadContent === 'function') { loadContent(event, this.href); }" class="tw-relative tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-300 tw-bg-gray-800 tw-border tw-border-gray-700 tw-rounded-lg hover:tw-bg-gray-700 tw-transition-colors">
                        <i class="fas fa-chevron-left tw-text-xs"></i>
                    </a>
                @endif

                {{-- Page numbers --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="tw-relative tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-500 tw-bg-gray-800 tw-border tw-border-gray-700 tw-cursor-default tw-rounded-lg">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="tw-relative tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-text-sm tw-font-semibold tw-text-gray-900 tw-bg-[#24CFF4] tw-border tw-border-[#24CFF4] tw-cursor-default tw-rounded-lg">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" onclick="if (typeof loadContent === 'function') { loadContent(event, this.href); }" class="tw-relative tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-300 tw-bg-gray-800 tw-border tw-border-gray-700 tw-rounded-lg hover:tw-bg-gray-700 tw-transition-colors">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" onclick="if (typeof loadContent === 'function') { loadContent(event, this.href); }" class="tw-relative tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-300 tw-bg-gray-800 tw-border tw-border-gray-700 tw-rounded-lg hover:tw-bg-gray-700 tw-transition-colors">
                        <i class="fas fa-chevron-right tw-text-xs"></i>
                    </a>
                @else
                    <span class="tw-relative tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-600 tw-bg-gray-800 tw-border tw-border-gray-700 tw-cursor-default tw-rounded-lg" aria-disabled="true">
                        <i class="fas fa-chevron-right tw-text-xs"></i>
                    </span>
                @endif

            </span>
        </div>
    </div>

</nav>
@endif
