@extends('Shop::layout.master')

@section('content')

    <div class="pagetitle">
        <h1>Danh sách đơn hàng</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div >
            <div class="card">
                <div class="card-body"></div>
            </div>
            <div class="card">
                <div class="card-body">
                    @include('Shop::common.table',[
                        'field' => [
                            'Tên khách hàng' => 'name',
                            'Tiền phải trả' => 'total_price',
                            'Email' => 'email',
                            'Địa chỉ' => 'sold',
                            'Điện thoại' => 'phone_number',
                            'Trạng thái' => 'status'
                        ],
                        'action' => true,
                        'idTable' => 'data-order',
                    ])

                </div>

                <div class="card-footer">
                    <nav aria-label="...">
                        <ul class="pagination" id="paginate">

                        </ul>
                    </nav><!-- End Basic Pagination -->

                </div>
            </div>
        </div>
        @include('Shop::admin.detail_order',[
            'modalId' => 'open-order-detail',
            'title' => 'Detail order',
//            'submit' => 'openDetailOrder()'
        ])

    </section>
@endsection

@push('js')
    <script src="{{ asset('admin/assets/js/shop/orders.js') }}"></script>
@endpush
