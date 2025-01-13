@extends('layouts.admin.main')
@section('title', 'Admin Edit Transaksi Produk')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Transaksi Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.transaksi_produks') }}">Transaksi Produk</a>
                </div>
                <div class="breadcrumb-item">Edit Transaksi Produk</div>
            </div>
        </div>

        <a href="{{ route('admin.transaksi_produks') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card">
            <form action="{{ route('admin.transaksi_produks.update', $transaksi_produks->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-row">
                        <!-- Nama Transaksi Produk -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="nama">Nama Transaksi Produk</label>
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $transaksi_produks->nama }}" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>

                        <!-- Keterangan Transaksi Produk -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="keterangan">Keterangan Transaksi Produk</label>
                                <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ $transaksi_produks->keterangan }}" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Alamat Transaksi Produk -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="alamat">Alamat Transaksi Produk</label>
                                <input id="alamat" type="text" class="form-control" name="alamat" value="{{ $transaksi_produks->alamat }}" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pesanan diterima" {{ $transaksi_produks->status == 'pesanan diterima' ? 'selected' : '' }}>Pesanan Diterima</option>
                                    <option value="proses desain" {{ $transaksi_produks->status == 'proses desain' ? 'selected' : '' }}>Proses Desain</option>
                                    <option value="proses revisi" {{ $transaksi_produks->status == 'proses revisi' ? 'selected' : '' }}>Proses Revisi</option>
                                    <option value="proses cetak" {{ $transaksi_produks->status == 'proses cetak' ? 'selected' : '' }}>Proses Cetak</option>
                                    <option value="bisa diambil" {{ $transaksi_produks->status == 'bisa diambil' ? 'selected' : '' }}>Bisa Diambil</option>
                                    <option value="sudah diambil (selesai)" {{ $transaksi_produks->status == 'sudah diambil (selesai)' ? 'selected' : '' }}>Sudah Diambil (selesai)</option>
                                    <option value="pesanan batal" {{ $transaksi_produks->status == 'pesanan batal' ? 'selected' : '' }}>Pesanan Batal</option>
                                </select>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>
                    </div>

                    <!-- Produk Dinamis -->
                    <div id="produk-wrapper">
                        @foreach($detailTransaksiProduks as $detail)
                        <div class="row produk-item mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="produk_id_{{ $detail->produk_id }}">Produk</label>
                                    <select id="produk_id_{{ $detail->produk_id }}" class="form-control" name="produk_id[]" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($produks as $produk)
                                            <option value="{{ $produk->id }}" {{ $produk->id == $detail->produk_id ? 'selected' : '' }}>{{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Kolom ini harus diisi!</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="total_produk_{{ $detail->produk_id }}">Jumlah Produk</label>
                                    <input id="total_produk_{{ $detail->produk_id }}" type="number" class="form-control" name="total_produk[]" value="{{ $detail->total_produk }}" required>
                                    <div class="invalid-feedback">Kolom ini harus diisi!</div>
                                </div>
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-produk">
                                    <i class="fas fa-times"></i> Hapus
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Tombol Submit dan Tombol Tambah Produk -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" id="add-produk" class="btn btn-success btn-sm mt-3 mr-3">
                            <i class="fas fa-plus"></i> Tambah Produk
                        </button>

                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const produkWrapper = document.getElementById('produk-wrapper');
        const addProdukBtn = document.getElementById('add-produk');

        // Fungsi untuk menambah produk baru
        addProdukBtn.addEventListener('click', function () {
            const newProduk = document.querySelector('.produk-item').cloneNode(true);
            newProduk.querySelectorAll('input, select').forEach(input => input.value = '');
            produkWrapper.appendChild(newProduk);
        });

        // Fungsi untuk menghapus produk
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
    });
</script>
@endsection