 <!-- paginatoin-area start -->
 <div class="paginatoin-area">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if ($product->hasPages())
                <ul class="pagination-box">
                    @if ($product->onFirstPage())
                        <li>
                            <a href="{{ $product->previousPageUrl() }}" >
                               ย้อนกลับ
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ $product->previousPageUrl() }}">
                                ย้อนกลับ
                            </a>
                        <li>
                    @endif

                    @if($product->currentPage() > 4)
                        <li><a href="{{ $product->url(1) }}">1</a></li>
                    @endif
                    
                    @if($product->currentPage() > 5)
                        <li><a href="{{ $product->url(2) }}">2</a></li>
                    @endif

                    @foreach(range(1, $product->lastPage()) as $i)
                        @if($i >= $product->currentPage() - 3 && $i <= $product->currentPage() + 3)
                            @if ($i == $product->currentPage())
                                <li class="active">
                                    <a href="#">{{ $i }}</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $product->url($i) }}">{{ $i }}
                                </a></li>
                            @endif
                        @endif
                    @endforeach

                    @if($product->currentPage() < $product->lastPage() - 3)
                        <li><a href="{{ $product->url($product->lastPage()) }}">{{ $product->lastPage() }}</a></li>
                    @endif
                    @if ($product->hasMorePages())
                        <li><a href="{{ $product->nextPageUrl() }}" rel="next"> ถัดไป </a></li>
                    @else
                        <li><a href="#" > ถัดไป </a></li>
                    @endif
                </ul>
            @endif
        </div>
    </div>
</div>
<!-- paginatoin-area end -->