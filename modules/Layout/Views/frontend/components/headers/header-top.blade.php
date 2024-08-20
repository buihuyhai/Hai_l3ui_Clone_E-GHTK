<div class="header-top">
    <div class="container">
        <div class="row">
            <!-- Begin Header Top Left Area -->
            <div class="col-lg-6 col-md-4">
                <div class="header-top-left">
                    <ul class="phone-wrap">
                        <li>
                            @if(Auth::check())
                                @if(Auth::user()->shop()->first())
                                    <a href="{{route("shops.dashboard")}}">Kênh người bán |</a>
                                @elseif(Auth::user()->hasRole(\Modules\Auth\Hooks\RoleHook::CUSTOMER))
                                    <a href="{{route("vendor.active-now")}}">Đăng ký trở thành người bán |</a>
                                @endif
                            @endif
                            <span>Hỗ trợ: </span><a href="#">0989898989</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Header Top Left Area End Here -->
            <!-- Begin Header Top Right Area -->
            <div class="col-lg-6 col-md-8">
                <div class="header-top-right">
                    <ul class="ht-menu">
                        @if(Auth::check())
                            <li>
                                <a href="/order/list" class="text-dark"><span>Đơn mua</span></a>
                            </li>
                            <!-- Begin Setting Area -->
                            <li>
                                <div class="ht-setting-trigger" id="top-header-menu-setting"><span>Cài đặt</span></div>
                                <div class="setting ht-setting">
                                    <ul class="ht-setting-list">
                                        <li><a href="{{route("profile.index")}}">Tài khoản</a></li>
                                        @if(Auth::user()->hasAnyRole([RoleHook::ADMIN, RoleHook::SUPER_ADMIN]))
                                            <li><a href="{{route("dashboard.admin.index")}}">Trang quản trị</a></li>
                                        @endif
                                        <li><a
                                                href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit()"
                                            >Đăng xuất</a></li>
                                        <form
                                            id="logout-form"
                                            method="POST"
                                            class="d-none"
                                            action="{{ route('logout') }}">
                                            @csrf
                                        </form>
                                    </ul>
                                </div>
                            </li>
                            <!-- Setting Area End Here -->

                        @else
                            <a
                                href="{{route("login")}}"
                                class="mt-0 mr-3 text-center">Đăng nhập
                            </a>|
                            <a
                                href="{{route("register")}}"
                                class=" mt-0 ml-3 d-block text-center">Đăng ký
                            </a>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- Header Top Right Area End Here -->
        </div>
    </div>
</div>
