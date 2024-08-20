<div class="col-12 d-flex review-card">
    <div class="col-1 pr-0 d-flex justify-content-end">
        <div class="user-avatar mt-2">
            <img src="{{$review->user->avatar}}" alt="Image">
        </div>
    </div>
    <div class="col-10">
        <p class="customer-name">{{$review->user->name}}</p>
        <div class="stars-outer">
            <div class="stars-inner" style="width:{{ ($review->rating / 5) * 100 }}%;"></div>
        </div>
        <p class="date-and-variant">{{$review->created_at}} | Phân loại sản phẩm: {{$review->variant->name}}</p>
        <p class="comment">{{$review->comment}}</p>
    </div>
</div>