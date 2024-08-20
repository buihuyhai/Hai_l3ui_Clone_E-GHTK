<!-- Table with stripped rows -->

@php
    function hbsetcolor($mau)
    {
        if ($mau <= 1000) {
            return 'warning';
        } elseif ($mau > 1000 && $mau <= 5000) {
            return 'success';
        } elseif ($mau > 5000 && $mau <= 10000) {
            return 'primary';
        } elseif ($mau > 10000 && $mau <= 100000) {
            return 'danger';
        } else {
            return 'info';
        }
    }
@endphp

<table class="table">
    <thead>
        <tr>
            <th>
                <input type="checkbox" class="select-all">
            </th>
            <th>{{ __('Code') }}</th>
            <th>{{ __('Giảm tối đa') }}</th>
            <th>{{ __('% giảm') }}</th>
            <th>{{ __('Giảm đơn từ') }}</th>
            <th>{{ __('Lần sử dụng') }}</th>
            <th>{{ __('Đã sử dụng') }}</th>
            <th>{{ __('Ngày bắt đầu') }}</th>
            <th>{{ __('Ngày hết hạn') }}</th>
            <th>{{ __('') }}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($coupons as $coupon)
            <tr style="text-align:center">
                <td>
                    <input type="checkbox" name="ids[]" class="select-item" value="{{ $coupon->id }}">
                </td>
                <td style="margin-top: 5px" class="badge bg-{{ hbsetcolor($coupon->value) }} text-white">{{ $coupon->code }}</td>
                <td style="text-align:right;padding-right:20px">{{ number_format($coupon->value) }}₫</td>
                <td>{{ $coupon->percent }}</td>
                <td style="text-align:right;padding-right:20px">{{ number_format($coupon->from) }}₫</td>
                <td>{{ $coupon->total }}</td>
                <td>{{ $coupon->used }}</td>
                <td>{{ \Carbon\Carbon::parse($coupon->start_date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($coupon->expired_date)->format('d-m-Y') }}</td>
                <td>

                    <div class="dropdown">
                        <button  style="background-color: skyblue"  class="btn btn-secondary dropdown-toggle" type="button" id="action-{{ $coupon->id }}"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="action-{{ $coupon->id }}">
                            <li>
                                <a href="{{ route('coupon.admin.edit', ['id' => $coupon->id]) }}"
                                    class="text-primary dropdown-item">
                                    <i class="bi bi-pencil-square"></i>
                                    Cập nhật
                                </a>
                            </li>
                            <li>
                                @include('Promotion::admin.components.buttons.delete')
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- End Table with stripped rows -->
{{ $coupons->links() }}
