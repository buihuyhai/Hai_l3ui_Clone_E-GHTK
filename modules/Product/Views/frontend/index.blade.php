@extends('Layout::frontend.app')
@section('content')
    <div class="container">
            @include('Product::frontend.components.category.list')
            @include('Product::frontend.components.product.latest')
    </div>
@endsection
