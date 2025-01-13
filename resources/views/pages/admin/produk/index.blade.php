@extends('layouts.admin.main')
@section('title', 'Admin Produk')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Produk</div>
            </div>
        </div>

        <a href="{{ route('admin.produk.create') }}" class="btn btn-icon icon-left btn-blue">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                        @foreach ($produks as $item)
                        <tr>
                            <td>{{ $no+= 1 }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>{{ $item->kategori_id ? $item->kategori->nama_kategori : 'No kategori' }}</td>
                            <td>
                                @if ($item->images->isNotEmpty())
                                    @php
                                        $imagePath = asset('images/' . $item->images->first()->filename);
                                    @endphp
                                    <img src="{{ $imagePath }}" alt="Image" width="100">
                                @else
                                    <span>Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.produk.detail', $item->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('admin.produk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('admin.produk.delete', $item->id) }}" class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                <!-- Previous Page Link -->
                @if ($produks->onFirstPage())
                    <span class="page-link disabled">Sebelumnya</span>
                @else
                    <a href="{{ $produks->previousPageUrl() }}" class="page-link prev-next">Sebelumnya</a>
                @endif

                <!-- Pagination Links -->
                <ul class="pagination">
                    @foreach ($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $produks->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                </ul>

                <!-- Next Page Link -->
                @if ($produks->hasMorePages())
                    <a href="{{ $produks->nextPageUrl() }}" class="page-link prev-next">Selanjutnya</a>
                @else
                    <span class="page-link disabled">Selanjutnya</span>
                @endif
            </div>
    </section>
</div>
@endsection