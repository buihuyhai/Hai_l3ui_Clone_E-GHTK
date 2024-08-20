@extends("Layout::admin.app")

@include("User::admin.parts.header.style", [
    "url" => isset($row) ? asset("storage/".$row->avatar): ""
])

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
                                    "label" => "Họ Đệm",
                                    "classes" => "first_name",
                                    "id" => "first_name",
                                    "type" => "text",
                                    "name" => "first_name",
                                    "value" => old("first_name", $row->first_name ?? ""),
                                    "placeholder" => "Họ đệm",
                                    "required" => "required",
                                ]
                            )
                        </div>

                        <div class="col-4">
                            @include("User::admin.components.inputs.input-require",
                                [
                                    "label" => "Tên",
                                    "classes" => "last_name",
                                    "id" => "last_name",
                                    "type" => "text",
                                    "name" => "last_name",
                                    "value" => old("last_name", $row->last_name ?? ""),
                                    "placeholder" => "Tên",
                                    "required" => "required",
                                ]
                            )
                        </div>

                        <div class="col-4">
                            @include("User::admin.components.inputs.input-require",
                                [
                                    "label" => "Điện Thoại",
                                    "classes" => "phone",
                                    "id" => "phone",
                                    "type" => "number",
                                    "name" => "phone",
                                    "value" => old("phone", $row->phone ?? ""),
                                    "placeholder" => "Điện Thoại",
                                    "required" => "required",
                                ]
                            )
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
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
                    </div>

                    <div class="row mb-3">
                        <label for="provide-password">
                            <input
                                type="checkbox"
                                class=""
                                id="provide-password"> Cấp mật khẩu
                        </label>
                    </div>

                    <div class="row mb-3 provide-password-data d-none">
                        <div class="col-6">
                            @include("User::admin.components.inputs.input-require",
                                [
                                    "label" => "Mật khẩu",
                                    "classes" => "password",
                                    "id" => "password",
                                    "type" => "password",
                                    "name" => "password",
                                    "value" => "",
                                    "placeholder" => "Mật khẩu",
                                    "required" => "",
                                ]
                            )
                        </div>
                    </div>

                    @yield("parts")
                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="col-form-label fw-bold">{{__("Ảnh đại diện")}}</p>
                            <div class="file-wrapper">
                                <input
                                    type="file"
                                    class="rectangle"
                                    name="avatar"
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

@push("js")

    <script>
        const providePassword = document.querySelector('#provide-password');
        const providePasswordData = document.querySelector('.provide-password-data');
        providePassword.addEventListener('change', function() {
            console.log('hehe');
            if (providePassword.checked) {
                providePasswordData.classList.remove('d-none');
            } else {
                providePasswordData.classList.add('d-none');
            }
        });

    </script>

@endpush
