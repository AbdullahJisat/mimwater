<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">
                @if (Auth::guard('admin')->check())
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
                <li class="pcoded-hasmenu @yield('admin_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Website Setting</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="pcoded-hasmenu @yield('director_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Director</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_director_active')">
                                    <a href="{{ route('directors.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Director') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="pcoded-hasmenu @yield('gallery_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">gallery</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_gallery_active')">
                                    <a href="{{ route('galleries.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Gallery') }}</span>
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
                @endif
                <li class="pcoded-hasmenu @yield('cost_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Cost</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_cost_active')">
                            <a href="{{ route('costs.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View cost') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Auth::guard('salesman')->check())
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
                <li class="pcoded-hasmenu @yield('stock_out_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Stock Out Item</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_stock_out_item_active')">
                            <a href="{{ route('stock-out-items.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Stock Out Item') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="pcoded-hasmenu @yield('stock_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Stock Item</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_stock_item_active')">
                            <a href="{{ route('stock-items.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Stock Item') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('request_bottle_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Request Bottle</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('request_bottles.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Request Bottle') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('request_bottle_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Report</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('invoices.dues') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Due Report') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
