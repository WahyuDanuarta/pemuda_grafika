@extends('layouts.admin.main')
@section('title', 'Admin Kecil Transaksi Produks')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaksi Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Transaksi Produk</div>
            </div>
        </div>

        <a href="{{ route('admin.transaksi_produks.create') }}" class="btn btn-icon icon-left btn-blue">
            <i class="fas fa-plus"></i> Tambah Transaksi Produk
        </a>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Nama Produk</th>
                            <th>Total Produk</th>
                            <th>Status</th>
                            <th>Tanggal Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi_produks as $transaksi)
                        <tr>
                            <td>{{ $loop->iteration + $transaksi_produks->firstItem() - 1 }}</td>
                            <td>{{ $transaksi->nama }}</td>
                            <td>{{ $transaksi->keterangan }}</td>
                            <td>
                                @foreach ($transaksi->detailTransaksiProduks as $detail)
                                    <div>{{ $detail->produk ? $detail->produk->nama_produk : 'Produk Tidak Ditemukan' }}</div>
                                @endforeach
                            </td>
                            <td>{{ $transaksi->detailTransaksiProduks->sum('total_produk') }}</td>
                            <td>{{ $transaksi->status }}</td>
                            <td>{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.transaksi_produks.detail', $transaksi->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('admin.transaksi_produks.edit', $transaksi->id) }}" class="btn btn-warning">Edit</a>
                                <a href="https://api.whatsapp.com/send?text=Halo%20{{ urlencode($transaksi->nama) }},%20saya%20ingin%20memberitahukan%20pemesanannya%20dengan%20{{ urlencode($transaksi->detailTransaksiProduks->first()->produk->nama_produk ?? 'Produk Tidak Ditemukan') }}%20saat%20ini%20statusnya%20{{ urlencode($transaksi->status) }}" target="_blank" class="btn btn-success">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                @if ($transaksi_produks->onFirstPage())
                    <span class="page-link disabled box">Sebelumnya</span>
                @else
                    <a href="{{ $transaksi_produks->previousPageUrl() }}" class="page-link prev-next box">Sebelumnya</a>
                @endif

                <ul class="pagination">
                    @foreach ($transaksi_produks->getUrlRange(1, $transaksi_produks->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $transaksi_produks->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                </ul>

                @if ($transaksi_produks->hasMorePages())
                    <a href="{{ $transaksi_produks->nextPageUrl() }}" class="page-link prev-next box">Selanjutnya</a>
                @else
                    <span class="page-link disabled box">Selanjutnya</span>
                @endif
            </div>

        </div>
    </section>
</div>
@endsection