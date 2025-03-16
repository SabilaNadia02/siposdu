<!--begin::Sidebar-->
<aside class="app-sidebar bg-white shadow" data-bs-theme="light">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand p-3">
        <a href="./index.html" class="brand-link d-flex align-items-center text-dark text-decoration-none">
            {{-- <img src="{{ asset('adminlte') }}/dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow me-2" /> --}}
            <span class="brand-text fw-bold">SIPOSDU ILP</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav flex-column sidebar-menu" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-header fw-bold" style="color: #FF69B4;">UTAMA</li>
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house-door"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header fw-bold" style="color: #FF69B4;">FITUR UTAMA</li>
                <li class="nav-item">
                    <a href="/pendaftaran" class="nav-link {{ Request::is('pendaftaran') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>Pendaftaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pencatatan/general"
                        class="nav-link {{ Request::is('pencatatan/general') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-text"></i>
                        <p>Pencatatan</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ Request::is('skrining/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('skrining/*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-shield-plus"></i>
                        <p class="d-flex w-100 justify-content-between">
                            Skrining
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/skrining/tbc"
                                class="nav-link {{ Request::is('skrining/tbc') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Skrining TBC
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/skrining/ppok"
                                class="nav-link {{ Request::is('skrining/ppok') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Skrining PPOK
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ Request::is('pemberian/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('pemberian/*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-capsule"></i>
                        <p class="d-flex w-100 justify-content-between">
                            Pemberian
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/pemberian/imunisasi"
                                class="nav-link {{ Request::is('pemberian/imunisasi') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Pemberian Imunisasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pemberian/vitamin"
                                class="nav-link {{ Request::is('pemberian/vitamin') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Pemberian Vitamin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pemberian/obat"
                                class="nav-link {{ Request::is('pemberian/obat') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Pemberian Obat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pemberian/vaksin"
                                class="nav-link {{ Request::is('pemberian/vaksin') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Pemberian Vaksin
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/kelulusan-balita" class="nav-link {{ Request::is('kelulusan-balita') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-check"></i>
                        <p>Kelulusan Balita</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/rujukan" class="nav-link {{ Request::is('rujukan') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-arrow-right-circle"></i>
                        <p>Rujukan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/laporan" class="nav-link {{ Request::is('laporan') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-pdf"></i>
                        <p>Laporan</p>
                    </a>
                </li>

                <li class="nav-header fw-bold" style="color: #FF69B4;">DATA MASTER</li>
                <li class="nav-item has-treeview {{ Request::is('data-master/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('data-master/*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-database"></i>
                        <p class="d-flex w-100 justify-content-between">
                            Data Master
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/data-master/imunisasi"
                                class="nav-link {{ Request::is('data-master/imunisasi') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Data Imunisasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-master/vitamin"
                                class="nav-link {{ Request::is('data-master/vitamin') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Data Vitamin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-master/obat"
                                class="nav-link {{ Request::is('data-master/obat') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Data Obat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-master/vaksin"
                                class="nav-link {{ Request::is('data-master/vaksin') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Data Vaksin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-master/skrining"
                                class="nav-link {{ Request::is('data-master/skrining') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Data Skrining
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-master/pertanyaan"
                                class="nav-link {{ Request::is('data-master/pertanyaan') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Data Pertanyaan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-master/pertanyaan-skrining"
                                class="nav-link {{ Request::is('data-master/pertanyaan-skrining') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Pertanyaan Skrining
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-master/posyandu"
                                class="nav-link {{ Request::is('data-master/posyandu') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Data Posyandu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-master/pengguna"
                                class="nav-link {{ Request::is('data-master/pengguna') ? 'active-sub' : '' }}">
                                <i class="nav-icon bi bi-dash"></i> <!-- Ikon seragam untuk semua submenu -->
                                Data Pengguna
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header fw-bold" style="color: #FF69B4;">KELUAR</li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-danger fw-bold">
                        <i class="nav-icon bi bi-box-arrow-right text-danger"></i>
                        <p class="text-danger fw-bold">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>

<style>
    .app-sidebar {
        width: 250px;
        height: 100vh;
        overflow-y: auto;
        background-color: white;
    }

    .nav-link {
        color: black !important;
        padding: 6px 8px;
        font-size: 16px;
        display: flex;
        align-items: center;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .nav-item {
        margin-bottom: 3px;
    }

    .nav-header {
        margin-top: 10px;
        margin-bottom: 5px;
        font-size: 10px;
    }

    .nav-icon {
        font-size: 1rem;
        margin-right: 8px;
    }

    /* Efek hover: hanya mengubah warna teks menjadi pink */
    .nav-link:hover {
        color: #FF69B4 !important;
        background: none !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    /* Efek aktif untuk main level: background pink dan teks putih */
    .nav-link.active {
        background-color: #FF69B4 !important;
        color: white !important;
        border-radius: 0;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    /* Efek aktif untuk sub level: background pink muda dan teks putih */
    .nav-link.active-sub {
        background-color: #FFF5F8 !important;
        color: dark !important;
        border-radius: 0;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
</style>
<!--end::Sidebar-->
