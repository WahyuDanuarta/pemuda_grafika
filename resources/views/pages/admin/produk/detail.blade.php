@extends('layouts.admin.main')
@section('title', 'Admin Detail Produk')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.produk') }}">Produk</a>
                </div>
                <div class="breadcrumb-item">Detail Produk</div>
            </div>
        </div>
        
        <a href="{{ route('admin.produk') }}" class="btn btn-icon icon-left btn-warning mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        
        <div class="row mt-4">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Gambar Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            @if($produk->images->isNotEmpty())
                                @foreach($produk->images as $image)
                                    <div class="p-2">
                                        <img src="{{ asset('images/' . $image->filename) }}" alt="Image" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                                    </div>
                                @endforeach
                            @else
                                <span>Tidak ada gambar</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Produk</h4>
                    </div>
                    <div class="card-body">
                        <h5>Nama Produk: {{ $produk->nama_produk }}</h5>
                        <h5>Kategori: {{ $produk->kategori_id ? $produk->kategori->nama_kategori : 'No kategori' }}</h5>
                        <h5>Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</h5>
                        <h5>Stok: {{ $produk->stok }}</h5>
                        <hr>
                        <h5>Deskripsi:</h5>
                        <p>{{ $produk->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection