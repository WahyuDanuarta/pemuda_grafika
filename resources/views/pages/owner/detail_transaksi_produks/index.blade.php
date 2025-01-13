@extends('layouts.owner.main')

@section('title', 'Detail Transaksi Produk')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Transaksi Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('owner.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Detail Transaksi Produk</div>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="card">
            <div class="card-header">
                <h4>Filter Transaksi Produk</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('owner.detail_transaksi_produks') }}">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="start_date">Tanggal</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="start_month">Bulan</label>
                            <select name="start_month" class="form-control">
                                <option value="">Pilih Bulan</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}" {{ request('start_month') == $month ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="start_year">Tahun</label>
                            <input type="number" name="start_year" class="form-control" value="{{ request('start_year') }}" placeholder="Tahun">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('owner.detail_transaksi_produks') }}" class="btn btn-secondary ml-2">Reset</a>
                </form>
            </div>
        </div>

        <!-- Menampilkan pesan kesalahan jika ada -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Data Transaksi Produk -->
        <div class="card">
            <div class="card-header">
                <h4>Data Transaksi Produk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-md">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Nama Admin</th>
                                <th>Nama Produk</th>
                                <th>Harga Satuan</th>
                                <th>Total Produk</th>
                                <th>Total Harga Produk</th>
                                <th>Total Transaksi</th>
                                <th>Waktu Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1; // Initializing the counter
                            @endphp
                            @forelse($transaksiProduks as $transaksi)
                                @php
                                    $totalTransaksi = $transaksi->detailTransaksiProduks->sum(function($detail) {
                                        return $detail->produk->harga * $detail->total_produk;
                                    });
                                @endphp
                                @foreach($transaksi->detailTransaksiProduks as $key => $detail)
                                    <tr>
                                        @if($key === 0)
                                            <td rowspan="{{ $transaksi->detailTransaksiProduks->count() }}" class="align-middle text-center">{{ $no++ }}</td>
                                            <td rowspan="{{ $transaksi->detailTransaksiProduks->count() }}" class="align-middle text-center">{{ $transaksi->id }}</td>
                                            <td rowspan="{{ $transaksi->detailTransaksiProduks->count() }}" class="align-middle text-center">{{ $transaksi->admin->nama ?? 'Admin Tidak Ditemukan' }}</td>
                                        @endif
                                        <td>{{ $detail->produk->nama_produk }}</td>
                                        <td class="text-right">{{ 'Rp ' . number_format($detail->produk->harga, 0, ',', '.') }}</td>
                                        <td class="text-right">{{ $detail->total_produk }}</td>
                                        <td class="text-right">{{ 'Rp ' . number_format($detail->produk->harga * $detail->total_produk, 0, ',', '.') }}</td>
                                        @if($key === 0)
                                            <td rowspan="{{ $transaksi->detailTransaksiProduks->count() }}" class="text-right font-weight-bold">{{ 'Rp ' . number_format($totalTransaksi, 0, ',', '.') }}</td>
                                            <td rowspan="{{ $transaksi->detailTransaksiProduks->count() }}" class="text-center">{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @empty
                                <!-- Menampilkan pesan jika tidak ada data -->
                                <tr>
                                    <td colspan="9" class="text-center">Data transaksi produk tidak ditemukan. Silakan coba filter lainnya.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($transaksiProduks->isNotEmpty())
                    <h5>Total Keseluruhan: {{ 'Rp ' . number_format($total_harga_keseluruhan, 0, ',', '.') }}</h5>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection