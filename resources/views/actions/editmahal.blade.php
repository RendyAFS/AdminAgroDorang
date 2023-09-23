@extends('layouts.appadmin')
@section('content')
<div class="container mt-4 animated">
    <div class="row">
        <div class="col-lg-6">
            <div class="d-flex justify-content-center align-items-middle">
                <img class="gmbr-produk" src="{{ asset('storage/GambarProduk/' . $mahals->gambar_product) }}" alt="{{ $mahals->nama_product }}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header fs-2">
                    Edit Produk
                </div>
                <div class="card-body">
                    <form action="{{ route('mahals.update', $mahals->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- CSRF token -->
                        @method('PUT') <!-- Add this line to specify that it's an update request -->

                        <div class="form-group mt-3">
                            <label for="nama_product" class="fw-bold">Nama Produk:</label>
                            <input type="text" class="form-control border-dark" id="nama_product" name="nama_product"
                                value="{{ $mahals->nama_product }}" required>
                        </div>
                        <div class="form-group mt-3 row">
                            <div class="col-md-8">
                                <label for="harga_product" class="fw-bold ">Harga Produk:</label>
                                <input type="number" class="form-control border-dark" id="harga_product" name="harga_product"
                                    value="{{ $mahals->harga_product }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="satuans_id" class="fw-bold">Satuan</label>
                                <select name="satuans_id" id="table_satuans_id" class="form-select border-dark" required>
                                    <option value=""></option>
                                    @foreach ($satuans as $satuan)
                                        <option value="{{ $satuan->id }}"
                                            {{ $mahals->satuans_id == $satuan->id ? 'selected' : '' }}>
                                            {{ $satuan->nama_satuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="deskripsi_product" class="fw-bold">Deskripsi Produk:</label>
                            <div class="p-1">
                                <textarea style="width: 100%;" cols="100" rows="5" id="deskripsi_product" name="deskripsi_product" required>{{ $mahals->deskripsi_product }}</textarea>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="gambar_product" class="fw-bold">Gambar Product:</label>
                            <input type="file" class="form-control border-dark @error('gambar_product') is-invalid @enderror"
                                id="gambar_product" name="gambar_product" value="{{ old('gambar_product') }}">
                            @error('gambar_product')
                                <small class="text-danger text-left">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="stok_product" class="fw-bold">Stok Produk:</label>
                            <input type="text" class="form-control border-dark" id="stok_product" name="stok_product"
                                value="{{ $mahals->stok_product }}" required>
                        </div>

                        <div class="row mt-4">
                            <div class="col-3"></div>
                            <div class="col-3 d-grid">
                                <button type="submit" class="btn btn-primary shadow">Update</button>
                            </div>
                            <div class="col-3 d-grid">
                                <a href="{{route("mahals.index")}}" class="btn btn-danger me-1 shadow">
                                    Batal
                                </a>
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
