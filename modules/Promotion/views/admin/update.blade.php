@extends('Promotion::admin.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle">
                <h1>Chỉnh sửa Khuyến Mãi</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('coupon.admin.index') }}">Khuyến mãi</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa khuyến mãi</li>
                    </ol>
                </nav>
                @include('Layout::admin.components.messages.index')
            </div>

            <form action="{{ route('coupon.admin.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="code">Mã Coupon</label>
                    <input type="text" id="code" name="code" value="{{ old('code', $coupon->code) }}"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="value">Giá trị</label>
                    <input type="number" id="value" name="value" value="{{ old('value', $coupon->value) }}"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="percent">Phần trăm</label>
                    <input type="number" id="percent" name="percent" value="{{ old('percent', $coupon->percent) }}"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="from">Giảm đơn từ</label>
                    <input type="number" id="from" name="from" value="{{ old('from', $coupon->from) }}"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="total">Tổng số</label>
                    <input type="number" id="total" name="total" value="{{ old('total', $coupon->total) }}"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="used">Đã sử dụng</label>
                    <input type="number" id="used" name="used" value="{{ old('used', $coupon->used) }}"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="start_date">Ngày bắt đầu</label>
                    <input type="date" id="start_date" name="start_date"
                        value="{{ old('start_date', $coupon->start_date) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="expired_date">Ngày hết hạn</label>
                    <input type="date" id="expired_date" name="expired_date"
                        value="{{ old('expired_date', $coupon->expired_date) }}" class="form-control" required>
                </div>
                <br>
                <button style="text-align: center" type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.update-coupon').forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const couponId = this.getAttribute('data-id');


                    const code = document.querySelector('#code').value;
                    const value = document.querySelector('#value').value;
                    const percent = document.querySelector('#percent').value;
                    const from = document.querySelector('#from').value;
                    const total = document.querySelector('#total').value;
                    const used = document.querySelector('#used').value;
                    const start_date = document.querySelector('#start_date').value;
                    const expired_date = document.querySelector('#expired_date').value;

                    fetch('{{ route('coupon.admin.update', ['id' => '$coupon->id']) }}/' + couponId, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                code: code,
                                value: value,
                                percent: percent,
                                from: from,
                                total: total,
                                used: used,
                                start_date: start_date,
                                expired_date: expired_date
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Cập nhật khuyến mại thành công.');
                                location.reload();
                            } else {
                                alert('Có lỗi khi cập nhật khuyến mại.');
                            }
                        });
                });
            });
        });
    </script>
@endpush
