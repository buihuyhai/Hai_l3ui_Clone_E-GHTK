<header
    id="header"
    class="header fixed-top d-flex align-items-center">

    @php
        $routeHome = "/";

        if (Auth::user()->hasRole(\Modules\Auth\Hooks\RoleHook::ADMIN) ||
        Auth::user()->hasRole(\Modules\Auth\Hooks\RoleHook::SUPER_ADMIN)) {
            $routeHome = route("dashboard.admin.index");
        }
    @endphp

    <div class="d-flex align-items-center justify-content-between">
        <a
            href="{{$routeHome}}"
            class="logo d-flex align-items-center">
            <img
                src="https://giaohangtietkiem.vn/wp-content/themes/giaohangtk/images/logo-header.png"
                alt="">
            <span class="d-none d-lg-block"></span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            @if(Auth::check())

                <li class="nav-item dropdown pe-3">

                    <a
                        class="nav-link nav-profile d-flex align-items-center pe-0"
                        href="#"
                        data-bs-toggle="dropdown">
                        <img
                            src="{{asset("storage/".Auth::user()?->avatar)}}"
                            alt="Profile"
                            class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()?->name}}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a
                                class="dropdown-item d-flex align-items-center"
                                href="{{route("profile.index")}}">
                                <i class="bi bi-person"></i>
                                <span>Thông tin cá nhân</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a
                                class="dropdown-item d-flex align-items-center"
                                href="{{route("setting.index")}}">
                                <i class="bi bi-gear"></i>
                                <span>Cài đặt</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        @php
                            $routeLogout = route("logout");

                            if (Auth::user()->hasRole(\Modules\Auth\Hooks\RoleHook::ADMIN) || Auth::user()->hasRole
                            (\Modules\Auth\Hooks\RoleHook::SUPER_ADMIN)) {
                                $routeLogout = route("auth.admin.logout");
                            }
                        @endphp

                        <li>
                            <a
                                class="dropdown-item d-flex align-items-center"
                                href="{{ $routeLogout }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit()"
                            >
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Đăng xuất</span>
                            </a>

                            <form
                                id="logout-form"
                                method="POST"
                                class="d-none"
                                action="{{ $routeLogout }}">
                                @csrf
                            </form>

                        </li>

                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            @endif
        </ul>
    </nav>
    <!-- End Icons Navigation -->
</header>
<!-- End Header -->
