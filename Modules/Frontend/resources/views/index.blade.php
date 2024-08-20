@extends('frontend::layouts.master')
@section('content')
    <div id="carouselExampleDark" class="carousel carousel-dark slide pb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000" style="height: 400px">
                <div class="carousel-caption d-none d-md-block" style="top: 25%">
                    <div class="row">
                        <div class="col text-start">
                            <h3 class="fs-1 fw-bolder">Wakaf Tanah Untuk Pembangunan Gedung</h3>
                            <p style="font-size: 1em;width:300px;margin-top:1.2em;">
                                Sisihkan sedikit rezeki anda untuk amal jariyah anda dan keluarga di kemudian hari,
                                ikut serta dalam pembangunan gedung
                            </p>
                            <div class="btn-carousel mt-2">
                                <button type="button" class="btn btn-primary py-2 fw-bold" style="width:200px">Wakaf
                                    Sekarang</button>
                            </div>
                        </div>
                        <div class="col">
                            <!--<img src="https://img.freepik.com/free-vector/abstract-blue-wave-elegant-design-transparent-background_1055-4977.jpg?w=740&t=st=1717830355~exp=1717830955~hmac=f312d7383c7663c984b82541701c7c497b447782c298f8525288c4b319861852" alt=""> -->
                        </div>
                    </div>
                </div>
            </div> <!--carousel 1-->
            <div class="carousel-item" data-bs-interval="2000" style="height: 400px">
                <div class="carousel-caption d-none d-md-block" style="top: 25%">
                    <div class="row">
                        <div class="col-7 text-start">
                            <h3 class="fs-1 fw-bolder">Donasi Untuk perkembangan pembangunan</h3>
                            <p style="font-size: 1em;width:300px;margin-top:1.2em;">
                                Dengan memberikan sedikit dari yang kita punya, kita bisa memberikan harapan bagi banyak
                                orang. Mari berdonasi sekarang
                            </p>
                            <div class="btn-carousel mt-2">
                                <button type="button" class="btn btn-primary py-2 fw-bold" style="width:200px">Donasi
                                    Sekarang</button>
                            </div>
                        </div>
                        <div class="col">
                            <!-- <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Flovepik.com%2Fimages%2Fpng-online-order.html&psig=AOvVaw2FR1nQTVDCBk0TKT2Hd9Rw&ust=1717916239039000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPja2PW2y4YDFQAAAAAdAAAAABAE" alt=""> -->
                        </div>
                    </div>
                </div>
            </div><!--carousel 2-->
        </div>

    </div>
    <div class="container-fluid  px-5" style="background-color: #55da3d;padding-bottom:50px;padding-top:70px;">
        <div class="row ">
            <div class="col-12 col-md-6 col-xl-4 text-center">
                <h3 class="fw-bold" style="font-size:1em;">
                    Jumlah Donasi
                </h3>
                <p class="fw-bold" style="font-size: 1.8em">
                    10.000.000
                </p>
            </div>
            <div class="col-12 col-md-6 col-xl-4 text-center">
                <h3 class="fw-bold" style="font-size:1em;">
                    Donatur
                </h3>
                <p class="fw-bold" style="font-size: 1.8em">
                    10 orang
                </p>
            </div>
            <div class="col-12 col-md-6 col-xl-4 text-center">
                <h3 class="fw-bold" style="font-size:1em;">
                    Target Donasi
                </h3>
                <p class="fw-bold" style="font-size: 1.8em">
                    6.000.000.000
                </p>
            </div>
        </div>
    </div><!--total donasi-->
    <div class="p-5 mb-4 bg-light rounded-3">

        <div class="container">
            <div class="row justify-content-center mt-3">
                <div class="col-sm-8 col-md-8 col-xl-6 mx-auto">
                    <div class="text-center">
                        <h3 class="mt-4">Program yang sedang berjalan</h3>
                        <span>
                            Berani berbuat baik, karena kebaikan itu akan kembali kepadamu suatu saat nanti
                        </span>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-12 col-xl-4 mx-auto my-2">
                    <div class="card text-dark">
                        <img src="https://alfatich.my.id/_next/image?url=%2Fimages%2Fbangunan-3.JPG&w=640&q=75"
                            class="card-img" alt="Program Wakaf Tanah untuk Pembangunan Gedung"
                            style="filter: brightness(70%);">
                        <div class="card-img-overlay">
                            <p class="card-text text-center fw-bolder text-white mt-5" style="font-size: 25px">Program Wakaf
                                Tanah untuk Pembangunan Gedung</p>

                            <div class="text-center">
                                <a class="btn btn-primary btn-sm px-5 rounded fw-bold fs-6" type="button" href="#">
                                    Wakaf Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 mx-auto my-2">
                    <div class="card text-dark">
                        <img src="https://alfatich.my.id/_next/image?url=%2Fimages%2Fabout-2.jpg&w=640&q=75"
                            class="card-img" alt="Program Donasi Al-Qur'an Untuk Anak Yatim"
                            style="filter: brightness(70%);height:235px;">
                        <div class="card-img-overlay">
                            <p class="card-text text-center fw-bolder text-white mt-5" style="font-size: 25px">Program
                                Donasi Al-Qur'an Untuk Anak Yatim</p>

                            <div class="text-center">
                                <a class="btn btn-primary btn-sm px-5 rounded fw-bold fs-6" type="button" href="#">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 mx-auto my-2">
                    <div class="card text-dark">
                        <img src="https://alfatich.my.id/_next/image?url=%2Fimages%2Fgallery%20(10).JPG&w=640&q=75"
                            class="card-img" alt="Program Donasi Al-Qur'an Untuk Anak Yatim"
                            style="filter: brightness(70%);height:235px;">
                        <div class="card-img-overlay">
                            <p class="card-text text-center fw-bolder text-white mt-5" style="font-size: 25px">Program
                                Santunan Anak Yatim</p>

                            <div class="text-center">
                                <a class="btn btn-primary btn-sm px-5 rounded fw-bold fs-6" type="button" href="#">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5 mb-4 my-2">

                <div class="col-6 mx-auto">
                    <div class="text-center">
                        <h3 class="mt-4">Berita</h3>
                        <span>
                            Ikuti perkembangan kami lewat berita terbaru
                        </span>
                    </div>
                </div>
            </div>
            <!--berita-->
            <div class=" row">
                <div class="col-sm-12 col-xl-6">
                    <div class="card border-0">
                        <img src="https://www.dompetdhuafa.org/wp-content/uploads/2024/04/Program-Ramadan-2024_1-1024x682.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-body px-0">
                            <div class="categori mb-4 ">
                                <span class="c-news px-4 py-2 rounded bg-dark text-light mr-1rem font-13">
                                    islam
                                </span>
                                <span class="c-date px-4 py-2 rounded border border-secondary text-dark font-13">
                                    21 Mei 2024
                                </span>
                            </div><!--categori--->

                            <h5 class="card-title">Program Ramadan 2024 Dompet Dhuafa Beri Manfaat Kepada 292 Ribu Jiwa
                            </h5>
                            <p class="card-text">JAKARTA — Dompet Dhuafa telah berhasil menyalurkan dana zakat, infak, dan
                                sedekah (ZIS) pada Ramadan 1445 H/2024 M kepada lebih dari 292.042 mustahik. Dana ZIS
                                tersebut disalurkan melalui 13 program […]</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="row flex-column">
                        <div class="col mb-3 border-bottom">
                            <div class="card border-0">
                                <div class="card-body px-0">
                                    <div class="categori mb-4 ">
                                        <span class="c-news px-4 py-2 rounded bg-dark text-light mr-1rem font-13">
                                            islam
                                        </span>
                                        <span class="c-date px-4 py-2 rounded border border-secondary text-dark font-13">
                                            21 Mei 2024
                                        </span>
                                    </div><!--categori--->
                                    <a href="#" class="card-title fs-6 text-decoration-none">
                                        Program Ramadan 2024 Dompet Dhuafa Beri Manfaat Kepada 292 Ribu Jiwa
                                    </a>
                                    <p class="card-text font-p">JAKARTA — Dompet Dhuafa telah berhasil menyalurkan dana
                                        zakat, infak, dan sedekah (ZIS) pada Ramadan 1445 H/2024 M kepada lebih dari 292.042
                                        mustahik. Dana ZIS tersebut disalurkan melalui 13 program</p>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3 border-bottom">
                            <div class="card border-0">
                                <div class="card-body px-0">
                                    <div class="categori mb-4 ">
                                        <span class="c-news px-4 py-2 rounded bg-dark text-light mr-1rem font-13">
                                            islam
                                        </span>
                                        <span class="c-date px-4 py-2 rounded border border-secondary text-dark font-13">
                                            21 Mei 2024
                                        </span>
                                    </div><!--categori--->
                                    <a href="#" class="card-title fs-6 text-decoration-none">
                                        Program Ramadan 2024 Dompet Dhuafa Beri Manfaat Kepada 292 Ribu Jiwa
                                    </a>
                                    <p class="card-text font-p">JAKARTA — Dompet Dhuafa telah berhasil menyalurkan dana
                                        zakat, infak, dan sedekah (ZIS) pada Ramadan 1445 H/2024 M kepada lebih dari 292.042
                                        mustahik. Dana ZIS tersebut disalurkan melalui 13 program</p>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3 border-bottom">
                            <div class="card border-0">
                                <div class="card-body px-0">
                                    <div class="categori mb-4 ">
                                        <span class="c-news px-4 py-2 rounded bg-dark text-light mr-1rem font-13">
                                            islam
                                        </span>
                                        <span class="c-date px-4 py-2 rounded border border-secondary text-dark font-13">
                                            21 Mei 2024
                                        </span>
                                    </div><!--categori--->
                                    <a href="#" class="card-title fs-6 text-decoration-none">
                                        Program Ramadan 2024 Dompet Dhuafa Beri Manfaat Kepada 292 Ribu Jiwa
                                    </a>
                                    <p class="card-text font-p">JAKARTA — Dompet Dhuafa telah berhasil menyalurkan dana
                                        zakat, infak, dan sedekah (ZIS) pada Ramadan 1445 H/2024 M kepada lebih dari 292.042
                                        mustahik. Dana ZIS tersebut disalurkan melalui 13 program</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex-column mt-5 bg-success p-4 text-light position-relative z-3 rounded"
                style="bottom: -20px;">
                <h3 class="d-block" style="width: 300px;">
                    Lihat perkembangan pembangunan
                </h3>
                <span class="d-block mt-3" style="width: 520px;">
                    dapatkan informasi terbaru mengenai perkembangan pembangunan yang sudah berjalan di pondok pesantren al
                    fatih
                </span>
                <img class="position-absolute rounded border d-none" style="width: 300px;right: 5%;bottom: 10%;"
                    src="https://alfatich.my.id/_next/image?url=https%3A%2F%2Fpanelponpesalfatich2staging.jnologi.my.id%2Fstorage%2Fuploads%2Fwakaf%2Fbangunan-3.jpg&w=3840&q=75"
                    alt="">
            </div><!--information build-->
        </div>
    @endsection
