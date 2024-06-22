@if ($paginator->hasPages())
    <div class="row tm-row tm-mt-40 tm-mb-75">
        <div class="tm-prev-next-wrapper">
            {{-- Page Précédente --}}
            @if ($paginator->onFirstPage())
                <a aria-disabled="true" rel="prev" aria-label="@lang('pagination.previous')"
                   class="mb-2 tm-btn tm-btn-primary tm-prev-next disabled tm-mr-20">Préc</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="mb-2 tm-btn tm-btn-primary tm-prev-next tm-mr-20" rel="prev"
                   aria-label="@lang('pagination.previous')">Préc</a>
            @endif

            {{-- Page Suivante --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   aria-label="@lang('pagination.next')" class="mb-2 tm-btn tm-btn-primary tm-prev-next">Suiv</a>
            @else
                <a aria-disabled="true" aria-label="@lang('pagination.next')"
                   class="mb-2 tm-btn tm-btn-primary tm-prev-next disabled">Suiv</a>
            @endif
        </div>

        {{-- Pagination Numérique --}}
        <div class="tm-paging-wrapper">
            <span class="d-inline-block mr-3">Page</span>
            <nav class="tm-paging-nav d-inline-block">
                <ul class="pagination">
                    @foreach ($elements as $element)
                        {{-- Array de Liens --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="tm-paging-item active" aria-current="page">
                                        <span class="mb-2 tm-btn tm-paging-link page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="tm-paging-item page-item">
                                        <a class="mb-2 tm-btn tm-paging-link page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
@endif
