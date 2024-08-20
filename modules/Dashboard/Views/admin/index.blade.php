@extends("Layout::admin.app", ["classes" => "dashboard"])

@include("Dashboard::admin.parts.headers.style")

@section("content")

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    @include("Dashboard::admin.parts.cards.vendor_less")

                    @include("Dashboard::admin.parts.cards.admin_less")

                    @include("Dashboard::admin.parts.cards.customer_less")

                    @include("Dashboard::admin.parts.cards.shop_less")

                    @include("Dashboard::admin.parts.cards.shop")

                    @include("Dashboard::admin.parts.cards.vendor")

                    @include("Dashboard::admin.parts.cards.customer")

                    @include("Dashboard::admin.parts.cards.admin")

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                @include("Dashboard::admin.parts.charts.user")
            </div>
            <!-- End Right side columns -->

        </div>
    </section>

@endsection

@push("js")
    <script src="{{asset("admin/assets/js/dashboard/app.js")}}"></script>
    <script src="{{asset("admin/assets/js/dashboard/shop.js")}}"></script>

@endpush
