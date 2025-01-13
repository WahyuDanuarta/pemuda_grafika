@extends('layouts.admin.main')
@section('title', 'Admin Kecil Transaksi Produk')

@section('content')
<div class="main-content">
    <section class="section">
        <!-- Header Section -->
        <div class="section-header">
            <h1>Tambah Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.transaksi_produks') }}">Produk</a>
                </div>
                <div class="breadcrumb-item">Tambah Produk</div>
            </div>
        </div>

        <!-- Back Button -->
        <a href="{{ route('admin.transaksi_produks') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <!-- Form Section -->
        <div class="card">
            <form action="{{ route('admin.transaksi_produks.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="card-body">
                    <div class="row">
                        <!-- Nama Transaksi Produk -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="nama">Nama Transaksi Produk</label>
                                <input id="nama" type="text" class="form-control" name="nama" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>

                        <!-- Keterangan Transaksi Produk -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="keterangan">Keterangan Transaksi Produk</label>
                                <input id="keterangan" type="text" class="form-control" name="keterangan" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Alamat Transaksi Produk -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="alamat">Alamat Transaksi Produk</label>
                                <input id="alamat" type="text" class="form-control" name="alamat" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pesanan diterima">Pesanan Diterima</option>
                                    <option value="proses desain">Proses Desain</option>
                                    <option value="proses revisi">Proses Revisi</option>
                                    <option value="proses cetak">Proses Cetak</option>
                                    <option value="bisa diambil">Bisa Diambil</option>
                                    <option value="sudah diambil (selesai)">Sudah Diambil (selesai)</option>
                                    <option value="pesanan batal">Pesanan Batal</option>
                                </select>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>
                    </div>

                    <!-- Produk Dinamis -->
                    <div id="produk-wrapper">
                        <div class="row produk-item mb-3">
                            <!-- Pilih Produk -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="produk_id">Produk</label>
                                    <select id="produk_id" class="form-control" name="produk_id[]" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($produks as $produk)
                                            <option value="{{ $produk->id }}" data-stok="{{ $produk->stok }}">{{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Kolom ini harus diisi!</div>
                                </div>
                            </div>

                            <!-- Total Produk -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="total_produk">Total Produk</label>
                                    <input id="total_produk" type="number" class="form-control" name="total_produk[]" required>
                                    <div class="invalid-feedback">Kolom ini harus diisi!</div>
                                </div>
                            </div>

                            <!-- Stok Produk -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stok_produk">Stok Produk</label>
                                    <input id="stok_produk" type="number" class="form-control" readonly>
                                </div>
                            </div>

                            <!-- Hapus Produk -->
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-produk">
                                    <i class="fas fa-times"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit dan Tambah Produk -->
                    <div class="d-flex justify-content-between mt-4">
                        <!-- Tambah Produk -->
                        <button type="button" id="add-produk" class="btn btn-success btn-sm mt-3 mr-3">
                            <i class="fas fa-plus"></i> Tambah Produk
                        </button>

                        <!-- Tambah Transaksi -->
                        <button type="submit" class="btn btn-blue btn-lg">
                            <i class="fas fa-plus"></i> Tambah Transaksi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- Script for Dynamic Products -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const produkWrapper = document.getElementById('produk-wrapper');
        const addProdukBtn = document.getElementById('add-produk');

        // Add new product row
        addProdukBtn.addEventListener('click', function () {
            const newProduk = document.querySelector('.produk-item').cloneNode(true);
            newProduk.querySelectorAll('input, select').forEach(input => input.value = '');
            produkWrapper.appendChild(newProduk);
        });

        // Remove product row
        produkWrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-produk') || e.target.closest('.remove-produk')) {
                const produkItem = e.target.closest('.produk-item');
                if (document.querySelectorAll('.produk-item').length > 1) {
                    produkItem.remove();
                } else {
                    alert('Minimal harus ada satu produk.');
                }
            }
        });

        // Update product stock dynamically
        produkWrapper.addEventListener('change', function (e) {
            if (e.target.id === 'produk_id') {
                const selectedOption = e.target.selectedOptions[0];
                const stok = selectedOption ? selectedOption.getAttribute('data-stok') : 0;
                const stokInput = e.target.closest('.produk-item').querySelector('#stok_produk');
                stokInput.value = stok;
            }
        });
    });
</script>
@endsection