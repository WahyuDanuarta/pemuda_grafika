@extends('layouts.admin.main')
@section('title', 'Admin Kecil Produk')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Kategori Produk</div>
            </div>
        </div>

        <!-- Tombol Tambah Kategori Produk -->
        <a href="{{ route('admin.kategori_produks.create') }}" class="btn btn-icon icon-left btn-blue">
            <i class="fas fa-plus"></i> Tambah Kategori Produk
        </a>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori Produk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($kategori_produks as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>
                                    <a href="{{ route('admin.kategori_produks.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('admin.kategori_produks.delete', $item->id) }}" class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Data Kategori Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                <!-- Previous Page Link -->
                @if ($kategori_produks->onFirstPage())
                    <span class="page-link disabled">Sebelumnya</span>
                @else
                    <a href="{{ $kategori_produks->previousPageUrl() }}" class="page-link prev-next">Sebelumnya</a>
                @endif

                <!-- Pagination Links -->
                <ul class="pagination">
                    @foreach ($kategori_produks->getUrlRange(1, $kategori_produks->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $kategori_produks->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                </ul>

                <!-- Next Page Link -->
                @if ($kategori_produks->hasMorePages())
                    <a href="{{ $kategori_produks->nextPageUrl() }}" class="page-link prev-next">Selanjutnya</a>
                @else
                    <span class="page-link disabled">Selanjutnya</span>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection