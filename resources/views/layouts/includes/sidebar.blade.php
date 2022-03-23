<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <x-logo/>
                {{-- <img src="{{ asset('admin/assets/img') }}" alt="" srcset=""> --}}
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Klinik Anak</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('dashboard')?'active':'' }}">
            <a href="{{ url('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @if (auth()->user()->role == 'apoteker')
            <li class="menu-item {{ request()->routeIs('obat.*') ? 'active' : '' }}">
                <a class="menu-link" href="/apoteker/obat">
                    <i class="menu-icon fa fa-pills"></i>
                    <div>Data Obat</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('apoteker/pemberian-obat') ? 'active' : '' }}">
                <a class="menu-link" href="/apoteker/pemberian-obat">
                    <i class="menu-icon fa fa-hospital-user"></i>
                    <div>Pemberian Obat</div>
                </a>
            </li>
        @elseif(auth()->user()->role == 'pegawai')
            <li class="menu-item {{ request()->routeIs('patients.*') ? 'active' : '' }}">
                <a class="menu-link" href="/pegawai/patients">
                    <i class="menu-icon fa fa-user-injured"></i>
                    <div>Data Pasien</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('medical-records.*') ? 'active' : '' }}">
                <a class="menu-link" href="/pegawai/medical-records">
                    <i class="menu-icon fa fa-hospital-user"></i>
                    <div>Pendaftaran</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('med-rec.laporan') ? 'active' : '' }}">
                <a class="menu-link" href="/pegawai/medical-records/laporan">
                    <i class="menu-icon fa fa-book"></i>
                    <div>Laporan</div>
                </a>
            </li>
        @elseif(auth()->user()->role == 'dokter')
            <li class="menu-item {{ request()->is('dokter/medical-records*') ? 'active' : '' }}">
                <a class="menu-link" href="/dokter/medical-records">
                    <i class="menu-icon fa fa-hospital-user"></i>
                    <div>Rekam Medis</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('dokter/pemeriksaan*') ? 'active' : '' }}">
                <a class="menu-link" href="/dokter/pemeriksaan">
                    <i class="menu-icon fa fa-user-doctor"></i>
                    <div>Pemeriksaan</div>
                </a>
            </li>
        @endif
        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Account Pages</span></li>
        <li class="menu-item {{ request()->is('profile')?'active':'' }}">
            <a href="/profile" class="menu-link">
                <i class="menu-icon fa-solid fa-user"></i>
                <div data-i18n="Support" style="">Profile</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" onclick="logout(this)" class="menu-link">
                <i class="menu-icon fa-solid fa-arrow-right-from-bracket"></i>
                <div data-i18n="Documentation">Logout</div>
            </a>
        </li>
    </ul>
</aside>