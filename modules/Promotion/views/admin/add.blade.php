@extends('Promotion::admin.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle">
                <h1>Thêm khuyến Mãi</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('coupon.admin.index') }}">Khuyến mãi</a></li>
                        <li class="breadcrumb-item active">Thêm khuyến mãi</li>
                    </ol>
                </nav>
                @include('Layout::admin.components.messages.index')
            </div>

            <form action="{{ route('coupon.admin.add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="code">Mã Coupon</label>
                    <input type="text" id="code" name="code" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="value">Giá trị</label>
                    <input type="number" id="value" name="value" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="percent">Phần trăm</label>
                    <input type="number" id="percent" name="percent" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="from">Giảm đơn từ</label>
                    <input type="number" id="from" name="from" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="total">Tổng số</label>
                    <input type="number" id="total" name="total" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="used">Đã sử dụng</label>
                    <input type="number" id="used" name="used" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="start_date">Ngày bắt đầu</label>
                    <input type="date" id="start_date" name="start_date" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="expired_date">Ngày hết hạn</label>
                    <input type="date" id="expired_date" name="expired_date" value="" class="form-control"
                        required>
                </div>
                <br>
                <button style="text-align: center" type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.create-coupon').addEventListener('click', function(event) {
                event.preventDefault();

                fetch('{{ route('coupon.admin.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            code: document.querySelector('#code').value,
                            value: document.querySelector('#value').value,
                            percent: document.querySelector('#percent').value,
                            from: document.querySelector('#from').value,
                            total: document.querySelector('#total').value,
                            used: document.querySelector('#used').value,
                            start_date: document.querySelector('#start_date').value,
                            expired_date: document.querySelector('#expired_date').value,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Tạo mới khuyến mại thành công.');
                            location.reload();
                        } else {
                            alert('Có lỗi khi tạo mới khuyến mại.');
                        }
                    });
            });

        });
    </script>
@endpush
