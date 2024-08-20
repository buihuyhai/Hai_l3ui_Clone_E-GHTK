<div class="order-product-card bg-white row col-md-12 mb-10">
    <div class="col-md-12 border-bottom pt-15 pb-10 shop">
        <a href="/shop/{{$order->orderDetails[0]->variant->product->shop->id}}"><p class="name"><span
            class="shop-tag-logo">Shop</span>{{ $order->orderDetails[0]->variant->product->shop->name }}</p></a>
        @if ($order->status == 0)
            <p class="name name-1">Đơn hàng đã huỷ</p>
        @endif
    </div>
    @foreach ($order->orderDetails as $orderDetail)
        <div class="col-md-12 p-0 d-flex border-bottom order-item mt-10 pb-10">
            <div class="col-2">
                <img src="/storage/{{ $orderDetail->variant->product->thumbnail }}" alt="">
            </div>
            <div class="col-10 pr-5 d-flex justify-content-between" style="cursor: pointer">
                <div class="div">
                    <p class="product-name mb-0">{{ $orderDetail->variant->product->name }}</p>
                    <p class="product-variant mb-0">Phân loại hàng: {{ $orderDetail->variant->name }}</p>
                    <p class="text-nowrap">₫<span
                            class="sale-price-value">{{ number_format($orderDetail->variant->price, 0, ',', '.') }}</span>
                    </p>
                </div>
                <div class="review-btn-area d-flex align-items-center">
                    @if ($order->status == 2)
                        @if ($orderDetail->rstatus == 0)
                            <a class="review-now-btn show-review-btn text-white"
                                data-order-detail-id="{{ $orderDetail->id }}"
                                data-variant-id="{{ $orderDetail->variant_id }}"
                                data-slug="{{ $orderDetail->variant->product->slug }}"
                                onclick="showModalReview(this)">Đánh giá</a>
                        @else
                            <a href="/product/{{$orderDetail->variant->product->slug}}" class="review-now-btn text-white">Mua lại</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-md-12 final-price-area d-flex align-items-center justify-content-end mt-15 mb-15 pr-5">
        @if ($order->status == 1)
            <a class="order-action-btn cancel-btn mr-10" onclick="cancelOrder({{ $order->id }})">Huỷ đơn</a>
        @endif
        <p class="mb-0"><span class="text-dark">Thành tiền:</span> <span class="currency-symbol">₫</span><span
                class="final-price">{{ number_format($order->final_cost, 0, ',', '.') }}</span></p>
    </div>
</div>
<script>
    function cancelOrder(order_id) {
        $.ajax({
            url: '{{ route('user.order.cancel') }}',
            method: 'POST',
            data: {
                order_id: order_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Huỷ thành công!')
                console.log(response);
                $('.filter-order.active').trigger('click');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
@push('js')
@endpush
@push('css')
    <style>
        .modal-body .bg-white.review {
            resize: none;
        }

        .modal-body .bg-white.review:focus {
            border-color: #ffd900;
        }

        .br-widget .br-selected::after {
            color: #ffd900 !important;
        }

        .br-widget .br-active::after {
            color: #ffd900 !important;
        }

        .order-product-card .shop {
            display: flex;
            justify-content: space-between;
        }

        .order-action-btn {
            padding: .5rem 1rem;
            border: 1px solid #cecece;
            color: red;
            font-size: 1rem;
            font-weight: 400;
            width: 180px;
            text-align: center;
        }

        .order-action-btn-1 {
            padding: .5rem 2rem;
            border: 1px solid #cecece;
            color: #000;
            background: #fff;
            font-size: 1rem;
            font-weight: 400;
            text-align: center;
        }

        .review-btn-area .review-now-btn {
            padding: .5rem 1rem;
            background: #069155;
            border: 1px solid #069155;
            color: #fff;
            font-size: 1rem;
            font-weight: 400;
            width: 180px;
            cursor: pointer;
            text-align: center;
        }

        .final-price-area .final-price {
            font-size: 1.2rem;
            font-weight: 500;
            color: red;
        }

        .currency-symbol {
            vertical-align: top;
            color: red;
        }

        .order-item img {
            width: 100px;
            aspect-ratio: 1 / 1;
            object-fit: contain;
            border: 1px solid #e0e0e0;
        }

        .order-item .product-name {
            font-size: 1rem;
            color: #000;
        }

        .order-item .sale-price-value {
            font-size: .9rem;
            font-weight: 500;
            color: red;
        }

        .shop .btn-shop {
            padding: .5rem 1rem;
            background: red;
            color: #fff !important;
            font-size: .8rem;
            border-radius: 2px;
            margin: 0;
        }

        .shop .name {
            color: #000;
            font-size: 1rem;
            font-weight: 600;
            padding-right: 1rem;
            margin: 0;
            vertical-align: middle !important;
            display: inline-block;
            line-height: 2rem;
        }

        .shop .name.name-1 {
            color: #7e7e7e;
            font-weight: normal;
            font-size: .9rem;
        }
    </style>
@endpush
