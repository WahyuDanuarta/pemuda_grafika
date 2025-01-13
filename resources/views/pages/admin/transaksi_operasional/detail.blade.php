@extends('layouts.admin.main')
@section('title', 'Admin Detail Transaksi Operasional')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Transaksi Operasional</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.transaksi_operasional') }}">Transaksi Operasional</a>
                </div>
                <div class="breadcrumb-item">Detail Transaksi Operasional</div>
            </div>
        </div>
        
        <a href="{{ route('admin.transaksi_operasional') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        
        <div class="row mt-4">
            <div class="col-12 col-md-12 col-lg-12 m-auto">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Detail Transaksi Operasional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Keterangan Transaksi</strong></td>
                                    <td>{{ $transaksi->keterangan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Biaya</strong></td>
                                    <td>Rp {{ number_format($transaksi->totalBiaya, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ditangani oleh Admin</strong></td>
                                    <td>{{ $transaksi->admin->nama ?? 'Admin Tidak Ditemukan' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Transaksi</strong></td>
                                    <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr>

                        <h4>Detail Biaya Transaksi</h4>
                        <table class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Biaya</th>
                                    <!-- <th>Total Pengeluaran</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($transaksi->detailTransaksiOperasionals as $detail)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $detail->kategoriOperasional->jenis_operasional ?? 'No Kategori' }}</td>
                                    <td>Rp {{ number_format($detail->biaya, 0, ',', '.') }}</td>
                                    <!-- <td>Rp {{ number_format($detail->total_pengeluaran, 0, ',', '.') }}</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
