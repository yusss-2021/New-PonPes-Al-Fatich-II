@extends('frontend::layouts.master', ['title' => "Detail Wakaf - $wakaf->title"])
@section('content')
    <div class="container-fluid py-4">
        <!-- kontent-up -->
        <div class="row m-0 p-0 mt-4">
            <div class="col-sm-12 col-xl-7">
                <img src="{{ asset("storage/$wakaf->image") }}" alt="img-jumbotron" class="img-fluid w-100 rounded shadow"
                    style="filter: brightness(70%);" />
            </div>
            <div class="col-sm-12 col-xl-5 p-3">
                <h1>{{ ucfirst($wakaf->title) }}</h1>
                <div class="donation-information">
                    <hr />
                    <!-- total-donation -->
                    <div class="row pt-3 information-total">
                        <div class="col">
                            <span class="d-block font-14"> Terkumpul </span>
                            <span class="d-block font-terkumpul"> {{ $wakaf->getRaisedAmount() }} </span>
                        </div>
                        <div class="col">
                            <span class="d-block font-14"> Dana Di butuhkan </span>
                            <span class="d-block font-umum"> {{ $wakaf->getTargetAmount() }} </span>
                        </div>
                    </div>
                    <!-- progress -->
                    <div class="information-progress py-3">
                        <div class="progress" role="progressbar" aria-valuenow="{{ $wakaf->getAvgAmount() }}"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-primary" style="width: {{ $wakaf->getAvgAmount() }}%">
                                {{ $wakaf->getAvgAmount() }}%</div>
                        </div>
                    </div>
                    <!-- terkumpul berapa hari -->
                    <div class="information-day">
                        <div class="row">
                            <div class="col">
                                <span class="font-14"> Tersisa </span>
                            </div>
                            <div class="col">
                                {!! $wakaf->getLastDays() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- terkumpul berapa hari -->
                <div class="button-donation mt-4">
                    <a href="{{ route('frontend.wakaf.donate', $wakaf->id) }}" class="btn btn-success btn-lg w-100">
                        Wakaf sekarang
                    </a>
                </div>
            </div>
        </div>
        <!-- kontent-down -->
        <div class="row m-0 p-0 mt-3">
            <div class="col col-xl-8 mr-auto">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-informasi-tab" data-bs-toggle="tab"
                            data-bs-target="#informasi-tab-pane" type="button" role="tab" aria-selected="true"
                            aria-controls="infomasi-tab-pane">Infomasi</button>
                        <button class="nav-link" id="nav-donatur-tab" data-bs-toggle="tab"
                            data-bs-target="#donatur_wakaf_tanah" type="button" role="tab"
                            aria-controls="donatur_wakaf_tanah" aria-selected="false">Donatur</button>
                        <button class="nav-link" id="nav-laporan-tab" data-bs-toggle="tab"
                            data-bs-target="#laporan-tab-pane" type="button" role="tab"
                            aria-controls="laporan-tab-pane" aria-selected="false">Laporan</button>
                    </div>
                </nav>
            </div>
        </div>
        <div class="tab-content">
            <div id="informasi-tab-pane" class="tab-pane fade show active" role="tabpanel" tabindex="0">
                <div class="col col-xl-8 mr-auto">
                    <p class="mt-3 ">
                        {{ $wakaf->description }}
                    </p>
                </div>
            </div>
            <div id="donatur_wakaf_tanah" class="tab-pane fade" role="tabpanel" tabindex="0">
                <div class="col col-xl-8 mr-auto">
                    <ul class="list-donatur">
                        @foreach ($donaturs as $donatur)
                            <li class="m-3 row shadow-sm rounded p-2 pt-3 bg-white pb-2"
                                style="margin-left: -4% !important;width: 100%;">
                                <div class="col-2 icon-donatur mt-2">
                                    <div class="p-2 rounded rounded-circle bg-white border text-center"
                                        style="width: 50px;height:50px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px;height:30px;"
                                            viewBox="0 0 448 512">
                                            <path
                                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-5 keterangan-donatur">
                                    <h3 class="fs-5">
                                        {{ ucfirst($donatur->name == 'hamba_allah hamba_allah' ? 'Hamba Allah' : $donatur->name) }}
                                    </h3>
                                    <span class="d-block">
                                        Berdonasi Sebesar : <b>{{ $donatur->payment->getAmountRupiah() }}</b>
                                    </span>
                                    <spa style="font-size: 13px;font-weight:bold;">
                                        {{ $donatur->payment->getCreatedAt() }}
                                        </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="laporan-tab-pane" class="tab-pane fade" role="tabpanel" tabindex="0">
                <h5>Laporan Pembangunan Gedung</h5>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#mnWakaf').addClass('active');
    </script>
@endpush
