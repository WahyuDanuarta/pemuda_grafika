@extends('layouts.admin.main')
@section('title', 'Admin Tambah Produk')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.produk') }}">Produk</a>
                </div>
                <div class="breadcrumb-item">Tambah Produk</div>
            </div>
        </div>

        <a href="{{ route('admin.produk') }}" class="btn btn-icon icon-left btn-warning mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <!-- Nama Produk -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input id="nama_produk" type="text" class="form-control" name="nama_produk" required>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <!-- Harga Produk -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="harga">Harga Produk</label>
                                <input id="harga" type="number" class="form-control" name="harga" required>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <!-- Stok Produk -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stok">Stok Produk</label>
                                <input id="stok" type="number" class="form-control" name="stok" required>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <!-- Kategori Produk -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kategori_id">Kategori Produk</label>
                                <select id="kategori_id" class="form-control" name="kategori_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategori_produks as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi Produk -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Produk</label>
                                <textarea id="deskripsi" class="form-control" name="deskripsi" rows="5" required></textarea>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Produk -->
                        <div class="col-12">
                            <div id="image-inputs">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="images[]" id="customFile" type="file" required>
                                        <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        Kolom ini harus diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" id="add-image">Tambah Gambar</button>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Produk
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    document.getElementById('add-image').addEventListener('click', function() {
        // Buat elemen baru untuk input gambar
        const newImageInput = document.createElement('div');
        newImageInput.classList.add('form-group');
        newImageInput.innerHTML = `
            <div class="custom-file">
                <input class ="custom-file-input" name="images[]" type="file" required>
                <label class="custom-file-label">Pilih Gambar</label>
                <button type="button" class="btn btn-danger remove-image mt-2">Hapus</button>
            </div>
            <div class="invalid-feedback">
                Kolom ini harus diisi!
            </div>
        `;
        document.getElementById('image-inputs').appendChild(newImageInput);
    });

    // Event delegation untuk menghapus input gambar
    document.getElementById('image-inputs').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-image')) {
            e.target.closest('.form-group').remove();
        }
    });
</script>
@endsection