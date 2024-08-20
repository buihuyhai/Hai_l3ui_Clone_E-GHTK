@foreach ($orders as $order)
    @include('Product::frontend.components.order.card')
@endforeach
<div class="col-md-12 mb-20">
        {!! $orders->links() !!}
</div>
