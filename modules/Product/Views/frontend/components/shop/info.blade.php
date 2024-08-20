<div class="content-bg" style="padding-bottom: 0;; padding-top: 2rem">
    <div class="container d-flex">
        <div class="col-md-4 d-flex shop-card"
            style="background: linear-gradient(180deg, rgba(42,46,84,1) 0%, rgba(60,50,74,1) 100%);">
            <div class="d-flex">
                <div class="avatar-container">
                    <div class="avatarE">
                        <img src="{{ $shop->logo_url }}" alt="">
                    </div>
                </div>
                <div>
                    <h1 style="font-weight: 500; font-size: 1rem; margin-bottom: 1rem">{{ $shop->name }}</h1>
                    <p>{{ $shop->description }}</p>
                </div>
            </div>
            <div class="d-flex btn-cts">
                <div style="border: 1px solid rgba(255,255,255, .5);">Khám phá ngay</div>
                <div style="border: 1px solid rgba(255,255,255, .5);">Sản phẩm</div>
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column pl-50 pt-15 pb-15">
            <ul style="height: 100%" class="d-flex flex-column justify-content-between">
                <li><i class="fa fa-shopping-cart"></i>&emsp;Sản phẩm: <span style="color:#ff4b3a">10.000</span>
                </li>
                <li><i class="fa fa-star"></i>&emsp;Đánh giá: <span style="color:#ff4b3a">5 <i
                            class="fa fa-star checked"></i></span></li>
                <li><i class="fa fa-phone"></i>&emsp;Điện thoại: <span style="color:#ff4b3a">08 6612 31
                        58</span></li>
            </ul>
        </div>
        <div class="col-md-4 d-flex flex-column pt-15 pb-15">
            <ul style="height: 100%" class="d-flex flex-column justify-content-between">
                <li class="text-truncate"><i class="fa fa-shopping-cart"></i>&emsp;Địa chỉ: <span
                        style="color:#ff4b3a">{{ $shop->address }}</span>
                </li>
                <li><i class="fa fa-check-circle-o"></i>&emsp;Trạng thái: <span style="color:#ff4b3a">Hoạt
                        động</span></li>
                <li><i class="fa fa-user-plus"></i>&emsp;Tham gia: <span
                        style="color:#ff4b3a">{{ (int) Carbon\Carbon::parse($shop->created_at)->diffInMonths(Carbon\Carbon::now()) + 1 }}
                        tháng trước</li>
            </ul>
        </div>
    </div>
    <div class="container d-flex" style="margin-top:1rem;">
        <div class="col-md-2 pb-10 pt-10"
            style="font-size: 1rem;text-align: center; border-bottom: .2rem solid #ff4b3a">Tất cả sản phẩm</div>
    </div>
</div>
