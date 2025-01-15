<div class="iq-sidebar sidebar-default">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('flowers') }}" class="header-logo">
            <img src="../assets/images/logo.png" class="img-fluid rounded-normal light-logo" alt="logo" />
            <h5 class="logo-title light-logo">Pollen Catalog</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-2">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ route('flowers') }}" class="svg-icon">
                        <svg class="svg-icon" id="p-dash1" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="ml-4">Loài Hoa</span>
                    </a>
                </li>
                <li class="{{ request()->is('danh-sach-bo') || request()->is('danh-sach-ho') || request()->is('danh-sach-chi') ? 'active' : '' }}">
                    <a href="#cauhinhhoa" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash3" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="ml-4">Bộ - Họ - Chi</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="cauhinhhoa"
                        class="iq-submenu collapse {{ request()->is('danh-sach-bo') || request()->is('danh-sach-ho') || request()->is('danh-sach-chi') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->is('danh-sach-bo') ? 'active' : '' }}">
                            <a href="{{ route('Bo') }}">
                                <i class="las la-minus"></i><span>Bộ</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('danh-sach-ho') ? 'active' : '' }}">
                            <a href="{{ route('Ho') }}">
                                <i class="las la-minus"></i><span>Họ</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('danh-sach-chi') ? 'active' : '' }}">
                            <a href="{{ route('Chi') }}">
                                <i class="las la-minus"></i><span>Chi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('danh-sach-be-mat') || request()->is('danh-sach-khau-do') || request()->is('danh-sach-phan') || request()->is('danh-sach-model') ? 'active' : '' }}">
                    <a href="#cauhinhdacdiem" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash3" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="ml-4">Cấu Hình Hoa</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="cauhinhdacdiem"
                        class="iq-submenu collapse {{ request()->is('danh-sach-be-mat') || request()->is('danh-sach-khau-do') || request()->is('danh-sach-phan') || request()->is('danh-sach-model') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->is('danh-sach-be-mat') ? 'active' : '' }}">
                            <a href="{{ route('BeMat') }}">
                                <i class="las la-minus"></i><span>Bề Mặt</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('danh-sach-khau-do') ? 'active' : '' }}">
                            <a href="{{ route('KhauDo') }}">
                                <i class="las la-minus"></i><span>Khẩu Độ</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('danh-sach-phan') ? 'active' : '' }}">
                            <a href="{{ route('Phan') }}">
                                <i class="las la-minus"></i><span>Phần</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('danh-sach-model') ? 'active' : '' }}">
                            <a href="{{ route('Model') }}">
                                <i class="las la-minus"></i><span>Model Train</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('tai-khoan-he-thong') || request()->is('tai-khoan-quan-tri') ? 'active' : '' }}">
                    <a href="#people" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash8" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">Tài Khoản</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="people"
                        class="iq-submenu collapse"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->is('tai-khoan-quan-tri') ? 'active' : '' }}">
                            <a href="{{ route('AdminList') }}">
                                <i class="las la-minus"></i><span>TK Quản Trị</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('tai-khoan-he-thong') ? 'active' : '' }}">
                            <a href="{{ route('SupperAdminList') }}">
                                <i class="las la-minus"></i><span>Tài Khoản Hệ Thống</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
