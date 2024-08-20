<div class="bg-white container category-list mt-10 mb-10 pb-20 row review-area" style="margin:auto">
    <div class="col-12">
        <p class="title mb-0 pt-15 pb-15 text-dark text-uppercase">Đánh giá sản phẩm</p>
    </div>
    <div class="col-md-12">
        <div class="review-filter d-flex">
            <div class="col-md-2 pt-5 overal-rating">
                <p><span class="text-lg ">{{ number_format($product->rating, 1) }}</span> trên 5</p>
                <div class="stars-outer">
                    <div class="stars-inner" style="width: {{ ($product->rating / 5) * 100 }}%;"></div>
                </div>
            </div>
            <div class="col-md-9 p-0">
                <div class="bg-white red-border filter-review active">Tất cả</div>
                <div class="bg-white red-border filter-review" data-filter="5">5 sao (n)</div>
                <div class="bg-white red-border filter-review" data-filter="4">4 sao (n)</div>
                <div class="bg-white red-border filter-review" data-filter="3">3 sao (n)</div>
                <div class="bg-white red-border filter-review" data-filter="2">2 sao (n)</div>
                <div class="bg-white red-border filter-review" data-filter="1">1 sao (n)</div>
            </div>
        </div>

    </div>
    @php
        $reviews ??= $product['reviews'];
    @endphp
    <div class="col-12" id="review-list">
        @include('Product::frontend.components.review.list')
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('.filter-review').on('click', function() {
                $(this).addClass('active');
                var filter = $(this).data('filter');
                $('.filter-review').removeClass('active');
                $(this).addClass('active');

                $.ajax({
                    url: '/product/{{ $product->slug }}/review',
                    method: 'GET',
                    data: {
                        filter: filter
                    },
                    success: function(response, url) {
                        $('#review-list').html(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                event.preventDefault();

                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];

                getData(page);
            });
        });

        function getData(page) {
            var filter = $('.filter-review.active').data('filter');
            $.ajax({
                    url: '/product/{{ $product->slug }}/review?page=' + page,
                    type: "GET",
                    data: {
                        filter: filter
                    },
                    datatype: "html",
                })
                .done(function(data) {
                    $('#review-list').html(data);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
        }
    </script>
    </script>
@endpush
@push('css')
    <style>

        .pagination {
            justify-content: center;
            margin: 1rem 0;
        }

        .review-area {
            margin-bottom: 1rem;
        }

        .review-filter {
            background: #fffbf7;
            padding: 2rem;
            border: 1px solid #faeee6;
            margin: 0 40px;
            cursor: pointer;
        }

        .review-filter p {
            color: #d1001c;
            font-weight: 550;
            font-size: 1.2rem;
        }

        .review-filter p .text-lg {
            font-size: 1.7rem;
        }

        .review-area .overal-rating .stars-inner,
        .review-area .overal-rating .stars-outer {
            font-size: 1.3rem;
        }

        .review-area .stars-outer::before {
            content: "\f006 \f006 \f006 \f006 \f006";
            color: #d1001c;
        }

        .review-area .stars-inner::before {
            content: "\f005 \f005 \f005 \f005 \f005";
            color: #d1001c;
        }

        .review-area .bg-white.red-border {
            border: 1px solid #faeee6;
            padding: .3rem 1.6rem;
            margin: .2rem .1rem;
            display: inline-block;
        }

        .review-area .review-card {
            margin-top: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #faeee6;
        }

        .review-area .review-card .customer-name {
            font-size: .9rem;
            margin-bottom: 0;
            color: #000;
        }

        .review-area .review-card .date-and-variant {
            font-size: .8rem;
            margin-bottom: 0;
            color: rgba(0, 0, 0, .54);
        }

        .review-area .review-card .comment {
            font-size: 1rem;
            margin-bottom: 0;
            color: #000;
            ;
        }

        .review-area .review-card .user-avatar {
            background: #eeeeee;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 50px;
        }

        .review-area .review-card .user-avatar img {
            width: 80%;
            aspect-ratio: 1 / 1;
            object-fit: contain
        }

        .review-area .review-card .stars-outer::before,
        .review-area .review-card .stars-inner::before {
            letter-spacing: 2px;
            font-size: .9rem;
        }
        .filter-review.active
        {
            background: #ffcc00 !important;
        }
    </style>
@endpush
