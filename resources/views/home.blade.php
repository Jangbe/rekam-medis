@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card" style="overflow: hidden">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang {{ auth()->user()->name }}! 🎉</h5>
                            <p class="mb-4">
                                Selamat Beraktifitas dan Melaksanakan Tugasnya.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ url('admin') }}/assets/img/illustrations/man-with-laptop-light.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-md-4">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 rounded text-center" style="background: #aaccff91">
                                    <i class="fa-solid fa-user-injured fa-xl pt-2 text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Data Pasien</span>
                            <h3 class="card-title mb-2">{{ $patient }}</h3>
                            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 rounded text-center" style="background: #aaccff91">
                                    <i class="fa fa-hospital-user fa-xl pt-2 text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <span>Pendaftaran</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $med_rec_todays }}</h3>
                            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 rounded text-center" style="background: #aaccff91">
                                    <i class="fa fa-face-smile fa-xl pt-2 text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <span>Pendaftaran Total</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $med_recs }}</h3>
                            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Grafik Pendaftaran -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <div class="d-flex p-4">
                    <div class="avatar flex-shrink-0 rounded text-center" style="background: #aaccff91">
                        <i class="fa fa-hospital-user fa-xl pt-2 text-primary"></i>
                    </div>
                    <div style="margin-left: 10px">
                        <small class="text-muted d-block">Grafik Data Pasien</small>
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0 me-1">Dalam Satu Minggu</h6>
                        </div>
                    </div>
                </div>
                <div id="grafik_pendaftaran" class="px-2"></div>
            </div>
        </div>
        <!-- Grafik Pasien -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body px-0">
                    <div class="d-flex p-4 pt-0">
                        <div class="avatar flex-shrink-0 rounded text-center" style="background: #aaccff91">
                            <i class="fa fa-user-injured fa-xl pt-2 text-primary"></i>
                        </div>
                        <div style="margin-left: 10px">
                            <small class="text-muted d-block">Grafik Data Pasien</small>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1">Dalam Satu Bulan</h6>
                            </div>
                        </div>
                    </div>
                    <div id="grafik_pasien"></div>
                </div>
            </div>
        </div>
        <!--/ Grafik Pasien -->
    </div>
@endsection
