@extends('Layout::frontend.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="breadcrumb-area container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ul>
        </div>
    </div>
    @if (Auth::check() && $cart)
        <div class="Shopping-cart-area pt-10 pb-10">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if ($cart && !$cart->products->isEmpty())
                            <form action="#">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all"></th>
                                                <th class="li-product-thumbnail">Ảnh</th>
                                                <th class="cart-product-name">Tên sản phẩm</th>
                                                <th class="cart-product-name">Phân loại hàng</th>
                                                <th class="li-product-price">Giá</th>
                                                <th class="li-product-quantity">Số lượng</th>
                                                <th class="li-product-subtotal">Tổng</th>
                                                <th class="li-product-remove">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productsByShop as $shopId => $products)
                                                @php
                                                    $shop = $products->first()->product->shop;
                                                @endphp
                                                <tr>
                                                    <td colspan="8">
                                                        <span class="shop-tag-logo">Shop</span><a
                                                            href="/shop/{{ $shop->id }}"
                                                            class="shop-tag-name">{{ $shop->name }}</a>
                                                    </td>
                                                </tr>
                                                @foreach ($products as $product)
                                                    <tr class="cart-item"
                                                        data-product-variant-id="{{ $product->pivot->product_variant_id }}"
                                                        data-stock="{{ $product->stock }}">
                                                        <td><input type="checkbox" class="select-item"></td>

                                                        <td class="li-product-thumbnail">
                                                            <a href="#"><img class="product-img"
                                                                    src="storage/{{ $product->product->thumbnail }}"
                                                                    alt="Product Image"></a>
                                                        </td>
                                                        <td class="li-product-name"><a
                                                                href="/product/{{ $product->product->slug }}">{{ $product->product->name }}</a>
                                                        </td>
                                                        <td class="li-product-name"><a
                                                                href="#">{{ $product->name }}</a></td>
                                                        <td class="li-product-price"><span
                                                                class="amount">{{ number_format($product->sale_price) }}₫</span>
                                                        </td>
                                                        <td class="quantity">
                                                            <div class="cart-plus-minus"
                                                                data-price="{{ $product->sale_price }}">
                                                                <input class="cart-plus-minus-box"
                                                                    value="{{ $product->pivot->quantity }}" type="text">
                                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i>
                                                                </div>
                                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="product-subtotal"><span
                                                                class="amount">{{ number_format($product->sale_price * $product->pivot->quantity) }}₫</span>
                                                        </td>
                                                        <td class="li-product-remove">
                                                            <button class="remove-item" type="button"
                                                                data-product-id="{{ $product->id }}"
                                                                style="border: none; background: none;">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total">
                                            <ul>
                                                <li>Tổng tiền: <span id="cart-total"></span></li>
                                            </ul>
                                            <button type="button" class="btn-buy-cart" id="checkout-button">
                                                Mua hàng
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p style="text-align: center">Giỏ hàng của bạn trống.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script src="{{ asset('frontend/assets/vendor/js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/sweetalert2.min.css') }}">
    <script>
        $(document).ready(function() {

            function formatCurrency(value) {
                return value.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).replace('₫', '₫');
            }

            function updateSubtotal(quantity, price, $subtotal) {
                let newSubtotal = quantity * price;
                $subtotal.text(formatCurrency(newSubtotal));
                updateSelectedTotal();
            }

            function updateSelectedTotal() {
                let selectedTotal = 0;
                $('.select-item:checked').each(function() {
                    let $row = $(this).closest('tr');
                    let subtotal = parseInt($row.find('.product-subtotal .amount').text().replace(/[^\d]/g,
                        ''));
                    selectedTotal += subtotal;
                });
                $('#cart-total').text(formatCurrency(selectedTotal));
            }
            if ($('.select-item').length === 1) {
                $('.select-item').prop('checked', true);
                $('#select-all').prop('checked', true);
                updateSelectedTotal();
            }
            function removeCartItem(product_variant_id) {
                $.ajax({
                    url: '{{ route('delete') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_variant_id: product_variant_id
                    },
                    success: function(response) {
                        if (response.success) {
                            $('tr[data-product-variant-id="' + product_variant_id + '"]').remove();
                            updateSelectedTotal();
                            window.location.reload();
                        } else {
                            console.error('Có lỗi khi xóa sản phẩm khỏi giỏ hàng!');
                        }
                    },
                    error: function(xhr) {
                        console.error('Có lỗi khi xóa sản phẩm khỏi giỏ hàng!');
                    }
                });
            }

            $('.cart-plus-minus').each(function() {
                let $cartItem = $(this);
                let $input = $cartItem.find('.cart-plus-minus-box');
                let $decButton = $cartItem.find('.dec');
                let $incButton = $cartItem.find('.inc');
                let price = parseInt($cartItem.data('price'));
                let $subtotal = $cartItem.closest('tr').find('.product-subtotal .amount');
                let stock = parseInt($cartItem.closest('tr').data('stock'));
                let previousValue = parseInt($input.val());

                $decButton.on('click', function() {
                    let quantity = parseInt($input.val());
                    if (quantity >= 0) {
                        if (quantity > stock) {
                            $input.val(previousValue);
                        } else {
                            $input.val(quantity);
                            updateSubtotal(quantity, price, $subtotal);
                            previousValue = quantity;
                        }
                    } else {
                        $input.val(previousValue);
                    }
                });

                $incButton.on('click', function() {
                    let quantity = parseInt($input.val());
                    if (quantity > stock) {
                        $input.val(previousValue);
                    } else {
                        $input.val(quantity);
                        updateSubtotal(quantity, price, $subtotal);
                        previousValue = quantity;
                    }
                });

                $input.on('blur', function() {
                    let quantity = parseInt($input.val());
                    if (isNaN(quantity) || quantity < 0) {
                        quantity = previousValue;
                    }
                    if (quantity > stock) {
                        $input.val(previousValue);
                    } else {
                        $input.val(quantity);
                        updateSubtotal(quantity, price, $subtotal);
                        previousValue = quantity;
                    }
                });
            });

            $('#select-all').on('click', function() {
                $('.select-item').prop('checked', this.checked);
                updateSelectedTotal();
            });

            $('.select-item').on('click', function() {
                if ($('.select-item:checked').length == $('.select-item').length) {
                    $('#select-all').prop('checked', true);
                } else {
                    $('#select-all').prop('checked', false);
                }
                updateSelectedTotal();
            });

            $('.remove-item').on('click', function() {
                let product_variant_id = $(this).closest('tr').data('product-variant-id');
                removeCartItem(product_variant_id);
                updateCartQuantity()
            });
            updateSelectedTotal();

            $('#checkout-button').on('click', function() {
                const selectedItems = [];
                $('.select-item:checked').each(function() {
                    const $row = $(this).closest('tr');
                    const productVariantId = $row.data('product-variant-id');
                    const quantity = parseInt($row.find('.cart-plus-minus-box').val(), 10);

                    if (quantity > 0) {
                        selectedItems.push({
                            product_variant_id: productVariantId,
                            quantity: quantity
                        });
                    }
                });

                if (selectedItems.length === 0) {
                    Swal.fire({
                        text: "Bạn chưa chọn sản phẩm nào",
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1300,
                        timerProgressBar: true,
                    })
                    return;
                }

                const userId = {{ $cart->user_id }};
                $.ajax({
                    url: '{{ route('checkout.process') }}',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        user_id: userId,
                        items: selectedItems
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.checkout_url;
                        } else {
                            alert('Có lỗi xảy ra khi xử lý đơn hàng: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra khi xử lý: ' + xhr.responseText);
                    }
                });
            });

        });
    </script>
@endpush
