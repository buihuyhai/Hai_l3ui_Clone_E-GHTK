@extends('Layout::frontend.app')

@section('content')
    <div class="modal fade" id="myModal" role="dialog">
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
    <div class="container">
        <div class="row mt-10 row">
            <div class="col-md-3">
                <div class="d-flex user-order-card mt-5 border-bottom pb-15 mb-10">
                    <img src="{{ auth()->user()->avatar }}" alt="">
                    <div class="d-flex flex-column pl-10">
                        <p class="login-user-name text-truncate">{{ auth()->user()->name }}</p>
                        <a href=""><span class="fa fa-pencil"></span> Sửa hồ sơ</a>
                    </div>
                </div>
                <div class="user-order-card-option pl-10">
                    <div class="d-flex flex-column pl-10">
                        <a href="/profile" class="text-dark mb-10"><span class="fa fa-user-circle-o"></span>&emsp;Tài khoản
                            của tôi</a>
                        <a href="/home" class="text-dark mb-10"><span class="fa fa-gift"></span>&emsp;Kho voucher</a>
                        <a href="/order/list" style="color: #fe0909;;" class="mb-10"><span
                                class="fa fa-shopping-cart"></span>&emsp;Đơn mua</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <nav class="navbar navbar-expand-lg col-md-12 row ">
                    <div class="collapse navbar-collapse row col-md-12 bg-white" id="navbarNavAltMarkup">
                        <div class="navbar-nav col-12 row">
                            <a class="nav-item filter-order nav-link col-md-3 active" data-type="all">Tất cả</a>
                            <a class="nav-item filter-order nav-link col-md-3" data-type="pending">Chờ xác nhận</a>
                            <a class="nav-item filter-order nav-link col-md-3" data-type="success">Thành công</a>
                            <a class="nav-item filter-order nav-link col-md-3" data-type="cancel">Đã huỷ</a>
                        </div>
                    </div>
                </nav>
                <div class="col-md-12 row order-list" id="order-list-container">
                    @include('Product::frontend.components.order.list')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function showModalReview(element) {
            var button = $(element);
            var orderDetailId = button.data('order-detail-id');
            var variantId = button.data('variant-id');
            var productSlug = button.data('slug');
            var modal = $('#myModal');
            modal.find('#order-detail-id').val(orderDetailId);
            modal.find('#variant-id').val(variantId);
            modal.find('#review-form').attr('action', '/product/' + productSlug + '/review');
            $('#myModal').modal('show');
        }

        $(document).ready(function() {

            $('#review-form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                console.log(form.serialize())
                var submitBtn = form.find('.submit-review-btn');
                submitBtn.prop('disabled', true);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        form.closest('.modal').modal('hide');
                        $('.filter-order.active').trigger('click');
                        alert('Đánh giá sản phẩm thành công!');
                    },
                    error: function(error) {
                        console.log(error);
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false);
                    }
                });
            });
            $('.filter-order').on('click', function(e) {
                e.preventDefault();
                var type = $(this).data('type');

                $('.filter-order').removeClass('active');
                $(this).addClass('active');

                $.ajax({
                    url: '/order/list',
                    method: 'GET',
                    data: {
                        type: type
                    },
                    success: function(response) {
                        $('#order-list-container').html(response);
                        $('.br-theme-fontawesome-stars .star-rating').barrating({
                            theme: 'fontawesome-stars'
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];;
                var data = $('.filter-order.active').data('type') + '&page=' + page;
                console.log(data);
                $.ajax({
                    url: '/order/list',
                    type: "GET",
                    data: data,
                    success: function(response) {
                        $('#order-list-container').html(response);
                        $('#scrollUp').trigger('click');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error: ', error);
                    }
                });
            });
        });
    </script>
@endpush
@push('css')
    <style>
        .navbar-nav {
            background: #fff;
            width: 100%;
        }

        .navbar .nav-item.nav-link {
            font-size: 1rem;
            color: #000;
            text-align: center;
            padding: 1rem 0 .7rem 0;
        }

        .navbar .nav-item.nav-link.active {
            border-bottom: 2px solid red;
        }
    </style>
@endpush
