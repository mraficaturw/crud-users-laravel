
@if ($paginator->hasPages())
    <div class="flex items-center justify-between mt-4">
        {{-- Mobile View --}}
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-body bg-neutral-secondary-medium border border-default-medium cursor-default leading-5 rounded-md">
                    Previous
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-heading bg-white border border-default-medium leading-5 rounded-md hover:text-brand hover:bg-neutral-secondary-medium focus:outline-none focus:ring ring-brand-soft active:bg-neutral-tertiary-medium transition ease-in-out duration-150">
                    Previous
                </button>
            @endif

            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-heading bg-white border border-default-medium leading-5 rounded-md hover:text-brand hover:bg-neutral-secondary-medium focus:outline-none focus:ring ring-brand-soft active:bg-neutral-tertiary-medium transition ease-in-out duration-150">
                    Next
                </button>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-body bg-neutral-secondary-medium border border-default-medium cursor-default leading-5 rounded-md">
                    Next
                </span>
            @endif
        </div>

        {{-- Desktop View --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-body leading-5 my-2 px-4">
                    Showing
                    <span class="font-medium text-heading">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-medium text-heading">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="font-medium text-heading">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-body bg-white border border-default-medium cursor-default rounded-l-md leading-5" aria-hidden="true">
                                Previous
                            </span>
                        </span>
                    @else
                        <button wire:click="previousPage" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-body bg-white border border-default-medium rounded-l-md leading-5 hover:text-heading hover:bg-neutral-secondary-medium hover:cursor-pointer focus:z-10 focus:outline-none focus:ring ring-brand-soft active:bg-neutral-tertiary-medium transition ease-in-out duration-150" aria-label="@lang('pagination.previous')">
                            Previous
                        </button>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-body bg-white border border-default-medium cursor-default leading-5 hover:cursor-pointer">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-brand bg-brand-soft border border-default-medium cursor-default leading-5 z-10">{{ $page }}</span>
                                    </span>
                                @else
                                    <button wire:click="gotoPage({{ $page }})" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-body bg-white border border-default-medium leading-5 hover:text-heading hover:bg-neutral-secondary-medium focus:z-10 focus:outline-none focus:ring ring-brand-soft active:bg-neutral-tertiary-medium transition ease-in-out duration-150 hover:cursor-pointer" aria-label="@lang('pagination.goto_page', ['page' => $page])">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage" rel="next" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-body bg-white border border-default-medium rounded-r-md leading-5 hover:text-heading hover:bg-neutral-secondary-medium hover:cursor-pointer focus:z-10 focus:outline-none focus:ring ring-brand-soft active:bg-neutral-tertiary-medium transition ease-in-out duration-150" aria-label="@lang('pagination.next')">
                            Next
                        </button>
                    @else
                        <span aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-body bg-white border border-default-medium cursor-default rounded-r-md leading-5" aria-hidden="true">
                                Next
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </div>
@endif
