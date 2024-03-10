<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
{{--                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">--}}
                <h3 style="color: #ffffff; font-size: 30px; padding: 5px">{{ config('app.name') }}</h3>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
{{--                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="17">--}}
                <h3 style="color: #ffffff; font-size: 30px; padding: 5px">{{ config('app.name') }}</h3>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
<?php
//     $userId = auth()->user()->id;
//     $roleId = DB::table('role_user')->where('user_id',$userId)->pluck('role_id')->first();
//     $rolePermission = DB::table('role_has_permissions')->where('role_id',$roleId)->pluck('permission_id')->all();
//     $permissionList = DB::table('permissions')->whereIn('id',$rolePermission)->pluck('name')->all();
//?>
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
              <!-- <li class="menu-title"><span>@lang('translation.menu')</span></li> -->
                @can('dashboard')
                <li class="nav-item">
                  <a class="nav-link menu-link " href="{{ route('root') }}">
                      <i class="ri-dashboard-2-line"></i> <span>@lang('translation.dashboards')</span>
                  </a>
                </li>
                @endcan
                <!-- <li class="nav-item"> -->
                    <!-- <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span>@lang('translation.dashboards')</span>
                    </a> -->
                    <!-- @can('admin-dashboard')
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span>Admin Dashboard</span>
                    </a>
                    @endcan -->
                <!-- </li> -->
                <li class="nav-item">
                    @can('user-management')
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-admin-line"></i> <span>User Management</span>
                    </a>
                    @endcan
                    <div class="collapse menu-dropdown {{ request()->is('user_management/*') ? 'show' : '' }}" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            @can('user-list')
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('user_management/users') || request()->is('user_management/users/*') ? 'active' : '' }}">Users</a>
                            </li>
                            @endcan
                            @can('role-list')
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('user_management/roles') || request()->is('user_management/roles/*') ? 'active' : '' }}">Roles</a>
                            </li>
                                @endcan
                            @can('permission-list')
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link {{ request()->is('user_management/permissions') || request()->is('user_management/permissions/*') ? 'active' : '' }}">Permissions</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
               
                <li class="nav-item">
                    @can('product-management')
                    <a class="nav-link menu-link" href="#productManagePages" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="productManagePages">
                        <i class="ri-shopping-basket-line"></i> <span>Products</span>
                    </a>
                    @endcan
                    <div class="collapse menu-dropdown {{ request()->is('product_management/*') ? 'show' : '' }}" id="productManagePages">
                        <ul class="nav nav-sm flex-column">
                            @can('product-list')
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link {{ request()->is('product_management/product') || request()->is('user_management/product/*') ? 'active' : '' }}">List</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                  <a class="nav-link menu-link {{ request()->is('leads') ||  request()->is('leads/*') ? 'active' : '' }}" href="{{ route('leads.index') }}">
                      <i class="ri-contacts-line"></i> <span>Leads</span>
                  </a>
                </li>

                <li class="nav-item">
                    @can('sale-management')
                    <a class="nav-link menu-link" href="#salesManagePages" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="salesManagePages">
                        <i class="ri-shopping-cart-line"></i> <span>Sales</span>
                    </a>
                    @endcan
                    <div class="collapse menu-dropdown {{ request()->is('sale_management/*') ? 'show' : '' }}" id="salesManagePages">
                        <ul class="nav nav-sm flex-column">
                            @can('customer-list')
                            <li class="nav-item">
                                <a href="{{ route('customer.index') }}" class="nav-link {{ request()->is('sale_management/customer') || request()->is('sale_management/customer/*') ? 'active' : '' }}">Customers</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown {{ request()->is('sale_management/*') ? 'show' : '' }}" id="salesManagePages">
                        <ul class="nav nav-sm flex-column">
                            @can('estimate-list')
                            <li class="nav-item">
                                <a href="{{ route('estimate.index') }}" class="nav-link {{ request()->is('sale_management/estimate') || request()->is('sale_management/estimate/*') ? 'active' : '' }}">Estimates</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown {{ request()->is('sale_management/*') ? 'show' : '' }}" id="salesManagePages">
                        <ul class="nav nav-sm flex-column">
                            @can('salesorder-list')
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link {{ request()->is('sale_management/orders') || request()->is('sale_management/orders/*') ? 'active' : '' }}">Orders</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown {{ request()->is('sale_management/*') ? 'show' : '' }}" id="salesManagePages">
                        <ul class="nav nav-sm flex-column">
                            @can('invoice-list')
                            <li class="nav-item">
                                <a href="{{ route('invoice.index') }}" class="nav-link {{ request()->is('sale_management/invoice') || request()->is('sale_management/invoice/*') ? 'active' : '' }}">Invoices</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    @can('purchase-management')
                    <a class="nav-link menu-link" href="#purchaseManagePages" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="purchaseManagePages">
                        <i class="ri-shopping-bag-line"></i> <span>Purchases</span>
                    </a>
                    @endcan
                    <div class="collapse menu-dropdown {{ request()->is('purchase_manage/*') ? 'show' : '' }}" id="purchaseManagePages">
                        <ul class="nav nav-sm flex-column">
                            @can('vendors-list')
                            <li class="nav-item">
                                <a href="{{ route('vendors.index') }}" class="nav-link {{ request()->is('purchase_manage/vendors') || request()->is('purchase_manage/vendors/*') ? 'active' : '' }}">Vendors</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown {{ request()->is('purchase_manage/*') ? 'show' : '' }}" id="purchaseManagePages">
                        <ul class="nav nav-sm flex-column">
                            @can('purchaseorder-list')
                            <li class="nav-item">
                                <a href="{{ route('purchaseorders.index') }}" class="nav-link {{ request()->is('purchase_manage/purchaseorders') || request()->is('purchase_manage/purchaseorders/*') ? 'active' : '' }}">Purchase Orders</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    @can('settings')
                    <a class="nav-link menu-link" href="#settingsManagePages" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="settingsManagePages">
                        <i class="ri-settings-3-line"></i> <span>Settings</span>
                    </a>
                    @endcan
                    <div class="collapse menu-dropdown {{ request()->is('settings/*') ? 'show' : '' }}" id="settingsManagePages">
                        <ul class="nav nav-sm flex-column">
                            @can('organization-list')
                            <li class="nav-item">
                                <a href="{{ route('settings.organization.index') }}" class="nav-link {{ request()->is('settings/organization') || request()->is('settings/organization/*') ? 'active' : '' }}">Organization Profile</a>
                            </li>
                            @endcan
                            @can('taxrates-list')
                            <li class="nav-item">
                                <a href="{{ route('settings.taxrates.index') }}" class="nav-link {{ request()->is('settings/taxrates') || request()->is('settings/taxrates/*') ? 'active' : '' }}">Tax Rates</a>
                            </li>
                            @endcan
                            @can('currency-list')
                            <li class="nav-item">
                                <a href="{{ route('settings.currency.index') }}" class="nav-link {{ request()->is('settings/currency') || request()->is('settings/currency/*') ? 'active' : '' }}">Currency</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
