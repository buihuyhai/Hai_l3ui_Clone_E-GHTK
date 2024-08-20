@extends('Layout::frontend.app')
@section('content')
    <div class="container" style="margin: auto;">
        <div class="breadcrumb-area row pl-0" style="background: transparent;">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="active">Danh mục sản phẩm</li>
                    <li class="active">{{ $category->name }}</li>
                </ul>
            </div>
        </div>
        @include('Product::frontend.components.sort')
        <div class="row bg-white" style="margin-auto" id="product-list">
            @php
                $products = $category->products;
            @endphp
            @include('Product::frontend.components.product.list')
        </div>
        <form id="frmFilter" method="GET">
            <input type="hidden" name="orderby" id="filter-order-by" value="{{ $q_orderby ?? 'latest' }}">
            <input type="hidden" id="filter_min_price" name="minPrice" value="{{ $q_minprice ?? '0' }}">
            <input type="hidden" id="filter_max_price" name="maxPrice" value="{{ $q_maxprice ?? '1000000000' }}">
        </form>
    @endsection
    @push('js')
        <script>
            $(document).ready(function() {
                $('#frmFilter').on('submit', function(event) {
                    event.preventDefault();
                    var data = $(this).serialize();
                    $.ajax({
                        url: '{{ route('category.products', ['slug' => $category->slug]) }}',
                        method: 'GET',
                        data: data,
                        success: function(response) {
                            $('#product-list').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error: ', error);
                        }
                    });
                });
                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    getData(page);
                });
            });

            function getData(page) {
                var data = $('#frmFilter').serialize() + '&page=' + page;
                console.log(data);
                $.ajax({
                    url: '{{ route('category.products', ['slug' => $category->slug]) }}',
                    type: "GET",
                    data: data,
                    success: function(response) {
                        $('#product-list').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error: ', error);
                    }
                });
            }
        </script>
    @endpush
