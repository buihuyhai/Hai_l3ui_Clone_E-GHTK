@extends("Layout::admin.index")

@section("body")

    <!-- ======= Header ======= -->
    @include("Layout::admin.parts.header")

    <main
        id="main"
        class="main">

        @include("Layout::admin.components.breadcrumbs.breadcrumbs_less")

        <!-- ======= Sidebar ======= -->
        @include("Layout::admin.parts.sidebar_less")

        <section class="section {{$classes ?? ""}}">

            @yield("content")
        </section>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include("Layout::admin.parts.footer")


    @include("Layout::admin.components.buttons.back-to-top")

@endsection

