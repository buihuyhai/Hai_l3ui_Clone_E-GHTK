<a
    href="{{ route("user.admin.change-lock", ["id" => $row->id]) }}"
    onclick="event.preventDefault(); document.getElementById('change-lock-{{$row->id}}').submit()"
    class="text-{{$row->status == \Modules\User\Hooks\StatusHook::ACTIVE?"warning":"info"}}
    dropdown-item"
>
    @if($row->status == \Modules\User\Hooks\StatusHook::ACTIVE)
        <i class="bi bi-lock-fill"></i>
    @else
        <i class="bi bi-unlock-fill"></i>
    @endif
    {{$row->status == \Modules\User\Hooks\StatusHook::ACTIVE?"Khóa tài khoản":"Mở tài khoản"}}
</a>

<form
    action="{{route("user.admin.change-lock", ["id" => $row->id])}}"
    id="change-lock-{{$row->id}}"
    method="POST"
    class="hidden">
    @csrf
</form>
