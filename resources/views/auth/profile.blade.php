@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{ url('admin') }}/assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                <div class="button-wrapper pt-3">
                    {{-- <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                    </label>
                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>

                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> --}}
                    <h5>Nama : {{ auth()->user()->name }}</h5>
                    <h5>Email : {{ auth()->user()->email }}</h5>
                    <h5>Role : {{ auth()->user()->role }}</h5>
                </div>
            </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <div class="row">
                <form action="{{ url('profile/change-profile') }}" method="post" class="col-md-6 col-12">
                    <h3 class="text-center">Ganti Profile</h3>
                    @csrf
                    @method('put')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ auth()->user()->name }}" autofocus />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ auth()->user()->email }}" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
                <form action="{{ url('profile/change-password') }}" method="post" class="col-md-6 col-12">
                    <h3 class="text-center">Ganti Password</h3>
                    @csrf
                    @method('put')
                    <div class="form-group mb-3">
                        <label for="old_password" class="form-label">Password Lama</label>
                        <input class="form-control @error('old_password') is-invalid @enderror" type="password" id="old_password" name="old_password" />
                        @error('old_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" />
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
