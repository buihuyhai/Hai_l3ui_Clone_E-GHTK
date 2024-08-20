@extends("Layout::admin.app_less")

@push("css")

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }


        /*File Img*/

        .filepond--root {
            height: 180px;
            width: 180px;
            opacity: 1;
            cursor: pointer;
        }

        .file-wrapper {
            position: relative;
            display: inline-block;
        }

        .filepond--credits {
            display: none;
        }

        .filepond--root .filepond--drop-label {
            background: url({{isset($row) ? asset("storage/".$row->avatar): ""}}) center/cover no-repeat #fff;
            height: 180px;
            width: 180px;
        }

        .filepond--drop-label {
            border: 1px solid #000;
            border-radius: .5rem;
        }

        .filepond--root .filepond--drop-label label {
            background: #333;
            color: #eee;
        }
    </style>

@endpush

@section("content")

    @include("Layout::admin.components.messages.index")

    <div>

        <form
            method="post"
            action="{{ route('profile.store') }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('patch')
            <div class="card p-3">
                <div class="card-body">
                    <h5 class="fw-bold">Thông tin cá nhân</h5>
                    <p>Cập nhật thông tin cá nhân và địa chỉ email</p>

                    <div class="row mb-3">
                        <div class="form-group col-3">
                            <label for="first_name">Họ đệm
                                <span style="color: red">*</span>
                            </label>
                            <input
                                id="first_name"
                                name="first_name"
                                type="text"
                                value="{{old("first_name", $row->first_name ?? "")}}"
                                placeholder="Họ đệm"
                                class="form-control"
                                required
                            >
                            @error("first_name")
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-3">
                            <label for="first_name">Tên
                                <span style="color: red">*</span>
                            </label>
                            <input
                                id="last_name"
                                name="last_name"
                                type="text"
                                value="{{old("last_name", $row->last_name ?? "")}}"
                                placeholder="Họ đệm"
                                class="form-control"
                                required
                            >
                            @error("last_name")
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="email">Email
                                    <span style="color: red">*</span>
                                </label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{old("email", $row->email ?? "")}}"
                                    required
                                    placeholder="Email"
                                    class="form-control">
                                @error("email")
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Điện thoại
                                    <span style="color: red">*</span>
                                </label>
                                <input
                                    class="form-control"
                                    id="phone"
                                    type="number"
                                    required
                                    value="{{old("phone", $row->phone ?? "")}}"
                                    name="phone"
                                    placeholder="Điện Thoại">
                                @error("phone")
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <div>
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


                        </div>
                    </div>


                    <button
                        class="btn btn-primary"
                        type="submit">Lưu
                    </button>

                </div>
            </div>
        </form>

    </div>

@endsection

@push('js')
    <script>

    </script>
@endpush
