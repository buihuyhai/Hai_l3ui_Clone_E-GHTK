<div class="bg-white p-0 product-card pb-10">
    <a href="{{ url('product/' . $product->slug) }}">
        <div class="col-md-12 p-0">
            <img class="product-img" src="/storage/{{ $product->thumbnail }}" alt="{{ $product->name }} thumbnail">
            <div class="m-1 p-1">
                <p class="product-name text-truncate mb-0" data-toggle="tooltip" title="{{$product->name}}" data-placement="right">{{ $product->name }}</p>
                <div class="d-flex flex-nowrap product-price-info">
                    <p class="text-nowrap">₫<span
                            class="sale-price-value">{{ number_format($product->sale_price, 0, ',', '.') }}</span></p>
                    <p class="text-truncate">&nbsp;-&nbsp;<span
                            class="old-price">{{ number_format($product->price, 0, ',', '.') }}</span></p>
                    <p><span class="discount text-nowrap" style="color:#a2a8b8;">
                            -{{ number_format((($product->price - $product->sale_price) / $product->price) * 100, 0) }}%
                        </span></p>
                </div>
                <div class="rating-info">
                    <div class="stars-outer">
                        <div class="stars-inner" style="width: {{ ($product->rating / 5) * 100 }}%;"></div>
                    </div>
                    <span style="font-size: .7rem; color:#a2a8b8;">Đã bán {{ $product->sold }}</span>
                </div>
            </div>
        </div>
    </a>
</div>
@push('js')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
