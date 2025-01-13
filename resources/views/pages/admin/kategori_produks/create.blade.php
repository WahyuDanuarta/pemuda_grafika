@extends('layouts.admin.main')
@section('title', 'Admin Tambah Kategori Produk')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Kategori Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.kategori_produks') }}">Kategori Produk</a>
                </div>
                <div class="breadcrumb-item">Tambah Kategori Produk</div>
            </div>
        </div>

        <a href="{{ route('admin.kategori_produks') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <form action="{{ route('admin.kategori_produks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama_kategori">Kategori Produk</label>
                                <input id="nama_kategori" type="text" class="form-control" name="nama_kategori" required>
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-icon icon-left btn-blue">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection