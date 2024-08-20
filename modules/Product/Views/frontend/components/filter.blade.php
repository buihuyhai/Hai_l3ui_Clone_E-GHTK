<div class="col-md-2 pt-25 pl-0 mr-0 filter-tab">
    <p class="title text-dark">Danh mục sản phẩm</p>
    <ul class="category-list">
        @foreach ($categories as $category)
            @if ($category->products->count() > 0)
                <div class="d-flex align-items-center mb-10">
                    <input class="category-checkbox" name="categories"
                        @if (in_array($category->id, explode(',', $q_categories))) checked="checked" @endif id="ct" type="checkbox"
                        value="{{ $category->id }}" onchange="filterProductsByCategories()">
                    <p class="mb-0 text-dark"><span>{{ $category->name }}</span><span>({{ $category->products_count }})</span></p>
                </div>
            @endif
        @endforeach
    </ul>

</div>
