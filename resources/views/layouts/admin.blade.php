<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Gereja Toraja Jemaat eben-Haezer Selili</title>
    <meta name="description" content="Church Management Dashboard" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}?v={{ time() }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}?v={{ time() }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}?v={{ time() }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}?v={{ time() }}" />

    <!-- Church Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/church-theme.css') }}?v={{ time() }}" />

    <!-- Page CSS -->
    @stack('styles')

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu sidebar-church">
                <div class="app-brand demo">
                    <a href="{{ route('dashboard') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="/images/church-icon.svg" alt="Church Logo" height="32">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold ms-2" style="color: #8B4513;">🔐 Admin</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
                    </a>
                </div>

                <div class="menu-divider mt-0"></div>
                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-smile"></i>
                            <div class="text-truncate">🏠 Dashboard</div>
                        </a>
                    </li>



                    <!-- Kelola Profil -->
                    <li class="menu-item {{ request()->routeIs('sejarah-gereja.*') || request()->routeIs('sejarah-jemaat.*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-book"></i>
                            <div class="text-truncate">📜 Kelola Profil</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->routeIs('sejarah-gereja.*') ? 'active' : '' }}">
                                <a href="{{ route('sejarah-gereja.index') }}" class="menu-link">
                                    <i class="bx bx-church me-2"></i>
                                    <div class="text-truncate">📜 Sejarah Gereja Toraja</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('sejarah-jemaat.*') ? 'active' : '' }}">
                                <a href="{{ route('sejarah-jemaat.index') }}" class="menu-link">
                                    <i class="bx bx-home-heart me-2"></i>
                                    <div class="text-truncate">🏛️ Sejarah Jemaat Selili</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('members.*') ? 'active' : '' }}">
                                <a href="{{ route('members.index') }}" class="menu-link">
                                    <i class="bx bx-group me-2"></i>
                                    <div class="text-truncate">👥 Anggota Jemaat</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Informasi -->
                    <li class="menu-item {{ request()->routeIs('pastors.*') || request()->routeIs('warta-mingguan.*') || request()->routeIs('program-kerja.*') || request()->routeIs('information.*') || request()->routeIs('worship-schedules.*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-info-circle"></i>
                            <div class="text-truncate">ℹ️ Informasi</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->routeIs('pastors.*') ? 'active' : '' }}">
                                <a href="{{ route('pastors.index') }}" class="menu-link">
                                    <i class="bx bx-user-circle me-2"></i>
                                    <div class="text-truncate">👨‍💼 Pendeta Jemaat</div>
                                </a>
                            </li>

                            <li class="menu-item {{ request()->routeIs('worship-schedules.*') ? 'active' : '' }}">
                                <a href="{{ route('worship-schedules.index') }}" class="menu-link">
                                    <i class="bx bx-time me-2"></i>
                                    <div class="text-truncate">⏰ Jadwal Ibadah</div>
                                </a>
                            </li>

                            <li class="menu-item {{ request()->routeIs('information.*') ? 'active' : '' }}">
                                <a href="{{ route('information.index') }}" class="menu-link">
                                    <i class="bx bx-calendar-event me-2"></i>
                                    <div class="text-truncate">🎉 Kegiatan Jemaat</div>
                                </a>
                            </li>

                            <li class="menu-item {{ request()->routeIs('warta-mingguan.*') ? 'active' : '' }}">
                                <a href="{{ route('warta-mingguan.index') }}" class="menu-link">
                                    <i class="bx bx-news me-2"></i>
                                    <div class="text-truncate">📰 Warta Mingguan</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('program-kerja.*') ? 'active' : '' }}">
                                <a href="{{ route('program-kerja.index') }}" class="menu-link">
                                    <i class="bx bx-task me-2"></i>
                                    <div class="text-truncate">📋 Program Kerja</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- OIG -->
                    <li class="menu-item {{ request()->routeIs('admin.oig.*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-group"></i>
                            <div class="text-truncate">👥 OIG</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->routeIs('admin.oig.pkbgt') ? 'active' : '' }}">
                                <a href="{{ route('admin.oig.pkbgt') }}" class="menu-link">
                                    <i class="bx bx-group me-2"></i>
                                    <div class="text-truncate">👥 PKBGT</div>
                                </a>
                            </li>

                            <li class="menu-item {{ request()->routeIs('admin.oig.pwgt') ? 'active' : '' }}">
                                <a href="{{ route('admin.oig.pwgt') }}" class="menu-link">
                                    <i class="bx bx-female me-2"></i>
                                    <div class="text-truncate">👩 PWGT</div>
                                </a>
                            </li>

                            <li class="menu-item {{ request()->routeIs('admin.oig.ppgt') ? 'active' : '' }}">
                                <a href="{{ route('admin.oig.ppgt') }}" class="menu-link">
                                    <i class="bx bx-male me-2"></i>
                                    <div class="text-truncate">👨 PPGT</div>
                                </a>
                            </li>

                            <li class="menu-item {{ request()->routeIs('admin.oig.smgt') ? 'active' : '' }}">
                                <a href="{{ route('admin.oig.smgt') }}" class="menu-link">
                                    <i class="bx bx-child me-2"></i>
                                    <div class="text-truncate">👶 SMGT</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Contact -->
                    <li class="menu-item {{ request()->routeIs('dashboard.contact-data') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.contact-data') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-phone"></i>
                            <div class="text-truncate">📞 Contact</div>
                        </a>
                    </li>

                    <!-- Admin Section -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text" style="color: #8B4513;">🔧 ADMIN</span>
                    </li>

                    <!-- Data Jemaat -->
                    <li class="menu-item {{ request()->routeIs('excel-files.*') && request()->get('category') == 'data-jemaat' ? 'active' : '' }}">
                        <a href="{{ route('excel-files.index', ['category' => 'data-jemaat']) }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-group"></i>
                            <div class="text-truncate">👥 Data Jemaat</div>
                        </a>
                    </li>

                    <!-- Barang Inventaris -->
                    <li class="menu-item {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
                        <a href="{{ route('inventory.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-package"></i>
                            <div class="text-truncate">📦 Barang Inventaris</div>
                        </a>
                    </li>

                    <!-- Program Kerja Jemaat Selili -->
                    <li class="menu-item {{ request()->routeIs('excel-files.*') && request()->get('category') == 'program-kerja' ? 'active' : '' }}">
                        <a href="{{ route('excel-files.index', ['category' => 'program-kerja']) }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-clipboard"></i>
                            <div class="text-truncate">📋 Program Kerja Jemaat</div>
                        </a>
                    </li>



                    <!-- Setting Home -->
                    <li class="menu-item {{ request()->routeIs('setting-home.*') ? 'active' : '' }}">
                        <a href="{{ route('setting-home.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div class="text-truncate">⚙️ Setting Home</div>
                        </a>
                    </li>


                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center church-header" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <h4 class="church-title mb-0">⛪ Gereja Toraja Jemaat eben-Haezer</h4>

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block">{{ Auth::user()->name ?? 'Admin' }}</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">👤 My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">🚪 Log Out</span>
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © {{ date('Y') }}, made with ❤️ by <strong>Gereja Toraja Jemaat eben-Haezer</strong>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    @stack('scripts')

    <!-- Mobile Menu Toggle Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle functionality
        const menuToggle = document.querySelector('.layout-menu-toggle');
        const layoutMenu = document.querySelector('#layout-menu');
        const layoutOverlay = document.querySelector('.layout-overlay');
        
        if (menuToggle && layoutMenu) {
            menuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                layoutMenu.classList.toggle('show');
                if (layoutOverlay) {
                    layoutOverlay.classList.toggle('show');
                }
            });
        }
        
        // Close menu when clicking overlay
        if (layoutOverlay) {
            layoutOverlay.addEventListener('click', function() {
                layoutMenu.classList.remove('show');
                layoutOverlay.classList.remove('show');
            });
        }
        
        // Close menu when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!layoutMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                    layoutMenu.classList.remove('show');
                    if (layoutOverlay) {
                        layoutOverlay.classList.remove('show');
                    }
                }
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                layoutMenu.classList.remove('show');
                if (layoutOverlay) {
                    layoutOverlay.classList.remove('show');
                }
            }
        });
    });
    </script>

    <!-- Admin Responsive JavaScript -->
    <script src="{{ asset('assets/js/admin-responsive.js') }}?v={{ time() }}"></script>
    
    <!-- Additional responsive improvements -->
    <style>
    /* Submenu responsive styles */
    @media (max-width: 1199.98px) {
        .menu-sub {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .menu-item.open .menu-sub {
            max-height: 500px;
        }
        
        .menu-item.open > .menu-link .menu-toggle::after {
            transform: rotate(90deg);
        }
    }
    
    /* Body scroll lock when menu is open */
    body.menu-open {
        overflow: hidden;
    }
    
    /* Touch device improvements */
    .touch-device .menu-link:hover {
        background: transparent !important;
    }
    
    .touch-device .menu-link:active {
        background: rgba(212, 165, 116, 0.3) !important;
    }
    </style>

    <style>
    /* Ensure layout renders properly */
    .layout-wrapper {
        display: flex !important;
        min-height: 100vh;
    }

    .layout-container {
        display: flex !important;
        width: 100%;
    }

    .layout-menu {
        display: block !important;
        width: 260px;
        flex-shrink: 0;
    }

    .layout-page {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Ensure submenu is visible when parent is active */
    /* Sub-navbar styling untuk Informasi */
    .menu-sub {
        background-color: transparent;
        border-left: 3px solid #8B4513;
        margin-left: 1rem;
        padding-left: 0;
        display: none;
    }

    .menu-item.active.open .menu-sub,
    .menu-item.open .menu-sub {
        display: block;
    }

    .menu-sub .menu-item {
        margin: 0;
    }

    .menu-sub .menu-link {
        padding: 0.75rem 1rem;
        color: #495057;
        background-color: transparent;
        border: none;
        display: block;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }

    .menu-sub .menu-link:hover {
        background-color: rgba(139, 69, 19, 0.1);
        color: #8B4513;
        padding-left: 1.25rem;
    }

    .menu-sub .menu-item.active .menu-link {
        background-color: #8B4513;
        color: white;
        font-weight: 500;
    }

    /* Main menu item active styling */
    .menu-item.active > .menu-link {
        background-color: #8B4513;
        color: white;
        font-weight: 500;
    }

    .menu-sub .menu-link .text-truncate {
        font-size: 0.875rem;
        font-weight: 400;
    }

    /* Menu toggle styling */
    .menu-item.open > .menu-link {
        background-color: rgba(139, 69, 19, 0.1);
        color: #8B4513;
    }
    </style>

    <script>
    // Wait for all scripts to load, then override menu behavior
    $(window).on('load', function() {
        setTimeout(function() {
            // Remove all existing click handlers from menu toggles
            $('.menu-toggle').off('click');

            // Handle menu toggle specifically for items with submenu
            $('.menu-item').each(function() {
                var $menuItem = $(this);
                var $submenu = $menuItem.find('.menu-sub');
                var $toggle = $menuItem.find('.menu-toggle');

                // Only handle items that have submenu
                if ($submenu.length > 0 && $toggle.length > 0) {
                    $toggle.on('click.customMenu', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        e.stopImmediatePropagation();

                        var isOpen = $menuItem.hasClass('open');

                        // Close all other open menus first
                        $('.menu-item.open').not($menuItem).each(function() {
                            $(this).removeClass('open');
                            $(this).find('.menu-sub').slideUp(200);
                        });

                        // Toggle current menu
                        if (isOpen) {
                            $menuItem.removeClass('open');
                            $submenu.slideUp(200);
                        } else {
                            $menuItem.addClass('open');
                            $submenu.slideDown(200);
                        }

                        return false;
                    });
                }
            });

            // Auto-open active menu items on page load
            $('.menu-item.active.open').each(function() {
                $(this).find('.menu-sub').show();
            });

            // Prevent submenu links from closing the menu
            $('.menu-sub .menu-link').on('click', function(e) {
                e.stopPropagation();
            });
        }, 100);
    });
    </script>
</body>
</html>
