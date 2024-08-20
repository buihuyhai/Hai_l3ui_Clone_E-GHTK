<aside
    id="sidebar"
    class="sidebar">

    <ul
        class="sidebar-nav"
        id="sidebar-nav">


        <li class="nav-item">
            <a
                class="nav-link "
                href="{{ route('dashboard.admin.index') }}">
                <i class="bi bi-grid"></i>
                <span>Trang Chủ</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->


        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="{{ route('user.admin.index') }}">
                <i class="bi bi-person-lines-fill"></i>
                <span>Tất cả</span>
            </a>
        </li>


        @if(Auth::user()->hasPermissionTo('manage_customer'))
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    data-bs-target="#manage-user"
                    data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-people"></i>
                    <span>Quản lý người dùng</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="manage-user"
                    class="nav-content collapse "
                    data-bs-parent="#sidebar-nav">
                    @if(Auth::user()->hasPermissionTo('view_customer'))
                        <li>
                            <a href="{{ route('user.admin.customer.index') }}">
                                <i class="bi bi-circle"></i><span>Danh sách người dùng</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if(Auth::user()->hasPermissionTo('manage_vendor'))
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    data-bs-target="#manage-vendor"
                    data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-people-fill"></i>
                    <span>Quản lý người bán</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="manage-vendor"
                    class="nav-content collapse "
                    data-bs-parent="#sidebar-nav">
                    @if(Auth::user()->hasPermissionTo('view_vendor'))
                        <li>
                            <a href="{{ route('user.admin.vendor.index') }}">
                                <i class="bi bi-circle"></i><span>Danh sách người bán</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if(Auth::user()->hasPermissionTo('manage_admin'))
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    data-bs-target="#manage-admin"
                    data-bs-toggle="collapse"
                    href="#">
                    <i class="bx bxs-user"></i>
                    <span>Quản lý người quản trị</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="manage-admin"
                    class="nav-content collapse "
                    data-bs-parent="#sidebar-nav">
                    @if(Auth::user()->hasPermissionTo('view_admin'))
                        <li>
                            <a href="{{ route('user.admin.admin.index') }}">
                                <i class="bi bi-circle"></i><span>Danh sách người quản trị</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->hasPermissionTo('create_admin'))
                        <li>
                            <a href="{{ route('user.admin.admin.create') }}">
                                <i class="bi bi-circle"></i><span>Thêm người quản trị</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->hasPermissionTo('manage_role'))
                        @if(Auth::user()->hasPermissionTo('view_role'))
                            <li>
                                <a href="{{ route('auth.admin.role.index') }}">
                                    <i class="bi bi-circle"></i><span>Vai trò</span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->hasPermissionTo('view_permission'))
                            <li>
                                <a href="{{ route('auth.admin.permission.matrix') }}">
                                    <i class="bi bi-circle"></i><span>Phân quyền</span>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif

        @if(Auth::user()->hasPermissionTo('manage_shop'))
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    data-bs-target="#manage-shop"
                    data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-shop"></i>
                    <span>Quản lý Shop</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="manage-shop"
                    class="nav-content collapse "
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route("user.admin.shop.index")}}">
                            <i class="bi bi-circle"></i><span>Danh sách các Shop</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route("user.admin.shop.unconfirmed")}}">
                            <i class="bi bi-circle"></i><span>Xác nhận Shop</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif


        @if(Auth::user()->hasPermissionTo('manage_promotion'))
            {{-- Haibh7 --}}
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    href="{{ route('coupon.admin.index') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Quản lý khuyến mãi</span>
                </a>
            </li>
        @endif
    </ul>

</aside>
<!-- End Sidebar-->
