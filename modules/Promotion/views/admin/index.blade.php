@extends('Promotion::admin.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="pagetitle">

                <h1>Khuyến Mãi</h1>

                <nav>

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{route("dashboard.admin.index")}}">Trang chủ</a></li>

                        <li class="breadcrumb-item active">Khuyến mãi</li>

                    </ol>

                </nav>
                @include('Layout::admin.components.messages.index')
            </div>
            <div class="mb-3">
                <a class="btn btn-primary" href="{{route('coupon.admin.addui')}}">Thêm mới</a>
            </div>

            <p class="text-end">
                <i>Tìm thấy {{ $coupons->total() }} mã giảm giá</i>
            </p>

            <div class="card p-3">
                <div class="card-body">
                    @include('Promotion::admin.parts.form.search-filter')
                    <hr>
                    @include('Promotion::admin.loop.list-item')
                </div>
            </div>

        </div>
    </div>
@endsection
