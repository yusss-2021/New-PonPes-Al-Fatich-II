@extends('frontend::layouts.master')
@section('content')
    <div class="container pt-3">
        <nav class="mx-3"
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="#" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wakaf Tanah</li>
            </ol>
        </nav>
        <!-- kontent-up -->
        <div class="row m-0 p-0 mt-4">
            <div class="col-sm-12 col-xl-7">
                <img src="https://alfatich.my.id/_next/image?url=https%3A%2F%2Fpanelponpesalfatich2staging.jnologi.my.id%2Fstorage%2Fuploads%2Fwakaf%2Fbangunan-3.jpg&w=3840&q=75"
                    alt="img-jumbotron" class="img-fluid" style="filter: brightness(70%);" />
            </div>
            <div class="col-sm-12 col-xl-5 p-3">
                <h1>Wakaf Tanah Untuk Pembangunan Pondok Pesantren Al Fatich II</h1>
                <div class="donation-information">
                    <hr />
                    <!-- total-donation -->
                    <div class="row pt-3 information-total">
                        <div class="col">
                            <span class="d-block font-14"> Terkumpul </span>
                            <span class="d-block font-terkumpul"> 381.000 </span>
                        </div>
                        <div class="col">
                            <span class="d-block font-14"> Dana Di butuhkan </span>
                            <span class="d-block font-umum"> 100.000.000 </span>
                        </div>
                    </div>
                    <!-- progress -->
                    <div class="information-progress py-3">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!-- terkumpul berapa hari -->
                    <div class="information-day">
                        <div class="row">
                            <div class="col">
                                <span class="font-14"> Tersisa </span>
                            </div>
                            <div class="col">
                                <span class="font-14"> <strong>180</strong> HARI LAGI</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- terkumpul berapa hari -->
                <div class="button-donation mt-3">
                    <button type="button" class="btn btn-success btn-lg w-100">
                        Wakaf sekarang
                    </button>
                </div>
            </div>
        </div>
        <!-- kontent-down -->
        <div class="row m-0 p-0 mt-3">
            <div class="col col-xl-8 mr-auto">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a id="btn-iw" class="nav-link" aria-current="page" href="#">Informasi Wakat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">donatur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="informasi_wakaf_tanah" class=" row m-0 p-0 mt-3">
            <div class="col col-xl-8 mr-auto">
                <div class="text-wakaf">
                    <p class="custom-p">
                        Di Kecamatan Patrang, Kabupaten Jember, Jawa Timur keberadaan
                        masjid dan sarana pendidikan tidak hanya mencerminkan pusat ibadah
                        semata, tapi menjadi simbol kehidupan masyarakat yang berakar pada
                        nilai-nilai agama dan pendidikan. Sebagai pusat pendidikan
                        masyarakat, masjid dan sarana pendidikan MWC NU Patrang, Jember
                        berperan sentral dalam membentuk karakter, memperdalam pengetahuan
                        agama, dan membangun keterampilan bagi setiap individu, khususnya
                        para pelajar.
                    </p>
                    <p class="custom-p">
                        Keberadaan masjid dan sarana pendidikan ini diharapkan dapat
                        membawa manfaat yang sangat besar bagi masyarakat di Kecamatan
                        Patrang khususnya dan di Kabupaten Jember secara umum. Masjid ini
                        nantinya tidak hanya menyediakan tempat ibadah yang nyaman dan
                        sejuk, tetapi juga menyediakan ruang untuk memperkuat hubungan
                        sosial antar warga.
                    </p>
                </div>
            </div>
        </div>
        <div id="donatur_wakaf_tanah" class="d-none row m-0 p-0 mt-3">
            <div class="col col-xl-8 mr-auto">
                <ul class="list-donatur">
                    <li class="m-3 row shadow-sm rounded p-2 pt-3 bg-white pb-2"
                        style="margin-left: -4% !important;width: 100%;">
                        <div class="col-2 icon-donatur mt-2">
                            <div class="p-2 rounded rounded-circle bg-white border text-center"
                                style="width: 50px;height:50px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px;height:30px;"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-5 keterangan-donatur">
                            <h3 class="fs-5">
                                Hamba Allah
                            </h3>
                            <span class="d-block">
                                Berdonasi Sebesar : <b>Rp 50.000</b>
                            </span>
                            <spa style="font-size: 13px;font-weight:bold;">
                                25 Mei 2024
                                </span>
                        </div>
                    </li>
                    <li class="m-3 row shadow-sm rounded p-2 pt-3 bg-white pb-2"
                        style="margin-left: -4% !important;width: 100%;">
                        <div class="col-2 icon-donatur mt-2">
                            <div class="p-2 rounded rounded-circle bg-white border text-center"
                                style="width: 50px;height:50px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px;height:30px;"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-5 keterangan-donatur">
                            <h3 class="fs-5">
                                Hamba Allah
                            </h3>
                            <span class="d-block">
                                Berdonasi Sebesar : <b>Rp 50.000</b>
                            </span>
                            <spa style="font-size: 13px;font-weight:bold;">
                                25 Mei 2024
                                </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
