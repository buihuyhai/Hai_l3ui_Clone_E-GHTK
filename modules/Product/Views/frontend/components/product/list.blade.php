@foreach ($products as $product)
    <div class="{{ $itemPerRow ?? 'col-5' }} mb-3 pl-5 pr-5">
        @include('Product::frontend.components.product.card')
    </div>
@endforeach
<div class="col-12 d-flex justify-content-center mb-10">
    @if ($products->isEmpty())
        <p class="text-danger">Không có sản phẩm phù hợp!</p>
    @endif
    {!! $products->links() !!}
</div>
