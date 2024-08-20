@extends("Layout::frontend.app")

@section("content")

    <div class="page-section mb-60">
        <div class="container">
            <div class="row justify-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form s-->
                    <form
                        method="POST"
                        action="{{ route('password.store') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input
                            type="hidden"
                            name="token"
                            value="{{ $request->route('token') }}">

                        <div class="login-form">
                            <h4 class="login-title">Quên Mật Khẩu</h4>
                            <div class="row">
                                <div class="col-md-12 mb-20">
                                    <label>Email*</label>
                                    <input
                                        class="mb-0"
                                        type="email"
                                        name="email"
                                        value="{{old("email", $request->email)}}"
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
                                        placeholder="Mật khẩu">
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
                                        placeholder="Xác nhận mật khẩu">
                                    @error("password_confirmation")
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <button
                                        type="submit"
                                        class="register-button mt-0 mr-3">XÁC NHẬN
                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
