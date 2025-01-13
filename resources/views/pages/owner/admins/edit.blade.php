@extends('layouts.owner.main')
@section('title', 'owner Edit Admin')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('owner.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('owner.admins') }}">Admin Kecil</a>
                </div>
                <div class="breadcrumb-item">Edit Admin </div>
            </div>
        </div>

        <a href="{{ route('owner.admins') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('owner.admins.update', $admins->id) }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')  <!-- Menggunakan metode PUT untuk update -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username" required value="{{ $admins->username }}" disabled>
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi jika Anda ingin mengganti password!
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>        
    </section>
</div>
@endsection