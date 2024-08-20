@extends('Layout::frontend.app')
@section('content')
    <div class="container">
        <div class="div pl-15 mt-10">
            @include('Product::frontend.components.sort')
        </div>
        <div class="bg-white category-list mt-0">
            <div class="row shop-product-wrapper category-list mt-0" id="product-list">
                @include('Product::frontend.components.product.list')
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
        $(document).ready(function() {
            $('#frmFilter').on('submit', function(event) {
                event.preventDefault();
                var data = 'keyword=' + $('#searchKeyword').val() + '&' + $('#frmFilter').serialize();
                console.log(data);
                $.ajax({
                    url: '/search',
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
        });
        $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var data = 'keyword=' + $('#searchKeyword').val() + '&' + $('#frmFilter').serialize() + '&page=' + page;;
                console.log(data);
                $.ajax({
                    url: '/search',
                    type: "GET",
                    data: data,
                    success: function(response) {
                        $('#product-list').html(response);
                        $('#scrollUp').trigger('click');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error: ', error);
                    }
                });
            });
    </script>
@endpush
