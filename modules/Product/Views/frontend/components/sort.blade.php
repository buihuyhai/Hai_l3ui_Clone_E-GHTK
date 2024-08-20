<div class="mb-20">
    <div class="shop-product-sort row">
        <label class="text-nowrap m-0">Sắp xếp theo:</label>
        <div class="product-sort col-md-3">
            <select class="nice-select" id="order-by">
                <option value="latest">Mới nhất</option>
                <option value="price-asc">Giá (Thấp &gt; Cao)</option>
                <option value="price-desc">Giá (Cao &gt; Thấp)</option>
                <option value="rating">Đánh giá</option>
                <option value="selling">Bán chạy</option>
            </select>
        </div>

        <label for="" class="text-nowrap m-0">Chọn khoảng giá:</label>
        <div class="product-sort col-md-3">
            <select class="nice-select" id="price-range">
                <option value="-">Tất cả</option>
                <option value="0-1000000">Dưới 1 triệu</option>
                <option value="1000000-5000000">Từ 1 đến 5 triệu</option>
                <option value="5000000-">Trên 5 triệu</option>
            </select>
        </div>

    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#order-by').on('change', function() {
                $('#filter-order-by').val($(this).val());
                $('#frmFilter').submit();
            });
            $('#price-range').on('change', function() {
                const range = $('#price-range').val().split("-");
                $('#filter_min_price').val(range[0]);
                $('#filter_max_price').val(range[1]);
                $('#frmFilter').submit();
            })
        });
        
    </script>
@endpush
