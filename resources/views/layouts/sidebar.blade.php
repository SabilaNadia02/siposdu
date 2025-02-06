{{-- <aside class="app-sidebar bg-white text-dark shadow" data-bs-theme="dark"> --}}

<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('adminlte') }}/dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">SEMANGAT MEI NADIA!</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">

            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-header">UTAMA</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-house-door"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">FITUR UTAMA</li>
                <li class="nav-item">
                    <a href="/pendaftaran" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>Pendaftaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pencatatan/general" class="nav-link">
                        <i class="nav-icon bi bi-journal-text"></i>
                        <p>Pencatatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-shield-plus"></i>
                        <p>Skrining TBC</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-shield-plus"></i>
                        <p>Skrining PPOK</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pemberian/imunisasi" class="nav-link">
                        <i class="nav-icon bi bi-capsule"></i>
                        <p>Pemberian Imunisasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pemberian/vitamin" class="nav-link">
                        <i class="nav-icon bi bi-capsule"></i>
                        <p>Pemberian Vitamin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pemberian/obat" class="nav-link">
                        <i class="nav-icon bi bi-capsule"></i>
                        <p>Pemberian Obat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pemberian/vaksin" class="nav-link">
                        <i class="nav-icon bi bi-capsule"></i>
                        <p>Pemberian Vaksin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kelulusan-balita" class="nav-link">
                        <i class="nav-icon bi-journal-check"></i>
                        <p>Data Kelulusan Balita</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/rujukan" class="nav-link">
                        <i class="nav-icon bi-arrow-right-circle"></i>
                        <p>Rujukan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi-file-earmark-pdf"></i>
                        <p>Laporan</p>
                    </a>
                </li>

                <li class="nav-header">DATA MASTER</li>
                <li class="nav-item">
                    <a href="/data-master/imunisasi" class="nav-link">
                        <i class="nav-icon bi-database"></i>
                        <p>Data Imunisasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/data-master/vitamin" class="nav-link">
                        <i class="nav-icon bi-database"></i>
                        <p>Data Vitamin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/data-master/obat" class="nav-link">
                        <i class="nav-icon bi-database"></i>
                        <p>Data Obat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/data-master/vaksin" class="nav-link">
                        <i class="nav-icon bi-database"></i>
                        <p>Data Vaksin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/data-master/posyandu" class="nav-link">
                        <i class="nav-icon bi-database"></i>
                        <p>Data Posyandu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/data-master/pengguna" class="nav-link">
                        <i class="nav-icon bi-database"></i>
                        <p>Data Pengguna</p>
                    </a>
                </li>
                <li class="nav-header">KELUAR</li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-danger font-weight-bold">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->

        </nav>
    </div>
    <!--end::Sidebar Wrapper-->

</aside>
<!--end::Sidebar-->
