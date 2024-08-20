@extends("Layout::admin.app")

@section("content")

    <div class="row">
        <div class="col-lg-12">

            @include("Layout::admin.components.messages.index")

            @include("User::admin.shop.parts.bulk-action",
                [
                    "url" => route("user.admin.shop.bulk-action")
                ]
            )

            <p class="text-end">
                <i>Tìm thấy {{$rows->total()}} Shop</i>
            </p>

            <div class="card p-3">
                <div class="card-body">
                    @include("User::admin.shop.parts.search-filter")
                    <hr>
                    @include("User::admin.shop.loop.list-item")
                </div>
            </div>

        </div>
    </div>

@endsection
