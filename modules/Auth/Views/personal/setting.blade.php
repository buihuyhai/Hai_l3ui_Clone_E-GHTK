@extends("Layout::admin.app_less")

@push('css')
    <style>

    </style>
@endpush

@section("content")

    @include("Layout::admin.components.messages.index")

    <div>
        <form
            method="post"
            action="{{ route('setting.store') }}">
            @csrf
            @method('put')

            <div class="card p-3">
                <div class="card-body">
                    <h5 class="fw-bold">Thay đổi mật khẩu</h5>
                    <p>Hãy đảm bảo rằng mật khẩu an toàn (phải >= 8 ký tự,...)</p>

                    <div class="row mb-3">
                        <div class="col-5">
                            <label for="current_password">Mật khẩu hiện tại
                                <span style="color: red">*</span>
                            </label>
                            <input
                                id="current_password"
                                name="current_password"
                                type="password"
                                required
                                placeholder="Mật khẩu hiện tại"
                                class="form-control">
                            @error("current_password")
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-5">
                            <label for="current_password">Mật khẩu mới
                                <span style="color: red">*</span>
                            </label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                placeholder="Mật khẩu mới"
                                class="form-control">
                            @error("password")
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-5">
                            <label for="password_confirmation">Xác nhận mật khẩu
                                <span style="color: red">*</span>
                            </label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                placeholder="Xác nhận mật khẩu"
                                class="form-control">
                            @error("password_confirmation")
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <button
                        class="btn btn-primary"
                        type="submit">Lưu
                    </button>

                </div>
            </div>
        </form>


        <form
            method="post"
            action="{{ route('profile.delete') }}"
            class="p-6">
            @csrf
            @method('delete')
            <div class="card p-3">
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-5">
                            <h5 class="fw-bold">Xóa tài khoản</h5>
                            <p>Sau khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của tài khoản đó sẽ bị xóa vĩnh viễn.
                                Trước khi xóa tài khoản, vui lòng tải xuống bất kỳ dữ liệu hoặc thông tin nào mà bạn muốn giữ lại.
                            </p>


                            <label for="password-delete">Mật khẩu hiện tại
                                <span style="color: red">*</span>
                            </label>
                            <input
                                id="password-delete"
                                name="password-delete"
                                type="password"
                                required
                                placeholder="Mật khẩu hiện tại"
                                class="form-control">
                            @error("password-delete")
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <button
                        class="btn btn-danger"
                        type="submit">Xóa tài khoản
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
