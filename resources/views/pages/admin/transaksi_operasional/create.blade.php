@extends('layouts.admin.main')
@section('title', 'Tambah Transaksi Operasional')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Transaksi Operasional</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.transaksi_operasional') }}">Transaksi Operasional</a>
                </div>
                <div class="breadcrumb-item">Tambah Transaksi Operasional</div>
            </div>
        </div>

        <a href="{{ route('admin.transaksi_operasional') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.transaksi_operasional.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="card-body">
                    <div class="row">
                        <!-- Keterangan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input 
                                    id="keterangan" 
                                    type="text" 
                                    class="form-control" 
                                    name="keterangan" 
                                    required>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Pilihan Kategori Operasional -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kategori_operasional_id">Pilih Kategori Operasional</label>
                                <div id="dynamic-fields">
                                    <!-- Dynamic input fields will be appended here -->
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <select 
                                                name="kategori_operasional_id[]" 
                                                class="form-control" 
                                                required>
                                                <option value="" disabled selected>Pilih Kategori</option>
                                                @foreach ($kategori_operasionals as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->jenis_operasional }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input 
                                                type="number" 
                                                name="biaya[]" 
                                                class="form-control" 
                                                placeholder="biaya" 
                                                required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success" id="add-row">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Pilih setidaknya satu kategori operasional!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-left">
                    <button type="submit" class="btn btn-icon icon-left btn-blue">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addRowBtn = document.getElementById('add-row');
        const dynamicFields = document.getElementById('dynamic-fields');

        addRowBtn.addEventListener('click', function () {
            const row = `
                <div class="form-group row">
                    <div class="col-md-6">
                        <select name="kategori_operasional_id[]" class="form-control" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($kategori_operasionals as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->jenis_operasional }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input 
                            type="number" 
                            name="biaya[]" 
                            class="form-control" 
                            placeholder="Biaya" 
                            required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-row">-</button>
                    </div>
                </div>
            `;
            dynamicFields.insertAdjacentHTML('beforeend', row);

            // Add remove functionality
            const removeBtns = document.querySelectorAll('.remove-row');
            removeBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    btn.parentElement.parentElement.remove();
                });
            });
        });
    });
</script>
@endsection
