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
                    "placeholder"=>"Tên Shop",
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

        @if(Request::route()->getName() != "user.admin.shop.unconfirmed")
            <div class="col-sm-6 col-md-2">
                @include("User::admin.components.selects.select-form",
                    [
                        "classes" => "",
                        "name" => "status",
                        "id" => "status",
                        "options" => [
                            [
                                "value" => "",
                                "title" => "Trạng thái hoạt động"
                            ],
                            [
                                "value" => "open",
                                "selected" => request('status')=="open"?"selected":false,
                                "title" => "Open",
                                "classes" => ""
                            ],
                            [
                                "value" => "close",
                                "selected" => request('status')=="close"?"selected":false,
                                "title" => "Close",
                                "classes" => ""
                            ],
                            [
                                "value" => "locked",
                                "selected" => request('status')=="locked"?"selected":false,
                                "title" => "Locked",
                                "classes" => ""
                            ],
                        ],
                    ]
                )
            </div>

            <div class="col-sm-6 col-md-2">
                @include("User::admin.components.selects.select-form",
                    [
                        "classes" => "",
                        "name" => "is_confirmed",
                        "id" => "is_confirmed",
                        "options" => [
                            [
                                "value" => "",
                                "title" => "Trạng thái xác nhận"
                            ],
                            [
                                "value" => "true",
                                "selected" => request('is_confirmed')=='true'?"selected":false,
                                "title" => "Xác nhận",
                                "classes" => ""
                            ],
                            [
                                "value" => "false",
                                "selected" => request('is_confirmed')=='false'?"selected":false,
                                "title" => "Chưa xác nhận",
                                "classes" => ""
                            ],
                        ],
                    ]
                )
            </div>
        @else
            <div class="col-md-4 col-sm-12"></div>
        @endif
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
