{{-- ページネーション --}}
@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="inline-flex -space-x-px text-sm">
            {{-- 前のページ --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span
                        class="flex items-center justify-center px-3 h-8 text-gray-300 border border-e-0 border-gray-300 rounded-s-lg">
                        <<< /span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="flex items-center justify-center px-3 h-8 text-gray-500 border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                        <<< /a>
                </li>
            @endif

            {{-- ページ番号 --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="px-3 h-8 text-gray-500">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span
                                    class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center px-3 h-8 text-gray-500 border border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- 次のページ --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="flex items-center justify-center px-3 h-8 text-gray-500 border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">>></a>
                </li>
            @else
                <li>
                    <span
                        class="flex items-center justify-center px-3 h-8 text-gray-300 border border-gray-300 rounded-e-lg">>></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
