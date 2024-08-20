@extends("Layout::frontend.app")

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
            background: url("../../../../../storage/avatars/default.png") center/cover no-repeat #fff;
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

    <div class="container">
        <form
            class="mt-3"
            action="{{route("shops.api.register-shop")}}"
            id="form-register-shop"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="card p-5">
                <div class="card-body">
                    <div class="card-title">
                        <h2>Thông tin Shop
                            <i
                                class="fa fa-home"
                                aria-hidden="true"></i>
                        </h2>
                        <hr class="my-3">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-25">
                                <label for="name">Tên shop
                                    <span style="color: red">*</span>
                                </label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="name"
                                    id="name"
                                    required
                                    placeholder="Tên shop">
                            </div>

                            <div class="form-group mb-25">
                                <label for="address">Địa chỉ lấy hàng
                                    <span style="color: red">*</span>
                                </label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="address"
                                    required
                                    id="address"
                                    placeholder="Địa chỉ lấy hàng">
                            </div>

                            <div class="form-group mb-25">
                                <label for="email">Email
                                    <span style="color: red">*</span>
                                </label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="email"
                                    required
                                    id="email"
                                    value="{{old("email", $row?->email ?? "")}}"
                                    placeholder="Email">
                            </div>

                            <div class="form-group mb-25">
                                <label for="phone_number">Số điện thoại
                                    <span style="color: red">*</span>
                                </label>
                                <input
                                    class="form-control"
                                    type="number"
                                    name="phone_number"
                                    required
                                    id="phone_number"
                                    value="{{old("phone_number", $row?->phone ?? "")}}"
                                    placeholder="Số điện thoại">
                            </div>
                        </div>

                        <div class="col-6">
                            <div>
                                <label class="d-block">{{__("Ảnh đại diện")}}
                                    <span style="color: red">*</span>
                                </label>
                                <div class="file-wrapper">
                                    <input
                                        type="file"
                                        class="rectangle"
                                        name="logo"
                                        id="logo"
                                        accept="image/png, image/jpeg, image/gif"/>
                                </div>
                                <input
                                    type="hidden"
                                    class="filepond-hidden"
                                    value="">
                            </div>
                        </div>

                    </div>
                    <div class="form-group mb-25">
                        <label for="description">Mô tả
                            <span style="color: red">*</span>
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            class="bg-white"
                            rows="10"
                            placeholder="Mô tả thông tin shop..."></textarea>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-2">
                            <button
                                id="btn-register-shop"
                                class="btn btn-danger w-100 d-flex justify-content-center align-items-center">
                                <span class="loader d-none"></span>
                                Đăng ký
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push("js")
    <script>
        $(document).ready(function() {
            const formRegisterShop = $('#form-register-shop');

            const pond = document.querySelector('.filepond--root');

            let logoEl;
            pond.addEventListener('FilePond:addfile', (e) => {
                console.log('File added', e.detail.file.file);
                logoEl = e.detail.file.file;
            });

            formRegisterShop.on('submit', function(e) {
                e.preventDefault();

                const loader = $('.loader');
                loader.removeClass('d-none');

                const formData = new FormData();
                formData.append('name', $('#name').val());
                formData.append('address', $('#address').val());
                formData.append('email', $('#email').val());
                formData.append('phone_number', $('#phone_number').val());
                formData.append('description', $('#description').val());
                formData.append('logo', logoEl);
                formData.append('_token', $('input[name=\'_token\']').val());

                console.log(formData);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(json) {
                        console.log(json);
                        loader.addClass('d-none');
                        $.notify("Tạo shop thành công!", 'success');
                        setTimeout(function() {
                            window.location.replace("{{route("shops.dashboard")}}");
                        }, 1500);
                    },
                    error: function(e) {
                        console.log(e);
                        loader.addClass('d-none');
                        $.notify("Đã có lỗi xảy ra!", 'error');
                    },
                });
            });
        });
    </script>

@endpush


