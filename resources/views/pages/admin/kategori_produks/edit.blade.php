@extends('layouts.admin.main')
@section('title', 'Admin Edit Kategori Produk')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Kategori Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.kategori_produks') }}">Kategori Produk</a>
                </div>
                <div class="breadcrumb-item">Edit Kategori Produk</div>
            </div>
        </div>

        <a href="{{ route('admin.kategori_produks') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.kategori_produks.update', $kategori_produks->id) }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')  <!-- Menggunakan metode PUT untuk update -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama_kategori">Kategori Produk</label>
                                <input id="nama_kategori" type="text" class="form-control" name="nama_kategori" required value="{{ $kategori_produks->nama_kategori }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
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