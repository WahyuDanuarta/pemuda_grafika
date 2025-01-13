@extends('layouts.owner.main')
@section('title', 'Laporan Pengeluaran')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Pengeluaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('owner.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Laporan Pengeluaran</div>
            </div>
        </div>

        <!-- Form Filter -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('owner.detail_transaksi_operasionals') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date">Tanggal</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="start_month">Bulan</label>
                            <select name="start_month" class="form-control">
                                <option value="">Pilih Bulan</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}" {{ request('start_month') == $month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="start_year">Tahun</label>
                            <input type="number" name="start_year" class="form-control" value="{{ request('start_year') }}" placeholder="Tahun">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('owner.detail_transaksi_operasionals') }}" class="btn btn-warning">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Laporan Pengeluaran -->
        <div class="card">
            <div class="card-body">
                @if ($noDataMessage)
                    <div class="alert alert-warning">{{ $noDataMessage }}</div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Sub Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $no = 1; 
                            $totalPengeluaran = 0; // Variabel untuk menghitung total pengeluaran
                        @endphp
                        @foreach ($transaksiOperasionals as $transaksi)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $transaksi->admin->nama ?? 'Admin Tidak Ditemukan' }}</td>
                                <td>
                                    @foreach ($transaksi->detailTransaksiOperasionals as $detail)
                                        {{ $detail->kategoriOperasional->jenis_operasional ?? 'Kategori Tidak Ditemukan' }}<br>
                                    @endforeach
                                </td>
                                <td>{{ $transaksi->keterangan }}</td>
                                <td>{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    @php 
                                        $subTotal = 0; 
                                    @endphp
                                    @foreach ($transaksi->detailTransaksiOperasionals as $detail)
                                        @php 
                                            $subTotal += $detail->biaya; 
                                        @endphp
                                        Rp {{ number_format($detail->biaya, 0, ',', '.') }}<br>
                                    @endforeach
                                    @php 
                                        $totalPengeluaran += $subTotal; // Tambahkan subtotal ke total pengeluaran
                                    @endphp
                                    <strong>Total: Rp {{ number_format($subTotal, 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    <h5>Total Pengeluaran: <strong>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</strong></h5>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection