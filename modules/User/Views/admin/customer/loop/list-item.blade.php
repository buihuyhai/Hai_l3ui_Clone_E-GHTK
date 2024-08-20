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
        <th>{{__("Tên")}}</th>
        <th>{{__("Email")}}</th>
        <th>{{__("SDT")}}</th>
        <th>{{__("Trạng thái")}}</th>
        <th>{{__("Đăng nhập Lúc")}}</th>
        <th>{{__("Ngày tạo")}}</th>
        <th>{{__("Action")}}</th>
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
                                src="{{asset("storage/".$row->avatar)}}"
                                width="32"
                                class="rounded-circle me-3">
                        <span>{{$row->name}}</span>
                    </div>
                </td>
                <td>{{$row->email}}</td>
                <td>{{$row->phone}}</td>
                <td>
                    <span class="badge rounded-pill bg-{{$row->status=='active'?'success':'danger'}}">
                        {{$row->status=="active"?'Kích hoạt':'Bị khóa'}}
                    </span>
                </td>
                <td>{{$row->last_login_at}}</td>
                <td>{{$row->created_at?->format('d-m-Y')}}</td>
                <td class="text-end">
                    <div class="dropdown">
                        <button
                                class="btn btn-primary dropdown-toggle"
                                type="button"
                                id="action-{{$row->id}}"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                        </button>
                        <ul
                                class="dropdown-menu"
                                aria-labelledby="action-{{$row->id}}">
                            @if(Auth::user()->hasPermissionTo('update_customer'))
                                <li>
                                    @include("User::admin.components.dropdown-items.item-link",
                                        [
                                            "url" => route("user.admin.customer.update", ["id" => $row->id]),
                                            "classes" => "text-primary",
                                            "icon" => '<i class="bi bi-pencil-square"></i>',
                                            "title" => "Cập nhật"
                                        ]
                                    )
                                </li>
                            @endif
                            @if(Auth::user()->hasPermissionTo('lock_customer'))
                                <li>
                                    @include("User::admin.components.dropdown-items.change-lock")
                                </li>
                            @endif
                            @if(Auth::user()->hasPermissionTo('delete_customer'))
                                <li>
                                    @include("User::admin.components.dropdown-items.form-item",
                                        [
                                            "url" => route("user.admin.delete", ["id" => $row->id]),
                                            "id" => "delete-".$row->id,
                                            "icon" => '<i class="bi bi-trash-fill"></i>',
                                            "title" => "Xóa",
                                            "classes" => "text-danger"
                                        ]
                                    )
                                </li>
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<!-- End Table with stripped rows -->
{{$rows->links()}}
