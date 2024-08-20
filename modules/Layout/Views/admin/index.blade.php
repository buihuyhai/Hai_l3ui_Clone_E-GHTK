<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta
        content="width=device-width, initial-scale=1.0"
        name="viewport">

    <title>{{__("G-Ecommerce")}}</title>
    <meta
        content=""
        name="description">
    <meta
        content=""
        name="keywords">

    <!-- Favicons -->
    <link
        href="{{asset("admin/assets/img/favicon.png")}}"
        rel="icon">
    <link
        href="{{asset("admin/assets/img/apple-touch-icon.png")}}"
        rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.gstatic.com"
        rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    {{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

    <!-- Vendor CSS Files -->
    <link
        href="{{asset("admin/assets/vendor/bootstrap/css/bootstrap.min.css")}}"
        rel="stylesheet">
    <link
        href="{{asset("admin/assets/vendor/bootstrap-icons/bootstrap-icons.css")}}"
        rel="stylesheet">
    <link
        href="{{asset("admin/assets/vendor/boxicons/css/boxicons.min.css")}}"
        rel="stylesheet">
    <link
        href="{{asset("admin/assets/vendor/quill/quill.snow.css")}}"
        rel="stylesheet">
    <link
        href="{{asset("admin/assets/vendor/quill/quill.bubble.css")}}"
        rel="stylesheet">
    <link
        href="{{asset("admin/assets/vendor/remixicon/remixicon.css")}}"
        rel="stylesheet">
    <link
        href="{{asset("admin/assets/vendor/simple-datatables/style.css")}}"
        rel="stylesheet">
    <script src="{{asset("admin/assets/vendor/jquery/jquery.js")}}"></script>
    <script
        src="https://cdn.tiny.cloud/1/v1wvkm3nr87bqq8scwj77v5decfhzbqjrk1hko8t0rq75uty/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#nhuandt3-text-editor',
        });
    </script>

    <!-- Template Main CSS File -->
    <link
        href="{{asset("admin/assets/css/style.css")}}"
        rel="stylesheet">

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

@yield("body")


<!-- Vendor JS Files -->
<script src="{{asset("admin/assets/vendor/apexcharts/apexcharts.min.js")}}"></script>
<script src="{{asset("admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("admin/assets/vendor/chart.js/chart.umd.js")}}"></script>
<script src="{{asset("admin/assets/vendor/echarts/echarts.min.js")}}"></script>
<script src="{{asset("admin/assets/vendor/quill/quill.js")}}"></script>
<script src="{{asset("admin/assets/vendor/simple-datatables/simple-datatables.js")}}"></script>
<script src="{{asset("admin/assets/vendor/tinymce/tinymce.min.js")}}"></script>
<script src="{{asset("admin/assets/vendor/php-email-form/validate.js")}}"></script>

<!-- Template Main JS File -->
<script src="{{asset("admin/assets/js/main.js")}}"></script>
<script src="{{asset("admin/assets/js/app.js")}}"></script>

<script
    src="{{asset("admin/assets/js/layout/app.js")}}"
    type="module"></script>

@stack("js")

</body>

</html>
