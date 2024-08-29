@extends('frontend::layouts.master', ['title' => 'Gallery Pondok Pesantren'])
@section('content')
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-center flex-column align-items-center wow fadeInUp" data-wow-delay="0.1s">
            <h2 class="text-center">{{ $galleryCms->title }}</h2>
            <p class="text-center" style="width:500px">
                {{ $galleryCms->description }}
            </p>
        </div>
        <div class="row">
            @foreach ($galleries as $gallery)
                @php
                    $delay = $loop->iteration + 2;
                @endphp
                <div class="col-12 col-md-6 col-xl-4 my-4 wow fadeInUp" data-wow-delay="0.{{ $delay }}s">
                    <div class="img-gallery-container"
                        style="background-image: url('{{ asset("storage/$gallery->image") }}')"></div>
                    <p>{{ $gallery->title }}</p>
                </div>
            @endforeach
            <div class="pt-3">{{ $galleries->links() }}</div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .img-gallery-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            height: 500px;
            width: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .img-gallery-container:hover {
            transform: scale(1.02);
            transition: 0.3s;
            behavior: smooth;
            cursor: pointer;

        }
    </style>
@endpush
