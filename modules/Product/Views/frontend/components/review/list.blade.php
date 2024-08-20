@foreach ($reviews as $review)
    @include('Product::frontend.components.review.card')
@endforeach
{{ $reviews->links() }}
