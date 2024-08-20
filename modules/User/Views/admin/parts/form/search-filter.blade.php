<form
    action=""
    method="GET">
    <div class="row ">
        <div class="col-sm-6 col-md-2">
            @include("User::admin.components.selects.select-form",
                    [
                        "classes" => "",
                        "name" => "limit",
                        "id" => "limit",
                        "options" => [
                            [
                                "value" => "",
                                "title" => "Số lượng"
                            ],
                            [
                                "value" => "5",
                                "selected" => request('limit')==5?"selected":false,
                                "title" => "5",
                                "classes" => ""
                            ],
                            [
                                "value" => "10",
                                "selected" => request('limit')==10?"selected":false,
                                "title" => "10",
                                "classes" => ""
                            ],
                            [
                                "value" => "15",
                                "selected" => request('limit')==15?"selected":false,
                                "title" => "15",
                                "classes" => ""
                            ],
                        ],
                    ]
                )
        </div>

        <div class="col-sm-6 col-md-2">
            @include("User::admin.components.inputs.input-form",
                [
                    "classes" => "",
                    "id" => "name",
                    "type" => "text",
                    "name" => "name",
                    "value" =>  request('name'),
                    "placeholder"=>"Họ tên",
                ]
            )
        </div>

        <div class="col-sm-6 col-md-2">
            @include("User::admin.components.inputs.input-form",
                [
                    "classes" => "",
                    "id" => "email",
                    "type" => "email",
                    "name" => "email",
                    "value" =>  request('email'),
                    "placeholder"=>"Email",
                ]
            )
        </div>

        <div class="col-sm-6 col-md-2">
            @include("User::admin.components.selects.select-form",
                    [
                        "classes" => "",
                        "name" => "status",
                        "id" => "status",
                        "options" => [
                            [
                                "value" => "",
                                "title" => "Trạng thái"
                            ],
                            [
                                "value" => "active",
                                "selected" => request('status')=='active'?"selected":false,
                                "title" => "Đã kích hoạt",
                                "classes" => ""
                            ],
                            [
                                "value" => "banned",
                                "selected" => request('status')=='banned'?"selected":false,
                                "title" => "Đã cấm",
                                "classes" => ""
                            ],
                        ],
                    ]
                )
        </div>

        <div class="col-sm-6 col-md-2">
            @if(Request::route()->getName() == "user.admin.index")
                @php
                    $options = [];
                    if (isset($roles) && $roles->count()>0) {
                        foreach ($roles as $role) {
                            if ($role->name == \Modules\Auth\Hooks\RoleHook::SUPER_ADMIN)
                                continue;
                            $options[] = [
                                "value" => $role->name,
                                "title" => $role->title,
                                "classes" => "",
                                "selected" => request('role')==$role->name?"selected":false
                            ];
                        }
                    }
                @endphp
                @include("User::admin.components.selects.select-form",
                    [
                        "classes" => "",
                        "name" => "role",
                        "id" => "role",
                        "options" => [
                            [
                                "value" => "",
                                "title" => "Vai trò"
                            ],
                            ...$options,
                        ],
                    ]
                )
            @endif
        </div>

        <div class="col-md-2 d-flex justify-content-end">
            @include("User::admin.components.buttons.button-submit",
                 [
                     "classes" => "btn-info text-white",
                     "title" => "Tìm kiếm"
                 ]
             )
        </div>

    </div>

</form>
