@if ($paginator->hasPages())
<!--  <nav aria-label="Page navigation example"> -->
<ul class="pagination round-pagination justify-content-center">
    @if ($paginator->onFirstPage())
    <li class="page-item"><a class="page-link" href="javascript:;">{!! __('pagination.previous') !!}</a></li>
    @else
    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">{!! __('pagination.previous') !!}</a></li>
    @endif

    @php
    $currentPage = $paginator->currentPage();
    $lastPage = $paginator->lastPage();
    $start = max(1, $currentPage - 2); // adjust the number to control how many pages to show before current page
    $end = min($lastPage, $currentPage + 2); // adjust the number to control how many pages to show after current page
    @endphp

    @if ($start > 1)
    <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
    @if ($start > 2)
    <li class="page-item disabled"><span class="page-link">...</span></li>
    @endif
    @endif

    @for ($page = $start; $page <= $end; $page++)
        <li class="page-item {{ $page == $currentPage ? 'active' : '' }}"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
        @endfor

        @if ($end < $lastPage)
            @if ($end < $lastPage - 1)
            <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a></li>
            @endif

            @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">{!! __('pagination.next') !!}</a></li>
            @else
            <li class="page-item"><a class="page-link" href="javascript:;">{!! __('pagination.next') !!}</a></li>
            @endif
</ul>
<!-- </nav> -->
@endif