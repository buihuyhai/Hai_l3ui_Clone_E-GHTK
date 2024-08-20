@extends('Shop::layout.master')

@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Đơn hàng <span>| Hôm nay</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6 id="count-order-number">0</h6>
                                <span class=" small pt-1 fw-bold" id="count-order-percent">0%</span> <span class="text-muted small pt-2 ps-1" id="count-order-type"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Lãi suất <span>| Tháng này</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6 id="revenue-number">$0</h6>
                                <span class="small pt-1 fw-bold" id="revenue-percent">0%</span> <span class="text-muted small pt-2 ps-1" id="revenue-type"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Đã bán <span>| Tháng này</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-product"></i>
                            </div>
                            <div class="ps-3">
                                <h6 id="product-sale-number">0</h6>
                                <span class="small pt-1 fw-bold" id="product-sale-percent">0%</span> <span class="text-muted small pt-2 ps-1" id="product-sale-type"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Báo cáo <span>| Hôm nay</span></h5>

                        <!-- Line Chart -->
                        <div id="reportsChart" style="min-height: 365px;">
                        </div>

                        <script>

                        </script>
                        <!-- End Line Chart -->

                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="card top-selling overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Lọc</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Hôm nay</a></li>
                            <li><a class="dropdown-item" href="#">Tháng này</a></li>
                            <li><a class="dropdown-item" href="#">Năm nay</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Top bán chạy <span>| Năm nay</span></h5>

                        @include('Shop::common.table',[
                            'field' => [
                                'Preview' => 'thumbnail',
                                'Tên' => 'name',
                                'Giá' => 'price',
                                'Đã bán' => 'sold',
                            ],
                            'classTable' => 'table table-borderless',
                            'idTable' => 'data-product',
                        ])
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('admin/assets/js/shop/dashboard.js') }}"></script>
@endpush
