@extends('Layout::frontend.app')
@php
    $shop = $data['shop'];
    $products = $data['products'];
    $q_orderby = $data['q_orderby'];
    $q_minprice = $data['q_minprice'];
    $q_maxprice = $data['q_maxprice'];
@endphp

@section('content')
    <div class="content-wraper">
        @include('Product::frontend.components.shop.info')
        <div class="container mt-10 ">
            <div class="row m-1">
                <div class="col-md-12">
                    @include('Product::frontend.components.sort')
                    <div class="row shop-product-wrapper" id="product-list">
                        @include('Product::frontend.components.product.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="frmFilter" method="GET">
        <input type="hidden" name="orderby" id="filter-order-by" value="{{ $q_orderby ?? 'latest' }}">
        <input type="hidden" id="filter_min_price" name="minPrice" value="{{ $q_minprice ?? '0' }}">
        <input type="hidden" id="filter_max_price" name="maxPrice" value="{{ $q_maxprice ?? '1000000000' }}">
    </form>
@endsection
@push('js')
    <script>
        $('.header-bottom').addClass('hide-menu');
        $(document).ready(function() {
            $('#frmFilter').on('submit', function(event) {
                event.preventDefault();
                var data = $(this).serialize();
                fetchData(data);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var data = $('#frmFilter').serialize() + '&page=' + page;
                fetchData(data);
            });
        });
        function fetchData(data) {
            $.ajax({
                    url: '{{ route('shop.detail', ['id' => $shop->id]) }}',
                    type: "GET",
                    data: data,
                    success: function(response) {
                        $('#product-list').html(response);
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error: ', error);
                    }
                });
        }
    </script>
@endpush
