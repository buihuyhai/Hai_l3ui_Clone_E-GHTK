@extends('Layout::admin.index')

@section('body')
    <!-- ======= Header ======= -->
    @include('Layout::admin.parts.header')

    <!-- ======= Sidebar ======= -->
    @include('Layout::admin.parts.sidebar')

    <main id="main" class="main">

        <section class="section {{ $classes ?? '' }}">
            @yield('content')
        </section>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('Layout::admin.parts.footer')


    @include('Layout::admin.components.buttons.back-to-top')
@endsection
