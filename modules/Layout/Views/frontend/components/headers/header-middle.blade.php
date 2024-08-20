<div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="logo pb-sm-30 pb-xs-30">
                    <a href="/home">
                        <img src="{{ asset('frontend/assets/images/logo/logo.png') }}" style="height: 50px" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                <form id="searchForm" action="{{ route('products.search') }}" class="hm-searchbox" method="GET"
                    onsubmit="submitForm()">
                    <input id='searchKeyword' type="text" name="keyword" placeholder="Bạn cần tìm gì ...">
                    <select id="parent-sort-select" name="orderby" style="display: none">
                        <option value="latest" selected>Mới nhất</option>
                        <option value="price-asc">Giá (Thấp &gt; Cao)</option>
                        <option value="price-desc">Giá (Cao &gt; Thấp)</option>
                        <option value="rating">Đánh giá</option>
                        <option value="selling">Bán chạy</option>
                    </select>
                    <button class="li-btn border" type="submit"><i class="fa fa-search"></i></button>
                </form>
                @php
                    $qty = 0;
                    if (Auth::check()) {
                        $user_id = Auth::id();
                        $cart = Modules\Cart\Models\Cart::with(['products'])
                            ->where('user_id', $user_id)
                            ->first();
                        $qty = $cart ? $cart->products->sum('pivot.quantity') : 0;
                    }
                @endphp
                @if (Auth::check() && isset($cart))
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <li class="hm-minicart">
                                <a class="cart-area" href="{{ route('cart') }}"
                                    style="background-color:red; display: flex; align-items: center; padding: 10px; position: relative; border: none; cursor: pointer;">
                                    <span
                                        class="cart-item-count wishlist-item-count">{{ $qty > 99 ? '99+' : $qty }}</span>
                                    <span class="item" style="margin-right: 10px;">
                                        <i class="fa fa-shopping-cart" style="color: #fff; font-size: 20px;"></i>
                                    </span>
                                    <span class="" style="color: #fff; font-weight: bold; margin-right: 10px;">Giỏ
                                        Hàng</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const myParam = urlParams.get('keyword');
            $('#searchKeyword').val(myParam);
            const orderby = urlParams.get('orderby');
            $('#sort-select').val(orderby);
            $('#parent-sort-select').val(orderby);
        });

        function updateCartQuantity() {
            $.ajax({
                url: '{{ route('cart.quantity') }}',
                method: 'GET',
                success: function(response) {
                    const qty = response.qty > 99 ? '99+' : response.qty;
                    $('.cart-item-count').text(qty);
                },
                error: function() {
                    console.error("Có lỗi xảy ra khi cập nhật số lượng giỏ hàng");
                }
            });
        }
    </script>
@endpush
