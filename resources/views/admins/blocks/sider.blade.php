<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a class='logo logo-light' href='{{route('admins.thongke')}}'>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/admin/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/admin/assets/images/logo-light.png') }}" alt=""
                            height="24">
                    </span>
                </a>
                <a class='logo logo-dark' href='{{route('admins.thongke')}}'>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/admin/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/admin/assets/images/logo-dark.png') }}" alt=""
                            height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Quản trị hệ thống</li>
                <li>
                    <a href="{{ route('admins.danhmucs.index') }}">
                        <i data-feather="folder"></i>
                        <span> Danh mục </span>

                    </a>

                    <a href="{{ route('admins.sanphams.index') }}">
                        <i data-feather="list"></i>
                        <span> Sản phẩm </span>
                    </a>
                    <a href="{{ route('admins.baiviets.index') }}">
                        <i data-feather="list"></i>
                        <span> bài viết </span>
                    </a>
                    <a href="{{ route('admins.nguoidungs.index') }}">
                        <i data-feather="users"></i>
                        <span> Người dùng </span>
                    </a>
                    <a href="{{ route('admins.donhangs.index') }}">
                        <i data-feather="shopping-cart"></i>
                        <span> Đơn hàng </span>
                    </a>
                    <a href="{{ route('admins.khuyenmais.index') }}">
                        <i data-feather="folder"></i>
                        <span> Khuyến mại </span>

                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
