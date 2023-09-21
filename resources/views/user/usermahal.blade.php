@extends('layouts.appuser')


<div class="banner mb-5 shadow-lg">
    <img src="{{ asset('/storage/bahan/Banner.png') }}" alt="">
    <div class="banner-content">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="logo-banner">
                    <img class="sahdow" src="{{ asset('/storage/Logo/LogoArgoDorang.png') }}" alt="Logo AgroDorang">
                    <p class="fst-italic" style="color: #475889">
                        Supplier Bahan Pokok Pangan dan Bumbu Dapur.
                    </p>
                </div>
            </div>
            {{-- <div class="col-lg-6">
                <div class="row text-center ">
                    <div class="col-lg-10 banner3">
                        <img src="{{ asset('/storage/bahan/Banner1.png') }}" alt="">
                        <img src="{{ asset('/storage/bahan/Banner2.png') }}" alt="">
                        <img src="{{ asset('/storage/bahan/Banner3.png') }}" alt="">
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-lg-12 ourproduct">
            <p>
                <span class="fs-1 fw-light" style="color: #9AB957">OUR</span>
                <span class="fs-1 fw-bold" style="color: #9AB957">PRODUCT</span>
            </p>
        </div>
    </div>
    <div class="container mt-3 p-lg-5 ">
        <div class="row">
            <div class="pc">
                <div class="col-lg-12 d-flex justify-content-center">
                    @foreach ($mahals as $mahal)
                        <div class="card m-1 wadah-card shadow" style="border:solid 2px #9AB957">
                            <div class="p-3 isi">
                                <img src="{{ asset('/storage/GambarProduk/' . $mahal->gambar_product) }}"
                                    class="card-img-top" alt="..."
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold" style="color: #475889">{{ $mahal->nama_product }}</h5>
                                <p class="card-text" style="color: #9AB957">Rp
                                    {{ number_format($mahal->harga_product, 0, ',', '.') }}/Kg
                                </p>
                                <hr>
                                <div class="text-center">
                                    {{-- <a href="{{route("mahalus.show", ['mahalu'=>$mahal->id])}}" id="detail-btn"
                                        class="btn btn-light text-light shadow w-50 detail-mahal"
                                        style="background-color: #475889">Detail
                                    </a> --}}
                                    <a href="Detail" id="detail-btn"
                                        class="btn btn-light text-light shadow w-50 detail-mahal" data-bs-toggle="modal"
                                        data-bs-target="#detail" data-id="{{ $mahal->id }}"
                                        style="background-color: #475889">Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="hp">
                <div class="col-lg-12 d-flex mb-5">
                    @foreach ($mahals as $mahal)
                        <div class="card m-1 wadah-card shadow" style="border:solid 2px #9AB957">
                            <div class="p-1 isi">
                                <img src="{{ asset('/storage/GambarProduk/' . $mahal->gambar_product) }}" class=""
                                    alt="..." style="width:100%; height:75px;  object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <p class="card-title fw-bold" style="color: #475889">{{ $mahal->nama_product }}</p>
                                <p class="card-text" style="color: #9AB957">Rp
                                    {{ number_format($mahal->harga_product, 0, ',', '.') }}/Kg
                                </p>
                                <div class="text-center">
                                    <a href="Detail" class="btn btn-light text-light shadow detail"
                                        data-bs-toggle="modal" data-bs-target="#detail" data-id="{{ $mahal->id }}"
                                        style="background-color:#475889; font-size:5px;">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        @include('actions.detailmahal')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="w-footer py-lg-5 px-lg-5 py-4 px-2">
        <div class="row">
            <div class="col-lg-12">
                <img class="sahdow footer ms-lg-5 ps-lg-2" src="{{ asset('/storage/Logo/LogoArgoDorang.png') }}"
                    alt="Logo AgroDorang">
            </div>
        </div>
        <div class="row mt-lg-3 ps-lg-5 mt-2 p-4 d-flex text-center">
            <div class="col-lg-6 ps-lg-5">
                <p class="aboutme" style="text-align: justify;">
                    PT Agro Dorang Makmur Sentosa didirikan pada 2019 sebagai supplier komoditi,
                    terutama bumbu dan bahan dapur, dengan mitra terkenal. Berfokus pada kualitas produk,
                    harga bersaing, dan manajemen waktu untuk memenuhi permintaan pelanggan. Dengan demikian
                    kami berkomitmen untuk menjadi pemimpin dalam industri komoditas dengan penekanan pada kualitas,
                    kepuasan pelanggan, dan ekspansi global sebagai tujuan utamanya.
                </p>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <div class="footer-icon-pc">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start ms-3">
                        <li class="nav-item d-flex align-middle mb-3">
                            <svg class="me-3" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                viewBox="0 0 51 51" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M25.5001 45.0258L27.0326 43.2991C28.7714 41.3077 30.3354 39.4182 31.727 37.6211L32.8757 36.1057C37.6721 29.6432 40.0716 24.5141 40.0716 20.7231C40.0716 12.6311 33.5484 6.07153 25.5001 6.07153C17.4519 6.07153 10.9287 12.6311 10.9287 20.7231C10.9287 24.5141 13.3281 29.6432 18.1246 36.1057L19.2733 37.6211C21.2585 40.1648 23.3355 42.633 25.5001 45.0258Z"
                                    stroke="#475889" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M25.5001 26.7144C28.8533 26.7144 31.5716 23.9961 31.5716 20.643C31.5716 17.2898 28.8533 14.5715 25.5001 14.5715C22.147 14.5715 19.4287 17.2898 19.4287 20.643C19.4287 23.9961 22.147 26.7144 25.5001 26.7144Z"
                                    stroke="#475889" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="fs-5">Pergudangan Duta Indah Sentoha M35</span>
                        </li>
                        <li class="nav-item d-flex align-middle mb-3">
                            <svg class="me-4 ms-1" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                viewBox="0 0 39 39" fill="none">
                                <path
                                    d="M19.5 2.03125C16.4655 2.03451 13.4841 2.82743 10.849 4.33206C8.21377 5.83669 6.01554 8.00122 4.47037 10.6128C2.92521 13.2244 2.08631 16.1932 2.03617 19.2273C1.98603 22.2614 2.72636 25.2563 4.18438 27.9175L2.03125 36.9688L11.0825 34.8156C13.417 36.0963 16.0134 36.8263 18.6732 36.9499C21.3331 37.0735 23.986 36.5875 26.4292 35.5289C28.8724 34.4702 31.0413 32.8671 32.7702 30.842C34.499 28.8169 35.742 26.4233 36.4042 23.8442C37.0663 21.2652 37.1302 18.5689 36.5908 15.9614C36.0514 13.3539 34.9231 10.9042 33.292 8.7995C31.661 6.69481 29.5704 4.99083 27.18 3.81778C24.7896 2.64473 22.1627 2.03366 19.5 2.03125ZM10.7656 9.96938H15.5269C15.7424 9.96938 15.949 10.055 16.1014 10.2074C16.2538 10.3597 16.3394 10.5664 16.3394 10.7819C16.3127 11.8654 16.4948 12.944 16.8756 13.9588C17.0396 14.2984 17.0757 14.6859 16.9772 15.05C16.8787 15.4141 16.6523 15.7306 16.3394 15.9413L14.6737 17.5663C15.4123 19.0085 16.3779 20.3225 17.5337 21.4581C18.6601 22.6328 19.9689 23.6177 21.4094 24.375L23.0344 22.7094C23.8469 21.8969 24.2206 21.8969 25.0169 22.1731C26.0316 22.554 27.1102 22.736 28.1938 22.7094C28.4061 22.7193 28.607 22.808 28.7573 22.9583C28.9076 23.1086 28.9964 23.3096 29.0063 23.5219V28.2831C28.9964 28.4954 28.9076 28.6964 28.7573 28.8467C28.607 28.997 28.4061 29.0857 28.1938 29.0956C23.4143 28.8874 18.8838 26.906 15.4862 23.5381C12.1131 20.1441 10.1308 15.6115 9.92875 10.8306C9.93068 10.607 10.0187 10.3927 10.1746 10.2323C10.3305 10.0719 10.5421 9.97773 10.7656 9.96938Z"
                                    stroke="#475889" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="fs-5">082139863737 / 085707191153</span>
                        </li>
                        <li class="nav-item d-flex align-middle mb-3">
                            <svg class="me-3" xmlns="http://www.w3.org/2000/svg" width="38" height="38"
                                viewBox="0 0 45 45" fill="none">
                                <path
                                    d="M40.7812 12.6562V32.3438C40.7812 33.0897 40.4849 33.805 39.9575 34.3325C39.43 34.8599 38.7147 35.1562 37.9688 35.1562H7.03125C6.28533 35.1562 5.56996 34.8599 5.04251 34.3325C4.51507 33.805 4.21875 33.0897 4.21875 32.3438V12.6562M40.7812 12.6562C40.7812 11.9103 40.4849 11.195 39.9575 10.6675C39.43 10.1401 38.7147 9.84375 37.9688 9.84375H7.03125C6.28533 9.84375 5.56996 10.1401 5.04251 10.6675C4.51507 11.195 4.21875 11.9103 4.21875 12.6562M40.7812 12.6562L24.1003 24.2044C23.6301 24.5297 23.0718 24.7041 22.5 24.7041C21.9282 24.7041 21.3699 24.5297 20.8997 24.2044L4.21875 12.6562"
                                    stroke="#475889" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="fs-5">pt.agrodorang.makmursentosa@gmail.com</span>
                        </li>
                    </ul>
                </div>
                <div class="footer-icon-hp">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start">
                        <li class="nav-item mb-1">
                            <span style="font-size: 10px">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 51 51" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M25.5001 45.0258L27.0326 43.2991C28.7714 41.3077 30.3354 39.4182 31.727 37.6211L32.8757 36.1057C37.6721 29.6432 40.0716 24.5141 40.0716 20.7231C40.0716 12.6311 33.5484 6.07153 25.5001 6.07153C17.4519 6.07153 10.9287 12.6311 10.9287 20.7231C10.9287 24.5141 13.3281 29.6432 18.1246 36.1057L19.2733 37.6211C21.2585 40.1648 23.3355 42.633 25.5001 45.0258Z"
                                        stroke="#475889" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M25.5001 26.7144C28.8533 26.7144 31.5716 23.9961 31.5716 20.643C31.5716 17.2898 28.8533 14.5715 25.5001 14.5715C22.147 14.5715 19.4287 17.2898 19.4287 20.643C19.4287 23.9961 22.147 26.7144 25.5001 26.7144Z"
                                        stroke="#475889" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Pergudangan Duta Indah Sentoha M35
                            </span>
                        </li>
                        <li class="nav-item mb-1">
                            <span style="font-size: 10px">
                                <svg class="me-2 " xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                    viewBox="0 0 39 39" fill="none">
                                    <path
                                        d="M19.5 2.03125C16.4655 2.03451 13.4841 2.82743 10.849 4.33206C8.21377 5.83669 6.01554 8.00122 4.47037 10.6128C2.92521 13.2244 2.08631 16.1932 2.03617 19.2273C1.98603 22.2614 2.72636 25.2563 4.18438 27.9175L2.03125 36.9688L11.0825 34.8156C13.417 36.0963 16.0134 36.8263 18.6732 36.9499C21.3331 37.0735 23.986 36.5875 26.4292 35.5289C28.8724 34.4702 31.0413 32.8671 32.7702 30.842C34.499 28.8169 35.742 26.4233 36.4042 23.8442C37.0663 21.2652 37.1302 18.5689 36.5908 15.9614C36.0514 13.3539 34.9231 10.9042 33.292 8.7995C31.661 6.69481 29.5704 4.99083 27.18 3.81778C24.7896 2.64473 22.1627 2.03366 19.5 2.03125ZM10.7656 9.96938H15.5269C15.7424 9.96938 15.949 10.055 16.1014 10.2074C16.2538 10.3597 16.3394 10.5664 16.3394 10.7819C16.3127 11.8654 16.4948 12.944 16.8756 13.9588C17.0396 14.2984 17.0757 14.6859 16.9772 15.05C16.8787 15.4141 16.6523 15.7306 16.3394 15.9413L14.6737 17.5663C15.4123 19.0085 16.3779 20.3225 17.5337 21.4581C18.6601 22.6328 19.9689 23.6177 21.4094 24.375L23.0344 22.7094C23.8469 21.8969 24.2206 21.8969 25.0169 22.1731C26.0316 22.554 27.1102 22.736 28.1938 22.7094C28.4061 22.7193 28.607 22.808 28.7573 22.9583C28.9076 23.1086 28.9964 23.3096 29.0063 23.5219V28.2831C28.9964 28.4954 28.9076 28.6964 28.7573 28.8467C28.607 28.997 28.4061 29.0857 28.1938 29.0956C23.4143 28.8874 18.8838 26.906 15.4862 23.5381C12.1131 20.1441 10.1308 15.6115 9.92875 10.8306C9.93068 10.607 10.0187 10.3927 10.1746 10.2323C10.3305 10.0719 10.5421 9.97773 10.7656 9.96938Z"
                                        stroke="#475889" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                082139863737 / 085707191153
                            </span>
                        </li>
                        <li class="nav-item mb-1">
                            <span style="font-size: 10px">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                    viewBox="0 0 45 45" fill="none">
                                    <path
                                        d="M40.7812 12.6562V32.3438C40.7812 33.0897 40.4849 33.805 39.9575 34.3325C39.43 34.8599 38.7147 35.1562 37.9688 35.1562H7.03125C6.28533 35.1562 5.56996 34.8599 5.04251 34.3325C4.51507 33.805 4.21875 33.0897 4.21875 32.3438V12.6562M40.7812 12.6562C40.7812 11.9103 40.4849 11.195 39.9575 10.6675C39.43 10.1401 38.7147 9.84375 37.9688 9.84375H7.03125C6.28533 9.84375 5.56996 10.1401 5.04251 10.6675C4.51507 11.195 4.21875 11.9103 4.21875 12.6562M40.7812 12.6562L24.1003 24.2044C23.6301 24.5297 23.0718 24.7041 22.5 24.7041C21.9282 24.7041 21.3699 24.5297 20.8997 24.2044L4.21875 12.6562"
                                        stroke="#475889" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                pt.agrodorang.makmursentosa@gmail.com
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script-anda.js"></script>
<script>
    $(document).ready(function() {
        $('.detail-mahal').on('click', function() {
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: "{{ route('mahalus.show', ['mahalu' => ':id']) }}".replace(':id', id),
                method: 'GET',
                success: function(response) {
                    $('#detail .modal-content').html(response);
                }
            });
        });
    });
</script>
