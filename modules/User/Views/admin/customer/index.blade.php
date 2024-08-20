@extends("Layout::admin.app")

@section("content")

    <div class="row">
        <div class="col-lg-12">
            @if(Auth::user()->hasPermissionTo('create_customer'))
                <div class="mb-3">
                    @include("User::admin.components.buttons.button-link",
                        [
                            "url" => route("user.admin.customer.create"),
                            "title" => "Thêm",
                            "classes" => "btn-info text-white"
                        ]
                    )
                </div>
            @endif

            @include("Layout::admin.components.messages.index")

            @include("User::admin.parts.form.user-bulk-action",
                [
                    "url" => route("user.admin.bulk-action")
                ])

            <p class="text-end">
                <i>Tìm thấy {{$rows->total()}} người bán</i>
            </p>

            <div class="card p-3">
                <div class="card-body">
                    @include("User::admin.parts.form.search-filter")
                    <hr>
                    @include("User::admin.customer.loop.list-item")
                </div>
            </div>

        </div>
    </div>
@endsection
