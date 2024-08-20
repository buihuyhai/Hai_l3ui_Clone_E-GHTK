@extends("User::admin.parts.form.general-bulk-action")

@section("actions")
    @yield("actions-top")
    <option value="delete">Xóa nhiều</option>
    @yield("actions-bottom")
@endsection
