@extends("Layout::frontend.app")

@section("content")

    <div class="page-section mb-60 mt-3">
        <div class="container">

            @include("Layout::admin.components.messages.index")

            <div class="row">


                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <form
                        method="POST"
                        action="{{ route('register') }}">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Đăng ký</h4>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Họ đệm</label>
                                    <input
                                        class="mb-0"
                                        type="text"
                                        name="first_name"
                                        value="{{old("first_name")}}"
                                        placeholder="Họ đệm"
                                        required
                                    >
                                    @error("first_name")
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Tên</label>
                                    <input
                                        class="mb-0"
                                        name="last_name"
                                        value="{{old("last_name")}}"
                                        type="text"
                                        placeholder="Tên"
                                        required
                                    >
                                    @error("last_name")
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Email*</label>
                                    <input
                                        class="mb-0"
                                        type="email"
                                        name="email"
                                        value="{{old("email")}}"
                                        required
                                        placeholder="Email">
                                    @error("email")
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Mật khẩu</label>
                                    <input
                                        class="mb-0"
                                        name="password"
                                        type="password"
                                        placeholder="Mật khẩu"
                                        required
                                    >
                                    @error("password")
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Xác nhận mật khẩu</label>
                                    <input
                                        class="mb-0"
                                        type="password"
                                        name="password_confirmation"
                                        placeholder="Xác nhận mật khẩu"
                                        required
                                    >
                                    @error("password_confirmation")
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button
                                        type="submit"
                                        class="register-button mt-0 mr-3">Đăng ký
                                    </button>
                                    <a
                                        href="{{route("login")}}"
                                        class="btn register-button bg-danger mt-0 d-block">Đăng nhập
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
