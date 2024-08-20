@extends("Layout::admin.index")

@section("body")

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a
                            href="#"
                            class="logo d-flex align-items-center w-auto">
                            <img
                                src="https://giaohangtietkiem.vn/wp-content/themes/giaohangtk/images/logo-header.png"
                                alt="">
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Đăng Nhập Dành Cho Quản Trị Viên</h5>
                            </div>

                            <form
                                method="POST"
                                class="row g-3 needs-validation"
                                action="{{route('auth.admin.login')}}">
                                @csrf

                                <div class="col-12">
                                    <label
                                        for="email"
                                        class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <input
                                            type="text"
                                            name="email"
                                            placeholder="Email"
                                            class="form-control"
                                            id="email"
                                            required>
                                        @error("email")
                                        <span style="color: red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label
                                        for="password"
                                        class="form-label">Mật khẩu</label>
                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Mật khẩu"
                                        id="password"
                                        required>
                                    @error("password")
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input
                                            type="checkbox"
                                            name="remember"
                                            id="remember_me">
                                        <label for="remember_me">Lưu đăng nhập</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button
                                        type="submit"
                                        class="btn btn-primary w-100">Đăng nhập
                                    </button>

                                </div>
                            </form>

                        </div>
                    </div>

                    <a href="#">GHTK-NexTalent</a>


                </div>
            </div>
        </div>

    </section>

@endsection
