@extends('layouts.appadmin')

@section('content')
    @include('layouts.sidebar')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h2>
                    Dashboard
                </h2>
                <p>
                    <span style="opacity: 0.5">/ admin</span> /
                    <span style="opacity: 1;">dashboard</span>
                </p>
            </div>
        </div>
        <div class="d-flex justify-content-center ">
            <p class="judul-dashboard">Perbandingan Harga</p>

        </div>
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="table-responsive border ps-4 pe-5 pt-3 pb-3 rounded-3 shadow">
                    <p class="fw-bold">Tabel Katalog Mahal</p>
                    <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable shadow"
                        id="katalogmahal">
                        <thead>
                            <tr>
                                <td>id</td>
                                <td id="td">No.</td>
                                <td id="td">Nama Produk</td>
                                <td>Gambar Produk</td>
                                <td id="td">Harga Produk</td>
                                <td>Deskripsi Produk</td>
                                <td>Stok Produk</td>
                                <td>Satuan</td>
                                <td>Opsi</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="table-responsive border ps-4 pe-5 pt-3 pb-3 rounded-3 shadow">
                    <p class="fw-bold">Tabel Katalog Murah</p>
                    <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable shadow"
                        id="katalogmurah">
                        <thead>
                            <tr>
                                <td>id</td>
                                <td id="td">No.</td>
                                <td id="td">Nama Produk</td>
                                <td>Gambar Produk</td>
                                <td id="td">Harga Produk</td>
                                <td>Deskripsi Produk</td>
                                <td>Stok Produk</td>
                                <td>Satuan</td>
                                <td>Opsi</td>
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
                        visible: false,
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
                        visible: false,
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
                        visible: false,
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

            $("#katalogmurah").DataTable({
                serverSide: true,
                processing: true,
                ajax: "getkatalogmurah",
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
                        visible: true,
                        orderable: true,
                        className: 'align-middle ',
                        render: function(data, type, row) {
                            // Mengubah data menjadi format rupiah
                            return formatRupiah(data);
                        }
                    },
                    {
                        data: "deskripsi_product",
                        name: "deskripsi_product",
                        visible: false,
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
                        visible: false,
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
                        visible: false,
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
    </script>
@endpush
