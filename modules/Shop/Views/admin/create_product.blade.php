@extends('Shop::layout.master')

@section('content')
    <div class="pagetitle">
        <h1>Sản phẩm</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thông tin sản phẩm</h5>

                        <!-- General Form Elements -->
                        <form id="update-shop" action="#">

                            @include('Shop::common.input_text',[
                                'name' => 'name',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Tên',
                            ])

                            @include('Shop::common.input_text',[
                                'name' => 'price',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Giá',
                                'type' => 'number'
                            ])

                            @include('Shop::common.input_text',[
                                'name' => 'sale-price',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Giá bán',
                                'type' => 'number'
                            ])

                            @include('Shop::common.input_text',[
                                'name' => 'slug',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Slug',
                            ])

                            @include('Shop::common.input_text',[
                                'name' => 'thumbnail',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Ảnh',
                                'type' => 'file',
                                'displayImage' => true,
                                'change' => 'changeFile(this)',
                            ])

                            @include('Shop::common.select_box',[
                                'name' => 'category-id',
                                'placeholder' => 'category',
                                'label' => 'Category',
                                'data' => $categories ?? [],
                                'nameDisplay' => 'name',
                                'nameValue' => 'id',
                                'id' => 'select-category',
                                'required' => true,
                            ])

                            @include('Shop::common.textarea',[
                                'name' => 'description',
                               'classParent' => 'row mb-3',
                               'label' => 'Mô tả',
                            ])

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Phân loại sản phẩm</h5>
                                    @include('Shop::common.button',[
                                       'classButton' => 'btn btn-success',
                                       'modalId ' => '#',
                                       'title' => 'Thêm mới',
                                       'onclick' => 'openModalVariant()'
                                    ])
                                </div>
                                <div class="card-body">
                                    @include('Shop::common.table',[
                                        'field' => [
                                            'Tên' => 'name',
                                            'Giá' => 'price',
                                            'Giá bán' => 'sale_price',
                                            'Giá nhập' => 'import_price',
                                        ],
                                        'action' => true,
                                        'idTable' => 'data-variant',
                                    ])
                                </div>
                            </div>



                            @include('Shop::common.button',[
                               'classButton' => 'btn btn-primary',
                               'modalId ' => '#',
                               'title' => 'Tạo',
                               'onclick' => 'createProduct()'
                            ])

                        </form>

                    </div>
                </div>

            </div>
        </div>
        @include('Shop::admin.modal_variant',[
            'modalId' => 'open-variant',
            'title' => 'Phân loại sản phẩm',
            'submit' => 'submitVariantInCreate()'
        ])

    </section>

@endsection

@push('js')
    <script src="{{ asset('admin/assets/js/shop/action_product.js') }}"></script>
    <script src="{{ asset('admin/assets/js/shop/create_product.js') }}"></script>
@endpush
