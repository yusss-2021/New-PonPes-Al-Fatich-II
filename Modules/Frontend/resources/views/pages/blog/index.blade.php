@extends('frontend::layouts.master', ['title' => 'Berita'])
@section('content')
    <div class="container-fluid bg-light py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h1 class="display-4 mb-4">{{ $blogCms->title }}</h1>
            <p class="mb-0">{{ $blogCms->description }}</p>
        </div>
        <div class="row g-4">
            <div class="col-md-8 col-lg-8 col-xl-8 blog wow fadeInUp" data-wow-delay="0.2s">
                <div class="card card-body">
                    @foreach ($blogs as $blog)
                        @php
                            $delay = $loop->iteration + 2;
                        @endphp
                        <div class="row g-4 ">
                            <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.{{ $delay }}s">
                                <div class="blog-item">
                                    <div class="blog-img">
                                        <img src="{{ asset('storage/' . $blog->attachment) }}"
                                            class="img-fluid rounded-top w-100" alt="">
                                        <div class="blog-categiry py-2 px-4">
                                            <span>{{ $blog->category?->title }}</span>
                                        </div>
                                    </div>
                                    <div class="blog-content p-4">
                                        <div class="blog-comment d-flex justify-content-between mb-3">
                                            <div class="small"><span class="fa fa-user text-primary"></span> Admin</div>
                                            <div class="small"><span class="fa fa-calendar text-primary"></span>
                                                {{ $blog->getSelisihTanggal() }}</div>
                                        </div>
                                        <a href="{{ route('frontend.blog.show', $blog->id) }}"
                                            class="h4 d-inline-block mb-3">{{ $blog->title }}</a>
                                        <div class="mb-1 text-truncate" style="max-width: 200px;">
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
                                        <a href="{{ route('frontend.blog.show', $blog->id) }}" class="btn p-0">Read More <i
                                                class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="py-2">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card card-body mb-3">
                    <h5 class="mb-4">Berita Terbaru</h5>
                    <div class="list-group list-group-flush">
                        @foreach ($news as $new)
                            @php
                                $delayNew = $loop->iteration + 2;
                            @endphp
                            <a href="#" class="list-group-item list-group-item-action wow fadeInUp"
                                data-wow-delay="0.{{ $delayNew }}s" aria-current="true">
                                <div class="row g-4">
                                    <div class="col-3">
                                        <img src="{{ asset('storage/' . $new->attachment) }}" class="img-fluid"
                                            alt="{{ $new->slug }}">
                                    </div>
                                    <div class="col-9">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ $new->title }}</h5>
                                            <small>{{ $new->getSelisihTanggal() }}</small>
                                        </div>
                                        <div class="mb-1 text-truncate" style="max-width: 100px;">
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
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4 pb-4">Kategori</h5>
                        <div class="row g-4 border-top mb-3">
                            @foreach ($categories as $category)
                                <div class="col-6">
                                    <a href="" class="category-item">
                                        <i class="fas fa-link"></i>
                                        <span>{{ $category->title }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .category-item {
            padding: 1rem;
            border-radius: 0.5rem;
            background-color: #f5f5f5;
        }
    </style>
@endpush
