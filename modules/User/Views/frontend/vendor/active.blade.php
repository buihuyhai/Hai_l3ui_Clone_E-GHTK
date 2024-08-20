@extends("Layout::frontend.app")

@section("content")

    <div class="container">

        <div class="row">

            <div class="col-md-6">
                <img
                    src="https://i.pinimg.com/564x/fd/b9/3a/fdb93a8f2821bdb057f43daa955b0864.jpg"
                    alt="">
            </div>

            <div class="col-md-6 d-flex align-items-center flex-column justify-content-center">
                <form
                    action="{{route("vendor.handle-active")}}"
                    method="POST">
                    @csrf
                    <div class="text-center">
                        <h2 class="fw-bold">ĐĂNG KÝ TRỞ THÀNH NGƯỜI BÁN</h2>
                        <h3>Chào mừng đến với E-GHTK!</h3>
                        <p>Vui lòng cung cấp thông tin để thành lập tài khoản người bán trên E-GHTK</p>
                        <button
                            type="submit"
                            class="btn btn-danger text-white fw-bold">ĐĂNG KÝ
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

@endsection
