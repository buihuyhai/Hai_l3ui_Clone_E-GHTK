@extends("Layout::frontend.index")

@section("body")
    <!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to
    improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper">

    <!-- Begin Header Area -->
    @include("Layout::frontend.parts.header")
    <!-- Header Area End Here -->

    @yield("content")

    <!-- Begin Footer Area -->
    @include("Layout::frontend.parts.footer")
    <!-- Footer Area End Here -->

</div>
<!-- Body Wrapper End Here -->
@endsection
