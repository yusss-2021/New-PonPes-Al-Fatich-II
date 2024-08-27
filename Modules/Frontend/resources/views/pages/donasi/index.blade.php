@extends('frontend::layouts.master', ['title' => 'Donasi'])
@section('content')
    <div class="container-fluid py-5 bg-light">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h1 class="display-4 mb-4">{{ $donasiCms->title }}</h1>
            <p class="mb-0">{{ $donasiCms->description }}</p>
        </div>
        <div class="row pb-5 wow fadeInUp" data-wow-delay="0.3s">
            @foreach ($donasis as $donasi)
                @php
                    $delay = $loop->iteration + 3;
                @endphp
                <div class="col-sm-12 col-md-6 col-xl-4 p-3 wow fadeInUp" data-wow-delay="0.{{ $delay }}s">
                    <div class="card shadow" style="max-width: 20rem;">
                        <img src="{{ asset('storage/' . $donasi->image) }}" class="card-img-top"
                            alt="{{ $donasi->title }}" />
                        <div class="card-body information-program">
                            <h5 class="card-title text-truncate">{{ $donasi->title }}</h5>

                            <div class="row mb-3">
                                <div class="col pt-2">
                                    <span class="font-14"> Terkumpul </span>
                                </div>
                                <div class="col pt-2">
                                    <span class="float-end">{{ $donasi->formatRupiah() }}</span>
                                </div>
                            </div>
                            <a href="{{ route('frontend.donasi.action', $donasi->id) }}"
                                class="btn btn-primary w-100">Donasi sekarang</a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $donasis->links() }}
        </div>
    </div>
@endsection
