<div class="order-product-card bg-white row col-md-12 mb-10">
    <div class="col-md-12 border-bottom pt-15 pb-10 shop">
        <p class="name"><span class="shop-tag-logo">Shop</span>{{ $order->orderDetails[0]->variant->product->shop->name }}</p>
        @if ($order->status == 0)
            <p class="name name-1">Đơn hàng đã huỷ</p>
        @endif
    </div>
    @foreach ($order->orderDetails as $orderDetail)
        <div class="col-md-12 p-0 d-flex border-bottom order-item mt-10 pb-10">
            <div class="col-2">
                <img src="{{ $orderDetail->variant->product->thumbnail }}" alt="">
            </div>
            <div class="col-10 pr-5 d-flex justify-content-between">
                <div class="div">
                    <p class="product-name mb-0">{{ $orderDetail->variant->product->name }}</p>
                    <p class="product-variant mb-0">Phân loại hàng: {{ $orderDetail->variant->name }}</p>
                    <p class="text-nowrap">₫<span class="sale-price-value">{{ number_format($orderDetail->variant->price, 0, ',', '.') }}</span></p>
                </div>
                <div class="review-btn-area d-flex align-items-center">
                    @if ($order->status == 2)
                        @if ($orderDetail->rstatus == 0)
                            <a class="review-now-btn text-white" data-toggle="modal" data-target="#modalReview" 
                               data-order-detail-id="{{ $orderDetail->id }}" 
                               data-variant-id="{{ $orderDetail->variant_id }}" 
                               data-product-name="{{ $orderDetail->variant->product->name }}">Đánh giá</a>
                        @else
                            <a class="review-now-btn text-white">Mua lại</a>
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
        <p class="mb-0"><span class="text-dark">Thành tiền:</span> <span class="currency-symbol">₫</span><span class="final-price">{{ number_format($order->final_cost, 0, ',', '.') }}</span></p>
    </div>
</div>

<!-- Review Modal -->
<div class="modal" id="modalReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Đánh giá</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="review-form" id="review-form" action="" method="POST">
                @csrf
                <input type="hidden" name="order_detail_id" id="order-detail-id">
                <input type="hidden" name="variant_id" id="variant-id">
                <div class="modal-body">
                    <p class="your-opinion mb-5">
                        <span style="font-size: 1rem; color: #000;">Chất lượng sản phẩm</span>
                        <span>
                            <div class="br-wrapper br-theme-fontawesome-stars">
                                <select class="star-rating" style="display: none;" name="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </span>
                    </p>
                    <p class="mb-5">
                        <span style="font-size: 1rem; color: #000;">Bình luận về sản phẩm</span>
                    </p>
                    <textarea class="bg-white review" name="comment" placeholder="Viết bình luận" rows="6"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="order-action-btn-1" data-dismiss="modal">Huỷ</button>
                    <button type="submit" class="order-action-btn-1 bg-primary text-white">Đánh giá</button>
                </div>
            </form>
        </div>
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
                initializeReviewForms();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    $('#modalReview').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var orderDetailId = button.data('order-detail-id');
        var variantId = button.data('variant-id');
        var productName = button.data('product-name');

        var modal = $(this);
        modal.find('.modal-title').text('Đánh giá ' + productName);
        modal.find('#order-detail-id').val(orderDetailId);
        modal.find('#variant-id').val(variantId);
        modal.find('#review-form').attr('action', '/product/' + variantId + '/review');
    });
</script>

