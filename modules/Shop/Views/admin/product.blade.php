@extends('Shop::layout.master')

@section('content')

    <div class="pagetitle">
        <h1>Danh sách sản phẩm</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div >
            <div class="card">
                <div class="card-body"></div>
            </div>
            <div class="card">
                <div class="card-header">
                @include('Shop::common.button',[
                    'classButton' => 'btn btn-success',
                    'title' => 'Tạo mới sản phẩm',
                    'router' => 'shops.product.create'
                ])
                </div>
                <div class="card-body">
                    @include('Shop::common.table',[
                        'field' => [
                            'Ảnh' => 'thumbnail',
                            'Tên' => 'name',
                            'Giá' => 'price',
                            'Giá bán' => 'sale_price',
                            'Đã bán' => 'sold',
                            'Danh mục' => 'category_name'
                        ],
                        'action' => true,
                        'idTable' => 'data-product',
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
    </section>
@endsection

@push('js')
    <script src="{{ asset('admin/assets/js/shop/product.js') }}"></script>
@endpush
