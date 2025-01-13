@extends('layouts.admin.main')
@section('title', 'Admin Edit Produk')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.produk') }}">Produk</a>
                </div>
                <div class="breadcrumb-item">Edit Produk</div>
            </div>
        </div>

        <a href="{{ route('admin.produk') }}" class="btn btn-icon icon-left btn-warning mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <!-- Nama Produk -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input id="nama_produk" type="text" class="form-control" name="nama_produk" required value="{{ old('nama_produk', $produk->nama_produk) }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <!-- Harga Produk -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="harga">Harga Produk</label>
                                <input id="harga" type="number" class="form-control" name="harga" required value="{{ old('harga', $produk->harga) }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <!-- Stok Produk -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stok">Stok Produk</label>
                                <input id="stok" type="number" class="form-control" name="stok" required value="{{ old('stok', $produk->stok) }}">
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
                                        <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Produk -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="current_image">Gambar Saat Ini</label><br>
                                @if($produk->images->isNotEmpty())
                                    <div class="row">
                                        @foreach($produk->images as $image)
                                            <div class="col-4 mb-3 d-flex align-items-center">
                                                <img src="{{ asset('images/' . $image->filename) }}" alt="Current Image" width="100" class="mr-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="deleteImage{{ $image->id }}">
                                                    <label class="form-check-label" for="deleteImage{{ $image->id }}">
                                                        Hapus
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span>Tidak ada gambar saat ini</span>
                                @endif
                            </div>

                            <div class="form-group">
 <label for="customFile">Unggah Gambar Baru</label>
                                <div class="custom-file">
                                    <input class="custom-file-input" name="images[]" id="customFile" type="file" multiple>
                                    <label class="custom-file-label" for="customFile">Pilih Gambar Baru</label>
                                </div>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" id="add-image">Tambah Gambar</button>
                            <div id="additional-images" class="mt-3"></div> <!-- Tempat untuk menambahkan input gambar baru -->
                        </div>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
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
                <input class="custom-file-input" name="images[]" type="file" required>
                <label class="custom-file-label">Pilih Gambar</label>
                <button type="button" class="btn btn-danger remove-image mt-2">Hapus</button>
            </div>
            <div class="invalid-feedback">
                Kolom ini harus diisi!
            </div>
        `;
        document.getElementById('additional-images').appendChild(newImageInput); // Menambahkan input baru di bawah kolom unggah gambar baru
    });

    // Event delegation untuk menghapus input gambar
    document.getElementById('additional-images').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-image')) {
            e.target.closest('.form-group').remove();
        }
    });
</script>
@endsection