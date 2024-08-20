@extends('Shop::layout.master')

@section('content')
    <div class="pagetitle">
        <h1>Cập nhật sản phẩm</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thông tin sản phẩm</h5>

                        <!-- General Form Elements -->
                        <form id="update-shop" action="#">
                            <input type="hidden" name="id" id="id" value="{{ $productId }}">

                            @include('Shop::common.input_text', [
                                'name' => 'name',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Tên',
                            ])

                            @include('Shop::common.input_text', [
                                'name' => 'price',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Giá',
                            ])

                            @include('Shop::common.input_text', [
                                'name' => 'sale-price',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Giá bán',
                            ])

                            @include('Shop::common.input_text', [
                                'name' => 'slug',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Slug',
                            ])

                            @include('Shop::common.input_text', [
                                'name' => 'thumbnail',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Ảnh',
                                'type' => 'file',
                                'displayImage' => true,
                                'change' => 'changeFile(this)',
                            ])

                            @include('Shop::common.select_box', [
                                'name' => 'category-id',
                                'placeholder' => 'category',
                                'label' => 'Category',
                                'data' => $categories ?? [],
                                'nameDisplay' => 'name',
                                'nameValue' => 'id',
                                'id' => 'select-category',
                                'required' => true,
                            ])

                            @include('Shop::common.textarea', [
                                'name' => 'description',
                                'classParent' => 'row mb-3',
                                'label' => 'Mô tả',
                            ])

                            @include('Shop::common.button', [
                                'classButton' => 'btn btn-primary btn-save',
                                'modalId ' => '#',
                                'title' => 'Lưu',
                                'onclick' => 'updateProduct()',
                            ])

                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title">Phân loại sản phẩm</h5>
                                    @include('Shop::common.button', [
                                        'classButton' => 'btn btn-success btn-save',
                                        'modalId ' => '#',
                                        'title' => 'Thêm mới',
                                        'onclick' => 'openModalVariant()',
                                    ])
                                </div>
                                <div class="card-body">
                                    @include('Shop::common.table', [
                                        'field' => [
                                            'Tên' => 'name',
                                            'Trong kho' => 'stock',
                                            'Giá' => 'price',
                                            'Giá bán' => 'sale_price',
                                            'Giá nhập' => 'import_price',
                                        ],
                                        'action' => true,
                                        'idTable' => 'data-variant',
                                    ])
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
        @include('Shop::admin.modal_variant', [
            'modalId' => 'open-variant',
            'title' => 'Biến thể sản phẩm',
            'submit' => 'submitVariantInUpdate()',
        ])
        @include('Shop::admin.modal_import_product', [
            'modalId' => 'open-import-product',
            'title' => 'Nhập kho',
            'submit' => 'submitImportVariant()',
        ])

    </section>
@endsection

@push('js')
    <script src="{{ asset('admin/assets/js/shop/action_product.js') }}"></script>
    <script src="{{ asset('admin/assets/js/shop/update_product.js') }}"></script>
@endpush
