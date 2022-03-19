@extends('layouts.app')

@section('content')
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="./admin/assets/img/bruce-mars.jpg" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ auth()->user()->name }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ auth()->user()->role }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Profile Information</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <hr class="horizontal gray-light my-2">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                        class="text-dark">Name:</strong> &nbsp; {{ auth()->user()->name }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Email:</strong> &nbsp; {{ auth()->user()->email }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Ganti Profile</h6>
                        </div>
                        <div class="card-body p-3">
                            <form action="{{ url('profile/change-profile') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <div class="input-group input-group-outline is-filled">
                                        <label for="" class="form-label">Nama</label>
                                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="input-group input-group-outline is-filled">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-3">Ganti</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Ganti Password</h6>
                        </div>
                        <div class="card-body p-3">
                            <form action="{{ url('profile/change-password') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <div class="input-group input-group-outline">
                                        <label for="" class="form-label">Password Lama</label>
                                        <input type="password" name="old_password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="input-group input-group-outline">
                                        <label for="" class="form-label">Password Baru</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="input-group input-group-outline">
                                        <label for="" class="form-label">Password Baru</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-3">Ganti</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
