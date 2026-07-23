<nav class="flex items-center gap-1">
    @if($paginator->onFirstPage())
        <span class="px-3 py-1.5 text-sm text-slate-300 cursor-not-allowed">Previous</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 text-sm text-slate-600 hover:bg-[#F8FAFC] rounded-lg transition">Previous</a>
    @endif

    @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
        @if($page == $paginator->currentPage())
            <span class="w-9 h-9 flex items-center justify-center text-sm font-medium bg-[#2563EB] text-white rounded-lg">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center text-sm text-slate-600 hover:bg-[#F8FAFC] rounded-lg transition">{{ $page }}</a>
        @endif
    @endforeach

    @if($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm text-slate-600 hover:bg-[#F8FAFC] rounded-lg transition">Next</a>
    @else
        <span class="px-3 py-1.5 text-sm text-slate-300 cursor-not-allowed">Next</span>
    @endif
</nav>
