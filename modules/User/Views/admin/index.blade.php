@extends("Layout::admin.app")

@section("content")
    <div class="row">
        <div class="col-lg-12">

            @include("Layout::admin.components.messages.index")

            @include("User::admin.parts.form.user-bulk-action",
                [
                    "url" => route("user.admin.bulk-action")
                ]
            )

            <p class="text-end">
                <i>Tìm thấy {{$rows->total()}} người dùng</i>
            </p>

            <div class="card p-3">
                <div class="card-body">
                    @include("User::admin.parts.form.search-filter")
                    <hr>
                    @include("User::admin.loop.list-item")
                </div>
            </div>

        </div>
    </div>

@endsection
