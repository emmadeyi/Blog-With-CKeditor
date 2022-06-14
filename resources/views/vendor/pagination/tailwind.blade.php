@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="prev" aria-disabled="true">
                    <a href="#"><i class="fa fa-caret-left"></i> {{ __('Prev') }}</a>
                </li>
            @else
                <li class="prev">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa fa-caret-left"></i> {{ __('Prev') }}</a>
                </li>                
            @endif

            {{-- Pagination Elements --}}
            <li class="disabled" aria-disabled="true"><span> {{ "Page " . $paginator->currentPage() . "  of  " . $paginator->lastPage() }} </span></li>
            {{-- {{ "Page " . $paginator->currentPage() . "  of  " . $paginator->lastPage() }} --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                {{-- @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><a href="#"><span>{{ $element }}</span></a></li>
                @endif --}}

                {{-- Array Of Links --}}
                {{-- @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><a href="#"><span>{{ $page }}</span></a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif --}}
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">{{ __('Next') }} <i class="fa fa-caret-right"></i></a>
                </li>
            @else
                <li class="next" aria-disabled="true">
                    <a href="#"> {{ __('Next')}} >> <i class="fa fa-caret-right"></i></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
