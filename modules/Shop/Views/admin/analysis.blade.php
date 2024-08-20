@extends('Shop::layout.master')

@section('content')
    <section class="section dashboard">
        <div class="row">

            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Luồng đặt hàng<span>| Hôm nay</span></h5>

                            <div id="orderChart" style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); position: relative;"  >
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Doanh thu</h5>

                        <!-- Bar Chart -->
                        <div id="revenue-all-month" style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);" class="echart" _echarts_instance_="ec_1723170613321"><div style="position: relative; width: 528px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="660" height="500" style="position: absolute; left: 0px; top: 0px; width: 528px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div></div>
                        <!-- End Bar Chart -->
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">So sánh sản phẩm </h5>
                        <div class="row">
                            <div class="col-5">
                                @include('Shop::common.select_box',[
                                    'name' => 'first-product',
                                    'label' => 'Chọn:',
                                    'data' => $products ?? [],
                                    'nameDisplay' => 'name',
                                    'nameValue' => 'id',
                                    'id' => 'first-product',
                                ])
                            </div>
                            <div class="col-5">
                                @include('Shop::common.select_box',[
                                    'name' => 'second-product',
                                    'label' => 'Chọn',
                                    'data' => $products ?? [],
                                    'nameDisplay' => 'name',
                                    'nameValue' => 'id',
                                    'id' => 'second-product',
                                ])
                            </div>
                            <div class="col-2">
                                @include('Shop::common.button',[
                                   'classButton' => 'btn btn-primary',
                                   'modalId ' => '#',
                                   'title' => 'So sánh',
                                   'onclick' => 'analysisProduct()'
                                ])
                            </div>
                        </div>

                        <div id="analysisProduct" style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);" class="echart" _echarts_instance_="ec_1722954790101">
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tính toán doanh thu</h5>
                        <div class="row">
                            <div class="col-5">
                                @include('Shop::common.input_text',[
                                    'name' => 'year-start',
                                    'label' => 'Bắt đầu',
                                    'type' => 'number',
                                    'id' => 'year-start',
                                    'min' => 2010,
                                    'max' => 2050,
                                    'step' => 1,
                                    'value' => 2021
                                ])
                            </div>
                            <div class="col-5">
                                @include('Shop::common.input_text',[
                                    'name' => 'year-end',
                                    'label' => 'Kết thúc',
                                    'type' => 'number',
                                    'id' => 'year-end',
                                    'min' => 2010,
                                    'max' => 2050,
                                    'step' => 1,
                                    'value' => 2027
                                ])
                            </div>
                            <div class="col-2">
                                @include('Shop::common.button',[
                                   'classButton' => 'btn btn-primary',
                                   'modalId ' => '#',
                                   'title' => 'Thống kê',
                                   'onclick' => 'analysisYearly()'
                                ])
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div id="analysis-yearly" style="min-height: 365px;">
                        </div>
                        <!-- End Bar Chart -->

                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Đơn hàng</h5>

                        <!-- Stacked Bar Chart -->
                        <canvas id="sale-and-inventory" style="max-height: 400px; display: block; box-sizing: border-box; height: 263px; width: 527px;" width="659" height="329"></canvas>

                        <!-- End Stacked Bar Chart -->

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('admin/assets/js/shop/analysis.js') }}"></script>
@endpush
