@extends('layouts.admin.main')
@section('title', 'Admin Tambah Kategori Operasional')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Kategori Operasional</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.kategori_operasional') }}">Kategori Operasional</a>
                </div>
                <div class="breadcrumb-item">Tambah Kategori Operasional</div>
            </div>
        </div>

        <a href="{{ route('admin.kategori_operasional') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <form action="{{ route('admin.kategori_operasional.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jenis_operasional">Jenis Operasional</label>
                                <input id="jenis_operasional" type="text" class="form-control" name="jenis_operasional" required>
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
