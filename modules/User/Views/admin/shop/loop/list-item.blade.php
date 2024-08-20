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
        <th>Xác nhận</th>
        <th>Trạng thái</th>
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
                <td>
                    <span class="badge bg-{{$row->is_confirmed?'success':'danger'}}">
                        {{$row->is_confirmed?'Đã xác nhận':'Chưa xác nhận'}}
                    </span>
                </td>
                <td>
                    @php
                        $status = "";
                        $class = "";
                        switch ($row->status) {
                            case \Modules\Shop\Enum\StatusShopEnum::STATUS_OPEN: {
                                $status = "open";
                                $class = "success";
                                break;
                            }
                            case \Modules\Shop\Enum\StatusShopEnum::STATUS_CLOSE: {
                                $status = "close";
                                $class = "warning";
                                break;
                            }
                            case \Modules\Shop\Enum\StatusShopEnum::STATUS_LOCKED: {
                                $status = "locked";
                                $class = "danger";
                            }
                        }
                    @endphp
                    <span class="badge bg-{{$class}}">
                        {{$status}}
                    </span>
                </td>
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
                            @if(Auth::user()->hasPermissionTo('update_shop'))
                                <li>
                                    @include("User::admin.components.dropdown-items.item-link",
                                        [
                                            "url" => route("user.admin.shop.update", ["id" => $row->id]),
                                            "classes" => "text-primary",
                                            "icon" => '<i class="bi bi-pencil-square"></i>',
                                            "title" => "Cập nhật"
                                        ]
                                    )
                                </li>
                            @endif
                            @if(Auth::user()->hasPermissionTo('confirm_shop'))
                                @if(!$row->is_confirmed)
                                    <li>
                                        @include("User::admin.components.dropdown-items.form-item",
                                            [
                                                "url" => route("user.admin.shop.confirm", ["id" => $row->id]),
                                                "id" => "confirm-".$row->id,
                                                "icon" => '<i class="bi bi-check-lg"></i>',
                                                "title" => "Xác nhận",
                                                "classes" => "text-info"
                                            ]
                                        )
                                    </li>
                                @endif
                            @endif
                            @if(Auth::user()->hasPermissionTo('lock_shop'))
                                @if($row->status != \Modules\Shop\Enum\StatusShopEnum::STATUS_LOCKED)
                                    <li>
                                        @include("User::admin.components.dropdown-items.form-item",
                                            [
                                                "url" => route("user.admin.shop.lock", ["id" => $row->id]),
                                                "id" => "lock-".$row->id,
                                                "icon" => '<i class="bi bi-lock-fill"></i>',
                                                "title" => "Khóa",
                                                "classes" => "text-danger"
                                            ]
                                        )
                                    </li>
                                @endif
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
