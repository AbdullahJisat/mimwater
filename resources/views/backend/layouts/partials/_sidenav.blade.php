<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu">
                    <a href="{{ url(getAuthType().'/dashboard') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

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

                        <li class="pcoded-hasmenu @yield('admin_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Admin</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_admin_active')">
                                    <a href="{{ route('admins.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Admin') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="pcoded-hasmenu @yield('manager_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Manager</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_manager_active')">
                                    <a href="{{ route('managers.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Manager') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="pcoded-hasmenu @yield('role_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Role Permission</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_role_active')">
                                    <a href="{{ route('admin.role.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Role Permission') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('loan_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">PT Cash</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_loan_active')">
                            <a href="{{ route('loans.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View PT Cash') }}</span>
                            </a>
                        </li>
                        <li class="@yield('view_loan_active')">
                            <a href="{{ route('loans.pay_index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('Pay PT Cash') }}</span>
                            </a>
                        </li>
                        {{-- <li class="@yield('view_dailyCashHand_active')">
                            <a href="{{ route('cash_in_hand') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('Daily Cash Hand') }}</span>
                            </a>
                        </li> --}}
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
                                <span class="pcoded-mtext">Gallery</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_gallery_active')">
                                    <a href="{{ route('galleries.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Gallery') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="pcoded-hasmenu @yield('gallery_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Production Facilities</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_gallery_active')">
                                    <a href="{{ route('production-facilities.index') }}"
                                        class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Production Facilities') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="pcoded-hasmenu @yield('newsEvents_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">News Events</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_newsEvents_active')">
                                    <a href="{{ route('news-events.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View News Events') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="pcoded-hasmenu @yield('clientReview_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Client Review</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_clientReview_active')">
                                    <a href="{{ route('client-reviews.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Client Review') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="pcoded-hasmenu @yield('client_active')">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Client </span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="@yield('view_client_active')">
                                    <a href="{{ route('clients.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">{{ __('View Client') }}</span>
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
                            <a href="{{ route('admin_retailers') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('dealer_request_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Dealer Request</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_dealer_request_active')">
                            <a href="{{ route('dealer_request') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Request') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
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
                                <span class="pcoded-mtext">{{ __('View Cost') }}</span>
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

                @elseif (Auth::guard('salesman')->check())
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
                @elseif (Auth::guard('dealer')->check())
                <li class="pcoded-hasmenu @yield('request_bottle_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Request Bottle</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('dealer.request_bottles.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Request Bottle') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @else
                @endif
                @auth('salesman')
                <li class="pcoded-hasmenu @yield('request_bottle_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Stock Retailer</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ url('retailer-stock-items') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Stock') }}</span>
                            </a>
                        </li>
                        {{-- <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('admin.index_stockOut_retailer') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Stock Out') }}</span>
                            </a>
                        </li> --}}
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
                            <a href="{{ route('retailer_dues') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Due Report') }}</span>
                            </a>
                        </li>
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('retailer_cashes') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Cash Report') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endauth
                @auth('admin')
                <li class="pcoded-hasmenu @yield('statement_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Report</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_report_active')">
                            <a href="{{ route('get_report') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Income Expense Report') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_report_active')">
                            <a href="{{ url('income-report') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Income Report') }}</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('daily-dealer-statements') ? 'active' : '' }}">
                            <a href="{{ url('daily-dealer-statements') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Daily Statement') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_report_active')">
                            <a href="{{ url('statements-form') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Statements') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_report_active')">
                            <a href="{{ url('retailer-statements-form') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Statements') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('invoices.dues') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Due Report') }}</span>
                            </a>
                        </li>
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('invoices.cashes') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Cash Report') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('invoices.dealer_dues') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Due Report') }}</span>
                            </a>
                        </li>
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('invoices.dealer_cashes') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Cash Report') }}</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('request_bottle_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Stock Dealer</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ url('admin/dealer-stock-items') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Stock') }}</span>
                            </a>
                        </li>
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('admin.index_stockOut_dealer') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Stock Out') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('request_bottle_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Stock Retailer</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ url('admin/retailer-stock-items') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Stock') }}</span>
                            </a>
                        </li>
                        {{-- <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('admin.index_stockOut_retailer') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Stock Out') }}</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="pcoded-hasmenu @yield('message_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Message</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_message_active')">
                            <a href="{{ route('contacts.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Messages') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endauth

                @auth('dealer')
                <li class="pcoded-hasmenu @yield('request_bottle_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Report Dealer</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('dealer.invoices.dues_report') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Dues Report') }}</span>
                            </a>
                        </li>
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('dealer.invoices.cash_report') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Cash Report') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endauth
                @auth('retailer')
                <li class="pcoded-hasmenu @yield('request_bottle_item_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Report retailer</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('retailer.invoices.dues_report') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Dues Report') }}</span>
                            </a>
                        </li>
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('retailer.invoices.cash_report') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Cash Report') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endauth
                @auth('manager')
                <li class="pcoded-hasmenu @yield('statement_active')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-list"></i>
                        </span>
                        <span class="pcoded-mtext">Report</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="@yield('view_report_active')">
                            <a href="{{ route('get_report') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Income Expense Report') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_report_active')">
                            <a href="{{ url('income-report') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Income Report') }}</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('daily-dealer-statements') ? 'active' : '' }}">
                            <a href="{{ url('daily-dealer-statements') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Daily Statement') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_report_active')">
                            <a href="{{ url('statements-form') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Statements') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_report_active')">
                            <a href="{{ url('retailer-statements-form') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Statements') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('invoices.dues') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Due Report') }}</span>
                            </a>
                        </li>
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('invoices.cashes') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Retailer Cash Report') }}</span>
                            </a>
                        </li>

                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('invoices.dealer_dues') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Due Report') }}</span>
                            </a>
                        </li>
                        <li class="@yield('view_request_bottle_item_active')">
                            <a href="{{ route('invoices.dealer_cashes') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">{{ __('View Dealer Cash Report') }}</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
