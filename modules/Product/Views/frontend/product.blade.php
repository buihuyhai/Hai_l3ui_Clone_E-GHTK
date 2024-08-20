@extends('Layout::frontend.app')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
@php
    $variants = $product->variants ?? [];
    if (!empty($variants)) {
        foreach ($variants as $key => $variant) {
            if ($variant->stock <= 0) {
                unset($variants[$key]);
            }
        }
    }
@endphp
@section('content')
    <div class="content-wraper">
        <div class="container">
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="active">Sản phẩm</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row single-product-area bg-white pt-15 pb-15" style="margin: auto">
                <div class="col-lg-5 col-md-6" style="position: relative;">
                    <div class="product-details-left">
                        <div class="product-details-images">
                            <div class="lg-image" style="width: 470px;">
                                <img id="product_thumbnail"
                                    style="width: 400px; aspect-ratio: 1 / 1; object-fit: cover;background:#fafafa;"
                                    src="/storage/{{ $product->thumbnail }}" alt="product-image">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content">
                        <div class="product-info">
                            <h1 style="margin-bottom: 0px !important">{{ $product->name }}</h1>
                            <div class="mt-5">
                                <div class="rating-box mb-30">
                                    <span class="rating-number">{{ number_format($product->rating, 1) }} </span>
                                    <div class="stars-outer bigger">
                                        <div class="stars-inner" style="width: {{ ($product->rating / 5) * 100 }}%;">
                                        </div>
                                    </div>
                                    <span> | {{ $product->sold }} <span style="opacity: 0.8;">đã bán</span></span>
                                </div>

                                <div class="mb-20 d-flex align-items-center product-price-area">
                                    <p class="old-price pr-15" id="price">
                                        ₫{{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    <p class="sale-price pr-15">
                                        <span class="d-char">₫</span><span
                                            id="sale_price">{{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                    </p>
                                    <p class="shop-tag-logo text-white">
                                        <span
                                            id="discount-percent">{{ number_format((($product->price - $product->sale_price) / $product->price) * 100, 0) }}</span>%
                                        giảm
                                    </p>
                                </div>

                                <div class="mb-20 product-price-area">
                                    <label class="text-black mb-10 mt-10 font-weight-bold">Mô tả sản phẩm:</label>
                                    <p class="text-black">{{ $product->short_desc }}</p>
                                </div>

                                @if (count($variants) > 0)
                                    <label class="text-black mt-10">Chọn phân loại sản phẩm</label>
                                    <div class="product-sort">
                                        <select id="variantSelect" class="nice-select">
                                            @foreach ($variants as $variant)
                                                <option value="{{ $variant->id }}" data-price="{{ $variant->price }}"
                                                    data-saleprice="{{ $variant->sale_price }}"
                                                    data-stock="{{ $variant->stock }}">
                                                    {{ $variant->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mt-50"> Còn
                                        <span id="stock">{{ $variants->first()->stock }}</span> sản phẩm
                                    </div>
                                @else
                                    <label class="text-black mt-10 font-weight-bold">Hết hàng</label>
                                @endif

                            </div>

                            @if (count($variants) > 0)
                                <div class="mt-20">
                                    <form id="addToCartForm">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <input type="hidden" name="product_variant_id" id="product_variant_id"
                                            value="{{ $variants->first()->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <meta name="is-logged-in" content="{{ Auth::check() }}">
                                        <a class="add-to-cart" style="color: #fff">Thêm vào giỏ hàng</a>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <div class="shop-area row content-bg mt-10 pt-30 pb-20 pl-20 col-12" style="margin: auto">
                <div class="col-md-4 d-flex shop-card">
                    <div class="d-flex">
                        <div class="avatar-container">
                            <div class="avatarE border">
                                <img src="https://cdn.prod.website-files.com/5fb85f26f126ce08d792d2d9/65fddafcf36551945213fe85_After_kime.jpg"
                                    alt="">
                            </div>
                        </div>
                        <div style="margin:auto; margin-left: 0">
                            <h6>{{ $product->shop->name }}</h6>
                            <a class="shop-btn mt-20" href="{{ route('shop.detail', $product->shop->id) }}">
                                <p class="d-inline text-white">Xem shop</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('Product::frontend.components.product.description')
            @include('Product::frontend.components.product.review')
        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        const formatter = new Intl.NumberFormat('en-US', {});

        $('#variantSelect').on('change', function() {
            var selectedVariant = $(this).find(':selected');
            var price = selectedVariant.data('price');
            var salePrice = selectedVariant.data('saleprice');
            var stock = selectedVariant.data('stock');
            var variantId = selectedVariant.val();
            $('#price').text(formatter.format(price).replaceAll(',', '.'));
            $('#sale_price').text(formatter.format(salePrice).replaceAll(',', '.'));
            $('#discount-percent').text(parseInt(100 - (salePrice / price) * 100));
            $('#stock').text(stock);
            $('#product_variant_id').val(variantId);
        });
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            var isLoggedIn = document.querySelector('meta[name="is-logged-in"]').getAttribute('content') === '1';

            if (!isLoggedIn) {
                $('.add-to-cart').on('click', function(e) {
                    e.preventDefault();
                    localStorage.setItem('return_url', window.location.href);
                    window.location.href = "{{ route('login') }}";
                });
            }

            $('#addToCartForm').on('click', function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('add') }}",
                    data: form.serialize(),
                    success: function() {
                        toastr.success('Thêm vào giỏ hàng thành công!');
                        updateCartQuantity();
                    },
                    error: function() {
                        toastr.error('Có lỗi khi thêm sản phẩm vào giỏ hàng!');
                    }
                });
            });
        });
    </script>
@endpush
