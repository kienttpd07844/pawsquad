<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/clients/images/logo/fav.png') }}" width="28" height="28">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">{{ env('APP_NAME') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ Route::is('admin.home') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}" class=" menu-link">
                <i class="menu-icon tf-icons ti ti-mail"></i>
                <div>Thống kê</div>
                <div class="badge bg-danger rounded-pill ms-auto">5</div>
            </a>
        </li>

        <li class="menu-header small">
            <span class="menu-header-text">Quản lý</span>
        </li>

        <li class="menu-item {{ Route::is(['admin.variations-values.*','admin.variations.*','admin.brands.*','admin.category.*','admin.attributes_sets.*','admin.attributes.*']) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-truck"></i>
                <div>Sản phẩm</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item" style="">
                    <a href="" class="menu-link">
                        <div>Danh sách Sản phẩm</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.category.*') ? 'active open' : '' }}">
                    <a href="{{ route('admin.category.index') }}" class="menu-link">
                        <div>Danh mục</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.brands.*') ? 'active open' : '' }}">
                    <a href="{{ route('admin.brands.index') }}" class="menu-link">
                        <div>Nhãn hàng</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is(['admin.variations.*','admin.variations-values.*']) ? 'active open' : '' }}" style="">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div>Biến thể</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Route::is('admin.variations.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.variations.index') }}" class="menu-link">
                                <div>Nhóm biến thể</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Route::is('admin.variations-values.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.variations-values.index') }}" class="menu-link">
                                <div>Giá trị biến thể</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ Route::is(['admin.attributes_sets.*','admin.attributes.*']) ? 'active open' : '' }}" style="">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div>Thuộc tính</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Route::is('admin.attributes_sets.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.attributes_sets.index') }}" class="menu-link">
                                <div>Nhóm thuộc tính</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Route::is('admin.attributes.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.attributes.index') }}" class="menu-link">
                                <div>Thuộc tính</div>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>

    </ul>
</aside>
