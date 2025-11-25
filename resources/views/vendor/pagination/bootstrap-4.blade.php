@if ($paginator->hasPages())
    <div class="pagination-wrapper">
        <!-- Showing info -->
        <div class="pagination-info">
            Hiển thị <strong>{{ $paginator->lastItem() }}</strong> / <strong>{{ $paginator->total() }}</strong> account
        </div>

        <!-- Pagination links -->
        <ul class="pagination" role="navigation" aria-label="Pagination Navigation">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <span class="page-link">Trang trước <<</span>
                </li>
            @else
                <li>
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Trang trước <<</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page">
                                <span class="page-link">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Trang sau >></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <span class="page-link">Trang sau >></span>
                </li>
            @endif
        </ul>
    </div>
@endif

<style>
    .pagination-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        margin: 30px 0;
    }

    .pagination-info {
        font-size: 13px;
        color: #666;
        text-align: center;
    }

    .pagination-info strong {
        color: #333;
        font-weight: 600;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination li {
        display: inline-block;
        margin: 0;
    }

    .pagination .page-link {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
        background: #fff;
        color: #3366ff;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .pagination .page-link:hover {
        background: #eef2ff;
        border-color: #3366ff;
    }

    .pagination li.active .page-link {
        background: #3366ff;
        color: white;
        border-color: #3366ff;
        font-weight: 600;
    }

    .pagination li.disabled .page-link {
        opacity: 0.4;
        cursor: not-allowed;
        color: #999;
    }

    .pagination li.disabled .page-link:hover {
        background: #fff;
        border-color: #ddd;
    }
</style>
