@extends("Layout::frontend.app")

@section("content")

    <div class="page-section mb-60">
        <div class="container">
            <div class="row justify-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif

                    <!-- Login Form s-->
                    <form
                        method="POST"
                        action="{{ route('password.email') }}">
                        @csrf

                        <div class="login-form">
                            <h4 class="login-title">Quên Mật Khẩu</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email*</label>
                                    <input
                                        class="mb-0"
                                        type="email"
                                        name="email"
                                        placeholder="Email...">
                                    @error("email")
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <button
                                        type="submit"
                                        class="register-button mt-0 mr-3" style="width: auto">Lấy mật khẩu
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
