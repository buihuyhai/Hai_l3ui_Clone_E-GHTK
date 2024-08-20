<!-- Table with stripped rows -->
<table class="table">
    <thead>
    <tr>
        <th>
            <input
                type="checkbox"
                class="select-all"
            >
        </th>
        <th>Tên</th>
        <th>Email</th>
        <th>SDT</th>
        <th>Ngày tạo</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if($rows->count()>0)
        @foreach($rows as $key => $row)
            <tr>
                <td>
                    <input
                        type="checkbox"
                        name="ids[]"
                        class="select-item"
                        value="{{$row->id}}">
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <img
                            src="{{asset("storage/".$row->logo_url)}}"
                            width="32"
                            class="rounded-circle me-3 rounded-avatar">
                        <span>{{$row->name}}</span>
                    </div>
                </td>
                <td>{{$row->email}}</td>
                <td>{{$row->phone_number}}</td>
                <td>{{$row->created_at?->format('d-m-Y')}}</td>
                <td class="text-end">
                    @if(Auth::user()->hasPermissionTo('confirm_shop'))
                        @include("User::admin.components.buttons.button-form",
                            [
                                "url" => route("user.admin.shop.confirm", ["id" => $row->id]),
                                "id" => "confirm-".$row->id,
                                "title" => "Xác nhận",
                                "icon" => '<i class="bi bi-check-lg"></i>',
                                "classes" => "text-white bg-primary"
                            ]
                        )
                    @endif
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<!-- End Table with stripped rows -->
{{$rows->links()}}
