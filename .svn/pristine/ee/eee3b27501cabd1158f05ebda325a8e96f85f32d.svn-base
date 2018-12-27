                <div class="mo-paging">
                @if ($paginator->hasPages())
                        {{-- 首页 --}}
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage()) 
               <a href="javascript:void(0);"class="mo-paging-prev">
               <i class="fa fa-angle-left" title="左三角形"></i> 上一页
               </a>
        @else
               <a href="{{ $paginator->previousPageUrl() }}" class="mo-paging-prev">
               <i class="fa fa-angle-left" title="左三角形"></i> 上一页
               </a> 
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            	<span class="mo-paging-ellipsis">...</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <a href="javascript:;" class="mo-paging-item mo-paging-current">{{ $page }}</a> 
                    @else  
                    <a href="{{ $url }}" class="mo-paging-item">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach                         
        {{-- Next Page Link --}}
        {{-- 末页 --}}
        @if ($paginator->hasMorePages()) 
            <a href="{{$paginator->nextPageUrl()}}" class="mo-paging-next">
                        下一页 <i class="fa fa-angle-right" title="右三角形"></i>
            </a>
        @else 
            <a href="javascript:void(0);" class="mo-paging-next">
                        下一页 <i class="fa fa-angle-right" title="右三角形"></i>
            </a>
        @endif
                    
                    <span class="mo-paging-info"><span class="mo-paging-bold">{{$paginator->currentPage()}}/{{$paginator->lastPage()}}</span>页</span>
                    <form action="" style="display:inline-block;">
                        <span class="mo-paging-which" ><input name="page" value="{{$paginator->currentPage()}}" type="text"></span>
                        <button type="submit" >跳转</button>
                    </form>
                    
@endif
                </div>
                
                 