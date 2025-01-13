@extends('layouts.owner.main')
@section('title', 'Admin')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('owner.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Admin</div>
            </div>
        </div>

        <a href="{{ route('owner.admins.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Admin
        </a>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($admins as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->username }}</td>
                                <td>
                                    <a href="{{ route('owner.admins.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('owner.admins.delete', $item->id) }}" class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Data Produk Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection