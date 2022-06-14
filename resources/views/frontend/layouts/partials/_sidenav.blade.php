<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu @yield('admin_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Admin</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="pcoded-hasmenu @yield('salesman_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Salesman</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_salesman_active')">
                                    <a href="{{ route('salesmans.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Salesman') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('dealer_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Dealer</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_dealer_active')">
                            <a href="{{ route('dealers.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('retailer_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Retailer</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_retailer_active')">
                            <a href="{{ route('retailers.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Item</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_item_active')">
                            <a href="{{ route('items.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Item') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
