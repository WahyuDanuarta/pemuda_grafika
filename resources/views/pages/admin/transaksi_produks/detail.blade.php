@extends('layouts.admin.main')

@section('title', 'Detail Transaksi Produk')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Transaksi Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.transaksi_produks') }}">Transaksi Produk</a>
                </div>
                <div class="breadcrumb-item">Detail Transaksi Produk</div>
            </div>
        </div>

        <a href="{{ route('admin.transaksi_produks') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card">
            <div class="card-header">
                <h4>Informasi Detail Transaksi Produk</h4>
            </div>
            <div class="card-body">
                <!-- Menampilkan Semua Informasi dalam Satu Tabel -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                            <th>Admin</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksiProduk->detailTransaksiProduks as $detail)
                            <tr>
                                <td>{{ $detail->produk->nama_produk ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $detail->total_produk }}</td>
                                <td>Rp. {{ number_format($detail->produk->harga ?? 0, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($detail->total_harga, 0, ',', '.') }}</td>
                                <td>{{ $transaksiProduk->admin->nama ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $transaksiProduk->created_at->format('d-m-Y H:i') }}</td> <!-- Menampilkan tanggal -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection