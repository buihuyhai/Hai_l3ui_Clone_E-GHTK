@extends('Shop::layout.master')

@section('content')
    <div class="pagetitle">
        <h1>General Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">General</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">General Form Elements</h5>

                        <!-- General Form Elements -->
                        <form id="update-shop" action="#">
                            @include('Shop::common.input_text',[
                                'name' => 'name',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Tên',
                                'readonly' => true,
                            ])
                            @include('Shop::common.input_text',[
                                'name' => 'email',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Email',
                                'readonly' => true,

                            ])
                            @include('Shop::common.input_text',[
                                'name' => 'address',
                                'required' => true,
                                'classParent' => 'row mb-3',
                                'label' => 'Địa chỉ',
                                'readonly' => true,

                            ])

                            @include('Shop::common.input_text',[
                               'name' => 'phone_number',
                               'type' => 'number',
                               'required' => true,
                               'classParent' => 'row mb-3',
                               'label' => 'Điện thoại',
                               'readonly' => true,
                           ])

                            @include('Shop::common.input_text',[
                                'name' => 'logo',
                                'classParent' => ' row mb-3',
                                'classInput' => 'col-9 p-0',
                                'type' => 'file',
                                'idParentInput' => 'shop',
                                'displayImage' => true,
                                'change' => 'changeFile(this)',
                                'readonly' => true,

                            ])
                            @include('Shop::common.textarea',[
                               'name' => 'description',
                               'classParent' => 'row mb-3',
                               'label' => 'Mô tả',
                                'readonly' => true,

                            ])

                            @include('Shop::common.button',[
                               'classButton' => 'btn btn-primary',
                               'modalId ' => '#',
                               'title' => 'Cập nhật',
                               'onclick' => 'submitUpdateShop()'
                            ])

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection

@push('js')
    <script src="{{ asset('admin/assets/js/shop/information.js') }}"></script>

    <script>
        // async function getInfoStaff() {
        //     let response = await api.getInfoShop()
        // }
        // getInfoStaff()
    </script>
@endpush
