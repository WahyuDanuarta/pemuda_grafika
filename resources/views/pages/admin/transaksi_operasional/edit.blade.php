@extends('layouts.admin.main')
@section('title', 'Admin kecil Edit Transaksi Operasional')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Transaksi Operasional</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.transaksi_operasional') }}">Transaksi Operasional</a>
                </div>
                <div class="breadcrumb-item">Edit Transaksi Operasional</div>
            </div>
        </div>

        <a href="{{ route('admin.transaksi_operasional') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.transaksi_operasional.update', $transaksi->id) }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <!-- Keterangan Transaksi -->
                        <div class="card-body">
                    <div class="row">
                        <!-- Keterangan Transaksi -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan Transaksi</label>
                                <input id="keterangan" type="text" class="form-control" name="keterangan" required value="{{ $transaksi->keterangan }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Field for Kategori Operasional and Biaya -->
                        <div class="col-12">
                            <label for="kategori_operasional">Detail Kategori dan Biaya</label>
                            <div id="kategori-fields">
                                @foreach($transaksi->detailTransaksiOperasionals as $detail)
                                <div class="row mb-2 kategori-group">
                                    <div class="col-6">
                                        <select name="kategori_operasional_id[]" class="form-control" required>
                                            <option value="">Pilih Kategori Operasional</option>
                                            @foreach($kategori_operasionals as $kategori)
                                                <option value="{{ $kategori->id }}" 
                                                    {{ $kategori->id == $detail->kategori_operasional_id ? 'selected' : '' }}>
                                                    {{ $kategori->jenis_operasional }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="number" name="biaya[]" class="form-control" required placeholder="Biaya" value="{{ $detail->biaya }}">
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-danger btn-remove-field">Hapus</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-kategori-field">Tambah Kategori</button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-icon icon-left btn-primary mt-4">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
<script>
    document.getElementById('add-kategori-field').addEventListener('click', function() {
        const kategoriFields = document.getElementById('kategori-fields');
        const newField = `
            <div class="row mb-2 kategori-group">
                <div class="col-6">
                    <select name="kategori_operasional_id[]" class="form-control" required>
                        <option value="">Pilih Kategori Operasional</option>
                        @foreach($kategori_operasionals as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->jenis_operasional }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-5">
                    <input type="number" name="biaya[]" class="form-control" required placeholder="Biaya">
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-danger btn-remove-field">Hapus</button>
                </div>
            </div>
        `;
        kategoriFields.insertAdjacentHTML('beforeend', newField);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-field')) {
            e.target.closest('.kategori-group').remove();
        }
    });
</script>

@endsection
