<div class="app-sidebar sidebar-shadow">

    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ route('admin.home') }}" class="@yield('admin_home_active')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.adminUser.index') }}" class="@yield('admin_index_active')">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Admin User Management
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.user.index') }}" class="@yield('user_index_active')">
                        <i class="metismenu-icon pe-7s-users"></i>
                         User Management
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.wallet.index') }}" class="@yield('wallet_index_active')">
                        <i class="metismenu-icon pe-7s-wallet"></i>
                       User Wallet
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>