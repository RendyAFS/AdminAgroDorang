<style>
    .foto-deatail-produk img {
        width: 100%;
        max-width: 100%;
    }
</style>


<div class="row mt-3 mb-2">
    <div class="col text-center">
        <p class="fs-5 fw-bold">{{ $mahal->nama_product }}</p>
    </div>
</div>

<div class="foto-deatail-produk">
    <img src="{{ asset('/storage/GambarProduk/' . $mahal->gambar_product) }}" alt="" loading="lazy">
</div>

<div class="footer-modal mt-4 mb-3 px-3">
    <div class="row">
        <div class="col-lg-6 col-6">
            <button type="button" class="btn btn-primary shadow" data-bs-dismiss="modal">
                <i class="bi bi-chevron-compact-left me-2"></i> Back
            </button>
        </div>
        <div class="col-lg-6 col-6">
            <p class=" fw-bold mt-1" style="color: #9AB957; font-size:18px;">
                Rp {{ number_format($mahal->harga_product, 0, ',', '.') }}/Kg
            </p>
        </div>
    </div>
</div>
