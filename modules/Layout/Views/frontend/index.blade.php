<!doctype html>
<html
    class="no-js"
    lang="zxx">

<!-- index28:48-->
<head>
    <meta charset="utf-8">
    <meta
        http-equiv="x-ua-compatible"
        content="ie=edge">
    <title>{{__("G-Ecommerce")}}</title>
    <meta
        name="description"
        content="">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="{{asset("frontend/assets/images/favicon.png")}}">

    <!-- Material Design Iconic Font-V2.2.0 -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/material-design-iconic-font.min.css")}}">
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/font-awesome.min.css")}}">
    <!-- Font Awesome Stars-->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/fontawesome-stars.css")}}">
    <!-- Meanmenu CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/meanmenu.css")}}">
    <!-- owl carousel CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/owl.carousel.min.css")}}">
    <!-- Slick Carousel CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/slick.css")}}">
    <!-- Animate CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/animate.css")}}">
    <!-- Jquery-ui CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/jquery-ui.min.css")}}">
    <!-- Venobox CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/venobox.css")}}">
    <!-- Nice Select CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/nice-select.css")}}">
    <!-- Magnific Popup CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/magnific-popup.css")}}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/bootstrap.min.css")}}">
    <!-- Helper CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/helper.css")}}">

    <script src="https://cdn.tiny.cloud/1/v1wvkm3nr87bqq8scwj77v5decfhzbqjrk1hko8t0rq75uty/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#nhuandt3-text-editor'
        });
    </script>

    <!-- Main Style CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/css/components/loader.css")}}">

    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/css/style.css")}}">
    <!-- Responsive CSS -->
    <link
        rel="stylesheet"
        href="{{asset("frontend/assets/vendor/css/responsive.css")}}">
    <!-- Modernizr js -->
    <script src="{{asset("frontend/assets/vendor/js/vendor/modernizr-2.8.3.min.js")}}"></script>
    <script src="{{asset("frontend/assets/vendor/js/vendor/jquery-1.12.4.min.js")}}"></script>

    <link
        href="{{asset("admin/assets/vendor/@pqina/pintura/pintura.css")}}"
        rel="stylesheet">
    <link
        href="{{asset("admin/assets/vendor/filepond/dist/filepond.min.css")}}"
        rel="stylesheet">
    <link
        href="{{asset("admin/assets/vendor/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.min.css")}}"
        rel="stylesheet">

    @stack("css")

</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to
    improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper">

    @yield("body")

</div>
<!-- Body Wrapper End Here -->

<!-- jQuery-V1.12.4 -->

<!-- Popper js -->
<script src="{{asset("frontend/assets/vendor/js/vendor/popper.min.js")}}"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="{{asset("frontend/assets/vendor/js/bootstrap.min.js")}}"></script>
<!-- Ajax Mail js -->
<script src="{{asset("frontend/assets/vendor/js/ajax-mail.js")}}"></script>
<!-- Meanmenu js -->
<script src="{{asset("frontend/assets/vendor/js/jquery.meanmenu.min.js")}}"></script>
<!-- Wow.min js -->
<script src="{{asset("frontend/assets/vendor/js/wow.min.js")}}"></script>
<!-- Slick Carousel js -->
<script src="{{asset("frontend/assets/vendor/js/slick.min.js")}}"></script>
<!-- Owl Carousel-2 js -->
<script src="{{asset("frontend/assets/vendor/js/owl.carousel.min.js")}}"></script>
<!-- Magnific popup js -->
<script src="{{asset("frontend/assets/vendor/js/jquery.magnific-popup.min.js")}}"></script>
<!-- Isotope js -->
<script src="{{asset("frontend/assets/vendor/js/isotope.pkgd.min.js")}}"></script>
<!-- Imagesloaded js -->
<script src="{{asset("frontend/assets/vendor/js/imagesloaded.pkgd.min.js")}}"></script>
<!-- Mixitup js -->
<script src="{{asset("frontend/assets/vendor/js/jquery.mixitup.min.js")}}"></script>
<!-- Countdown -->
<script src="{{asset("frontend/assets/vendor/js/jquery.countdown.min.js")}}"></script>
<!-- Counterup -->
<script src="{{asset("frontend/assets/vendor/js/jquery.counterup.min.js")}}"></script>
<!-- Waypoints -->
<script src="{{asset("frontend/assets/vendor/js/waypoints.min.js")}}"></script>
<!-- Barrating -->
<script src="{{asset("frontend/assets/vendor/js/jquery.barrating.min.js")}}"></script>
<!-- Jquery-ui -->
<script src="{{asset("frontend/assets/vendor/js/jquery-ui.min.js")}}"></script>
<!-- Venobox -->
<script src="{{asset("frontend/assets/vendor/js/venobox.min.js")}}"></script>
<!-- Nice Select js -->
<script src="{{asset("frontend/assets/vendor/js/jquery.nice-select.min.js")}}"></script>
<!-- ScrollUp js -->
<script src="{{asset("frontend/assets/vendor/js/scrollUp.min.js")}}"></script>

{{--Notify--}}
<script src="{{ asset('admin/assets/js/shop/notify.js') }}"></script>


<!-- Main/Activator js -->
<script src="{{asset("frontend/assets/vendor/js/main.js")}}"></script>

<script
    src="{{asset("admin/assets/js/layout/app.js")}}"
    type="module"></script>

@stack("js")

</body>

<!-- index30:23-->
</html>
