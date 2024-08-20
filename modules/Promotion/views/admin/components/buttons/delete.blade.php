<a href="{{ route('coupon.admin.delete', ['id' => $coupon->id]) }}"
    onclick="event.preventDefault();
    document.getElementById('delete-{{ $coupon->id }}').submit()"
    class="text-danger dropdown-item">
    <i class="bi bi-trash-fill"></i>
    Xóa
</a>
<form action="{{ route('coupon.admin.delete', ['id' => $coupon->id]) }}" id="delete-{{ $coupon->id }}" method="POST"
    class="hidden">
    @csrf
</form>
