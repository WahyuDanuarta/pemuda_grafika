@extends('layouts.admin.main')
@section('title', 'Admin Transaksi Operasional')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaksi Operasional</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Transaksi Operasional</div>
            </div>
        </div>

        <!-- Tombol Tambah Transaksi Operasional -->
        <a href="{{ route('admin.transaksi_operasional.create') }}" class="btn btn-icon icon-left btn-blue">
            <i class="fas fa-plus"></i> Tambah Transaksi Operasional
        </a>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Admin</th>
                            <th>Biaya</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($transaksiOperasionals as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->admin->nama ?? 'Admin Tidak Ditemukan' }}</td>
                            <td>
                                @php
                                    $totalBiaya = 0;
                                    foreach ($item->detailTransaksiOperasionals as $detail) {
                                        $totalBiaya += $detail->biaya;
                                    }
                                @endphp
                                Rp {{ number_format($totalBiaya, 0, ',', '.') }}
                            </td>
                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.transaksi_operasional.detail', $item->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('admin.transaksi_operasional.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Data Transaksi Operasional Kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3 d-flex justify-content-center">
            <!-- Previous Page Link -->
            @if ($transaksiOperasionals->onFirstPage())
                <span class="page-link disabled">Sebelumnya</span>
            @else
                <a href="{{ $transaksiOperasionals->previousPageUrl() }}" class="page-link prev-next">Sebelumnya</a>
            @endif

            <!-- Pagination Links -->
            <ul class="pagination">
                @foreach ($transaksiOperasionals->getUrlRange(1, $transaksiOperasionals->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $transaksiOperasionals->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Next Page Link -->
            @if ($transaksiOperasionals->hasMorePages())
                <a href="{{ $transaksiOperasionals->nextPageUrl() }}" class="page-link prev-next">Selanjutnya</a>
            @else
                <span class="page-link disabled">Selanjutnya</span>
            @endif
        </div>
    </section>
</div>
@endsection