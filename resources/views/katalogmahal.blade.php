@extends('layouts.appadmin')

@section('content')
    @include('layouts.sidebar')
    <div class="content animated">
        <div class="row">
            <div class="col-lg-12">
                <h2>
                    List Katalog Mahal
                </h2>
                <p>
                    <span style="opacity: 0.5">/ admin</span> /
                    <span style="opacity: 1;">listkatalogmahal</span>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end mb-4">
                    <a href="https://converter.11zon.com/en/image-to-webp/convert-image-to-webp" target="__blank" class="btn btn-danger me-2 shadow">
                        <i class="bi bi-images me-2"></i> Convert .WEBP
                    </a>
                    <a href="{{ route('catalogue.index') }}" target="__blank" class="btn btn-success me-2 shadow">
                        <i class="bi bi-eye me-2"></i> Lihat Katalog
                    </a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Produk
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @include('actions.TambahProductMahal')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive border ps-4 pe-5 pt-3 pb-3 rounded-3 shadow">
                    <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable shadow"
                        id="katalogmahal">
                        <thead>
                            <tr>
                                <td id="td">id</td>
                                <td id="td">No.</td>
                                <td id="td">Nama Produk</td>
                                <td id="td">Gambar Produk</td>
                                <td id="td">Harga Produk</td>
                                <td id="td">Deskripsi Produk</td>
                                <td id="td">Stok Produk</td>
                                <td id="td">Satuan</td>
                                <td id="td">Opsi</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $("#katalogmahal").DataTable({
                serverSide: true,
                processing: true,
                ajax: "getkatalogmahal",
                columns: [{
                        data: "id",
                        name: "id",
                        visible: false
                    },
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: "2%",
                        className: 'align-middle ',
                        render: function(data, type, row, meta) {
                            // Mengembalikan nomor indeks dengan titik di depannya
                            return (meta.row + 1) + ".";
                        }
                    },
                    {
                        data: "nama_product",
                        name: "nama_product",
                        visible: true,
                        orderable: true,
                        className: 'align-middle ',
                    },
                    {
                        data: "gambar_product",
                        name: "gambar_product",
                        visible: false,
                        orderable: true,
                        className: 'align-middle ',
                    },
                    {
                        data: "harga_product",
                        name: "harga_product",
                        className: 'align-middle',
                        searchable: false,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            // Mengubah data menjadi format rupiah
                            return formatRupiah(data);
                        }
                    },
                    {
                        data: "deskripsi_product",
                        name: "deskripsi_product",
                        visible: true,
                        orderable: true,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            // Memisahkan deskripsi menjadi baris-baris terpisah
                            var deskripsiArray = data.split('\n');
                            var formattedDeskripsi = deskripsiArray.map(function(item) {
                                return item.trim(); // Menghapus spasi ekstra
                            }).join('<br>'); // Menggunakan <br> sebagai pemisah

                            return formattedDeskripsi;
                        }
                    },
                    {
                        data: "stok_product",
                        name: "stok_product",
                        visible: true,
                        orderable: true,
                        className: 'align-middle ',
                    },
                    {
                        data: "satuans_id",
                        name: "satuans_id",
                        visible: false,
                        orderable: false,
                        className: 'align-middle ',
                    },
                    {
                        data: "actions",
                        name: "actions",
                        orderable: false,
                        searchable: false,
                        className: 'align-middle text-center',
                        width: "5%"
                    },
                ],
                lengthMenu: [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"],
                ],
            });
            // Fungsi untuk mengubah angka menjadi format rupiah
            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                var hasil = ribuan.join('.').split('').reverse().join('');
                return "Rp " + hasil;
            }

        });

        $(".datatable").on("click", ".btn-delete", function (e) {
                e.preventDefault();

                var form = $(this).closest("form");


                Swal.fire({
                    title: "Apakah Yakin Menghapus\n",
                    text: "Data tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "bg-primary",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
    </script>
@endpush
