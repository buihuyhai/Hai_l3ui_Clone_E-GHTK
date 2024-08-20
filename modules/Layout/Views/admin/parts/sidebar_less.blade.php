<aside
    id="sidebar"
    class="sidebar">

    <ul
        class="sidebar-nav"
        id="sidebar-nav">

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="/">
                <i class="bi bi-grid"></i>
                <span>Trang Chủ</span>
            </a>
        </li>

        <li class="nav-item">
            <a
                class="nav-link collapsed "
                href="{{route("profile.index")}}">
                <i class="bi bi-person"></i>
                <span>Thông tin cá nhân</span>
            </a>
        </li>

        <li class="nav-item">
            <a
                class="nav-link collapsed "
                href="{{route("setting.index")}}">
                <i class="bi bi-gear"></i>
                <span>Cài đặt</span>
            </a>
        </li>

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                        document.getElementById('logout-form-less').submit()"
            >
                <i class="bi bi-box-arrow-right"></i>
                <span>Đăng xuất</span>
            </a>

            <form
                id="logout-form-less"
                method="POST"
                class="d-none"
                action="{{ route('logout') }}">
                @csrf
            </form>

        </li>


    </ul>

</aside>
<!-- End Sidebar-->
