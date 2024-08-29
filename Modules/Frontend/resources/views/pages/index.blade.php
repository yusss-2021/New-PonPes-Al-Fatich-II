@extends('frontend::layouts.master', ['title' => 'Home'])
@section('content')
    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">
        @foreach ($herosections as $hero)
            <div class="header-carousel-item bg-primary">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <h1 class="display-1 text-white mb-4">{{ $hero->title }}</h1>
                                    <p class="mb-5 fs-5">{{ $hero->description }}</p>
                                    <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                        @if ($hero->cta !== null)
                                            <a class="btn btn-dark rounded-pill py-3 px-4 px-md-5 ms-2"
                                                href="{{ $hero->cta }}">Selengkapnya</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 animated fadeInRight">
                                <div class="calrousel-img" style="object-fit: cover;">
                                    <img src="{{ asset('storage/' . $hero->image) }}" class="img-fluid w-100"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Carousel End -->

    <div class="container-fluid bg-light py-5">
        <div class="container rounded info-donasi-container wow fadeInUp" data-wow-delay="0.2s">
            <div class="info-donasi-item wow fadeInUp" data-wow-delay="0.2s">
                <img src="{{ asset('modules/frontend/') }}/img/icons/money.png" alt=""
                    class="info-donasi-item-img-jumlah">
                <div>
                    <h5 class="text-white  mb-0">Jumlah Donasi</h5>
                    <h4 class="text-white  mb-0">{{ $totalTerkumpul }}</h4>
                </div>
            </div>
            <div class="info-donasi-item wow fadeInUp" data-wow-delay="0.4s">
                <img src="{{ asset('modules/frontend/') }}/img/icons/crowdfunding.png" alt=""
                    class="info-donasi-item-img-donatur">
                <div>
                    <h5 class="text-white  mb-0">Donatur</h5>
                    <h4 class="text-white  mb-0">{{ $totalDonatur }} Orang</h4>
                </div>
            </div>
            <div class="info-donasi-item wow fadeInUp" data-wow-delay="0.6s">
                <img src="{{ asset('modules/frontend/') }}/img/icons/target-donasi.png" alt=""
                    class="info-donasi-item-img-target">
                <div>
                    <h5 class="text-white  mb-0">Target Donasi</h5>
                    <h4 class="text-white  mb-0">{{ $targetAmount }}</h4>
                </div>
            </div>
        </div>
    </div>


    <!-- Program Start -->
    <div class="container-fluid program bg-light py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h1 class="display-4 mb-4">{{ $programCMS->title }}</h1>
                <p class="mb-0">{{ $programCMS->description }}</p>
            </div>
            <div class="row g-4">
                @foreach ($programs as $program)
                    @php
                        $delay = $loop->iteration + 2;
                    @endphp
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.{{ $delay }}s">
                        <div class="card program">
                            <div class="card-body">
                                <div style="background-image: url('{{ asset('storage/' . $program->image) }}');"
                                    class="program-img mb-3 shadow"></div>
                                <div class="d-flex flex-column justify-content-start align-items-start mb-4">
                                    <h4 class="text-truncate">{{ $program->title }}</h4>
                                    {!! $program->enddate() !!}
                                </div>
                                <p class="mb-4">{{ $program->description }}</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4 float-end" href="#">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- About Start -->
    <div class="container-fluid bg-light about pb-5">
        <div class="container pb-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content bg-white rounded p-5 h-100">
                        <h4 class="text-primary">{{ $tentangkami->slug }}</h4>
                        <h1 class="display-4 mb-4">{{ $tentangkami->title }}</h1>
                        <p>{{ $tentangkami->description }}</p>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="bg-white rounded p-5 h-100">
                        <div class="row g-4 justify-content-center">
                            <div class="col-12">
                                <div class="rounded bg-light">
                                    <img src="{{ asset("storage/{$tentangkami->image}") }}" class="img-fluid rounded w-100"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold"
                                            data-toggle="counter-up">{{ $totalDonatur }}</span>
                                        <span class="h1 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Donatur</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold"
                                            data-toggle="counter-up">{{ $totalProgram }}</span>
                                        <span class="h1 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Program</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h1 class="display-4 mb-4 text-primary">{{ $blogcms->title }}</h1>
                <p class="mb-0">{{ $blogcms->description }}</p>
            </div>
            <div class="row g-4 justify-content-center pb-5">
                @foreach ($blogs as $blog)
                    @php
                        $delay = $loop->iteration + 2;
                    @endphp
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.{{ $delay }}s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ asset("storage/{$blog->attachment}") }}" class="img-fluid rounded-top w-100"
                                    alt="">
                                <div class="blog-categiry py-2 px-4">
                                    <span>{{ $blog->category?->title ?? 'Uncategorized' }}</span>
                                </div>
                            </div>
                            <div class="blog-content p-4">
                                <div class="blog-comment d-flex justify-content-between mb-3">
                                    <div class="small"><span class="fa fa-user text-primary"></span> Admin</div>
                                    <div class="small"><span class="fa fa-calendar text-primary"></span>
                                        {{ $blog->created_at }}
                                    </div>

                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">{{ $blog->title }}</a>
                                <div class="mb-3 text-truncate" style="max-width: 200px;">
                                    @php
                                        $html = $blog->content;
                                        $pattern = '/<figure\b[^>]*>(.*?)<\/figure>/is';
                                        if (preg_match($pattern, $html)) {
                                            $cleanHtml = preg_replace($pattern, '', $html);
                                        } else {
                                            $cleanHtml = $html;
                                        }
                                    @endphp
                                    {!! $cleanHtml !!}
                                </div>
                                <a href="#" class="btn p-0">Read More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center wow fadeInUp pb-0 mb-0" data-wow-delay="0.7s">
                <a href="{{ route('frontend.blog.index') }}" class="btn btn-primary rounded-pill">Lebih Lengkap...</a>
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
