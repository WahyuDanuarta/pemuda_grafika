@extends('layouts.admin.main')
@section('title', 'Admin Kecil Kategori Operasional')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori Operasional</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Kategori Operasional</div>
            </div>
        </div>

        <!-- Tombol Tambah Kategori Operasional -->
        <a href="{{ route('admin.kategori_operasional.create') }}" class="btn btn-icon icon-left btn-blue">
            <i class="fas fa-plus"></i> Tambah Kategori Operasional
        </a>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Operasional</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($kategoriOperasional as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->jenis_operasional }}</td>
                                <td>
                                    <a href="{{ route('admin.kategori_operasional.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('admin.kategori_operasional.delete', $item->id) }}" class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Data Kategori Operasional Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3 d-flex justify-content-center">
            <!-- Previous Page Link -->
            @if ($kategoriOperasional->onFirstPage())
                <span class="page-link disabled">Sebelumnya</span>
            @else
                <a href="{{ $kategoriOperasional->previousPageUrl() }}" class="page-link prev-next">Sebelumnya</a>
            @endif

            <!-- Pagination Links -->
            <ul class="pagination">
                @foreach ($kategoriOperasional->getUrlRange(1, $kategoriOperasional->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $kategoriOperasional->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Next Page Link -->
            @if ($kategoriOperasional->hasMorePages())
                <a href="{{ $kategoriOperasional->nextPageUrl() }}" class="page-link prev-next">Selanjutnya</a>
            @else
                <span class="page-link disabled">Selanjutnya</span>
            @endif
        </div>
    </section>
</div>
@endsection