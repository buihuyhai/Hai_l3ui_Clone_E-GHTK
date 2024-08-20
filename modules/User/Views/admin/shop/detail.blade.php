@extends("Layout::admin.app")

@include("User::admin.parts.header.style",
    [
        "url" => isset($row) ? asset("storage/".$row->logo_url) : ""
    ]
)

@section("content")
    @include("Layout::admin.components.messages.index")
    <div class="">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$page_title}}</h5>

                <!-- General Form Elements -->
                <form
                    action=""
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <div class="row mb-3">
                        <div class="col-4">
                            @include("User::admin.components.inputs.input-require",
                                [
                                    "label" => "Tên",
                                    "classes" => "name",
                                    "id" => "name",
                                    "type" => "text",
                                    "name" => "name",
                                    "value" => old("name", $row->name ?? ""),
                                    "placeholder" => "Tên",
                                    "required" => "required",
                                ]
                            )
                        </div>

                        <div class="col-4">
                            @include("User::admin.components.inputs.input-require",
                                [
                                    "label" => "Địa chỉ",
                                    "classes" => "address",
                                    "id" => "address",
                                    "type" => "text",
                                    "name" => "address",
                                    "value" => old("address", $row->address ?? ""),
                                    "placeholder" => "Địa chỉ",
                                    "required" => "required",
                                ]
                            )
                        </div>

                        <div class="col-4">
                            @include("User::admin.components.inputs.input-require",
                                [
                                    "label" => "Số điện Thoại",
                                    "classes" => "phone_number",
                                    "id" => "phone_number",
                                    "type" => "number",
                                    "name" => "phone_number",
                                    "value" => old("phone_number", $row->phone_number ?? ""),
                                    "placeholder" => "Số điện Thoại",
                                    "required" => "required",
                                ]
                            )
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            @include("User::admin.components.inputs.input-require",
                                [
                                    "label" => "Email",
                                    "classes" => "email",
                                    "id" => "email",
                                    "type" => "email",
                                    "name" => "email",
                                    "value" => old("email", $row->email ?? ""),
                                    "placeholder" => "Email",
                                    "required" => "required",
                                ]
                            )
                        </div>
                        <div class="col-sm-6 col-md-2">
                            @include("User::admin.components.selects.select-require",
                                [
                                    "label" => "Trạng thái hoạt động",
                                    "classes" => "",
                                    "name" => "status",
                                    "id" => "status",
                                    "options" => [
                                        [
                                            "value" => "",
                                            "title" => "-- Trạng thái --"
                                        ],
                                        [
                                            "value" => "0",
                                            "selected" => old("status", $row->status ?? "")==0?"selected":false,
                                            "title" => "Mở",
                                            "classes" => ""
                                        ],
                                        [
                                            "value" => "1",
                                            "selected" => old("status", $row->status ?? "")==1?"selected":false,
                                            "title" => "Đóng",
                                            "classes" => ""
                                        ],
                                        [
                                            "value" => "2",
                                            "selected" => old("status", $row->status ?? "")==2?"selected":false,
                                            "title" => "Khóa",
                                            "classes" => ""
                                        ],
                                    ],
                                ]
                            )
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            @include("User::admin.components.textareas.textarea-unrequire",
                                [
                                    "label" => "Mô tả",
                                    "name" => "description",
                                    "rows" => "10",
                                    "id" => "description",
                                    "placeholder"=>"Mô tả",
                                    "value" => old("description", $row->description ?? "")
                                ]
                            )
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="col-form-label fw-bold">{{__("Ảnh đại diện của Shop")}}</p>
                                <div class="file-wrapper">
                                    <input
                                        type="file"
                                        class="rectangle"
                                        name="logo_url"
                                        accept="image/png, image/jpeg, image/gif"/>
                                </div>
                                <input
                                    type="hidden"
                                    class="filepond-hidden"
                                    value="">
                            </div>
                            @error("avatar")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary">{{isset($row)?'Cập nhật':'Thêm'}}
                        </button>

                </form>
                <!-- End General Form Elements -->

            </div>
        </div>

    </div>

@endsection

