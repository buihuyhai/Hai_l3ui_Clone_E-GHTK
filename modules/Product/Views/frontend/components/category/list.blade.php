<div class="bg-white mb-10 row mt-10 category-list" style="margin: auto">
    <div class="col-12">
        <p class="title mb-0 pt-15 pb-15 text-dark">DANH MỤC</p>
    </div>
    <div class="owl-carousel owl-theme">
        @foreach ($categories->chunk(2) as $chunk)
            <div class="item col-md-12 d-flex flex-column">
                @foreach ($chunk as $category)
                    <div class="border carder col-12 pt-30 pb-30">
                        <a href="/category/{{ $category->slug }}"
                            class="d-flex flex-column justify-content-center align-items-center">
                            <div class="category-img-container mb-10">
                                <img src="/storage/{{$category->thumbnail}}" alt="Broken Image">
                            </div>
                            <div class="unit-content m-1">
                                <div class="text-dark">
                                    {{ $category->name }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@push('css')
    <style>


    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                items: 7,
                loop: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 7
                    }
                }
            });
            owl.trigger('play.owl.autoplay', [1000])
        });
    </script>
@endpush
