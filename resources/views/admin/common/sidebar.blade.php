<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-info">
        <img src="{!! asset('admin/dist/img/AdminLTELogo.png') !!}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">QL Cửa Hàng Xe Máy</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        @php
            $admin = Auth::user();
        @endphp
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ !empty($admin->avatar) ? asset(pare_url_file($admin->avatar)) : asset('/admin/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{!! $admin->name !!}</a>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if($admin->can(['toan-quyen-quan-ly', 'truy-cap-website']))
                <li class="nav-item has-treeview">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa fa-home"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-cua-hang-xe']))
                <li class="nav-item">
                    <a href="{{ route('shop.index') }}" class="nav-link {{ isset($shop_active) ? $shop_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-cube"></i>
                        <p>Cửa hàng xe</p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-chi-nhanh-hoac-kho']))
                <li class="nav-item">
                    <a href="{{ route('branch.index') }}" class="nav-link {{ isset($branch_active) ? $branch_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-cubes"></i>
                        <p>Chi nhánh \ Kho</p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-hang-xe']))
                <li class="nav-item">
                    <a href="{{ route('trademark.index') }}" class="nav-link {{ isset($trademark_active) ? $trademark_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-ambulance"></i>
                        <p>Hãng xe</p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-dong-xe']))
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link {{ isset($category_active) ? $category_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-car"></i>
                        <p>Dòng xe</p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-nha-cung-cap']))
                <li class="nav-item">
                    <a href="{{ route('supplier.index') }}" class="nav-link {{ isset($supplier_active) ? $supplier_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-leaf"></i>
                        <p>Nhà cung cấp</p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-san-pham']))
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link {{ isset($product_active) ? $product_active : '' }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Sản phẩm</p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-khach-hang']))
                <li class="nav-item">
                    <a href="{{ route('customer.index') }}" class="nav-link {{ isset($customer_active) ? $customer_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-user"></i>
                        <p>Khách hàng</p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-nhap-kho', 'danh-sach-san-pham-da-nhap']))
                <li class="nav-item has-treeview {{ isset($import_active) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ isset($import_active) ? $import_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-download"></i>
                        <p>Nhập kho<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-nhap-kho']))
                        <li class="nav-item">
                            <a href="{{ route('warehouse.import.index') }}" class="nav-link {{ isset($import_warehouse) ? $import_warehouse : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Nhập</p>
                            </a>
                        </li>
                        @endif
                        @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-san-pham-da-nhap']))
                        <li class="nav-item">
                            <a href="{{ route('warehouse.import.products') }}" class="nav-link {{ isset($import_warehouse) ? $import_warehouse : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Sản phẩm đã nhập</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-xuat-kho', 'san-pham-da-xuat']))
                <li class="nav-item has-treeview {{ isset($export_active) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ isset($export_active) ? $export_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-upload"></i>
                        <p>Xuất kho<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-xuat-kho']))
                        <li class="nav-item">
                            <a href="{{ route('warehouse.export.index') }}" class="nav-link {{ isset($export_warehouse) ? $export_warehouse : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Xuất</p>
                            </a>
                        </li>
                        @endif
                        @if($admin->can(['toan-quyen-quan-ly', 'san-pham-da-xuat']))
                        <li class="nav-item">
                            <a href="{{ route('warehouse.export.products') }}" class="nav-link {{ isset($export_warehouse) ? $export_warehouse : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Sản phẩm đã xuất</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-ban-hang']))
                <li class="nav-item">
                    <a href="{{ route('selling.index') }}" class="nav-link {{ isset($selling_active) ? $selling_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-upload" aria-hidden="true"></i>
                        <p>Bán hàng</p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-thong-ke']))
                <li class="nav-item">
                    <a href="{{ route('statistical.index') }}" class="nav-link {{ isset($statistical_active) ? $statistical_active : '' }}">
                        <i class="nav-icon fas fa-chart-pie" aria-hidden="true"></i>
                        <p>Thống kê</p>
                    </a>
                </li>
                @endif

                {{--<li class="nav-item">--}}
                    {{--<a href="{{ route('group.permission.index') }}" class="nav-link {{ isset($group_permission) ? $group_permission : '' }}">--}}
                        {{--<i class="nav-icon fa fa-hourglass" aria-hidden="true"></i>--}}
                        {{--<p>Nhóm quyền</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a href="{{ route('permission.index') }}" class="nav-link {{ isset($permission_active) ? $permission_active : '' }}">--}}
                        {{--<i class="nav-icon fa fa-balance-scale"></i>--}}
                        {{--<p> Quyền </p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-vai-tro']))
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link {{ isset($role_active) ? $role_active : '' }}">
                        <i class="nav-icon fa fa-gavel" aria-hidden="true"></i>
                        <p> Vai trò </p>
                    </a>
                </li>
                @endif
                @if($admin->can(['toan-quyen-quan-ly', 'danh-sach-khach-hang']))
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ isset($user_active) ? $user_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-user" aria-hidden="true"></i>
                        <p> Người dùng </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('change.password') }}" class="nav-link {{ isset($change_password) ? $change_password : '' }}">
                        <i class="nav-icon fa fa-fw fa-lock" aria-hidden="true"></i>
                        <p> Đổi mật khẩu </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
