<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">
            <img src="{{ asset('admin/assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main" style="height: unset">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('dashboard')?'active bg-gradient-primary':'' }}  " href="/dashboard">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role=='apoteker')
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('obat.*')?'active bg-gradient-primary':'' }}  " href="/apoteker/obat">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-pills"></i>
                    </div>
                    <span class="nav-link-text ms-1">Obat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('apoteker/pemberian-obat')?'active bg-gradient-primary':'' }}  " href="/apoteker/pemberian-obat">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-hospital-user"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pemberian Obat</span>
                </a>
            </li>
            @elseif(auth()->user()->role=='pegawai')
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('patients.*')?'active bg-gradient-primary':'' }}  " href="/pegawai/patients">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user-injured"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pasien</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('medical-records.*')?'active bg-gradient-primary':'' }}  " href="/pegawai/medical-records">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-hospital-user"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pendaftaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('med-rec.laporan')?'active bg-gradient-primary':'' }}" href="/pegawai/medical-records/laporan">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">book</i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>
            @elseif(auth()->user()->role=='dokter')
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('dokter/medical-records*')?'active bg-gradient-primary':'' }}  " href="/dokter/medical-records">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-hospital-user"></i>
                    </div>
                    <span class="nav-link-text ms-1">Rekam Medis</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('dokter/pemeriksaan*')?'active bg-gradient-primary':'' }}  " href="/dokter/pemeriksaan">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user-doctor"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pemeriksaan</span>
                </a>
            </li>
            @endif
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('profile')?'active bg-gradient-primary':'' }}" href="/profile">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="#" onclick="logout(this)">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
