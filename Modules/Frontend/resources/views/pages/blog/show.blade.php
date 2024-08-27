@extends('frontend::layouts.master', ['title' => $blog->title])
@section('content')
    <div class="container-fluid py-5">
        <div class="row g-4">
            <div class="col-md-8 col-lg-8 col-xl-8 blog wow fadeInUp" data-wow-delay="0.2s">
                <img src="{{ asset('storage/' . $blog->attachment) }}" loading="lazy" decoding="async"
                    class="w-100 rounded mb-3 pb-4" alt="{{ $blog->slug }}">
                <div class="blog-date mb-3">
                    <span><i class="fas fa-calendar"></i> {{ $blog->getSelisihTanggal() }}</span>
                </div>
                <h3 class="display-6 mb-3">{{ $blog->title }}</h3>
                <div class="blog-category mb-5">
                    <span> {{ $blog->category?->title }}</span>
                </div>
                <article>
                    {!! $blog->content !!}
                </article>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card card-body">
                    <h5 class="mb-4">Berita Terbaru</h5>
                    <div class="list-group">
                        @foreach ($news as $new)
                            @php
                                $delayNew = $loop->iteration + 2;
                            @endphp
                            <a href="{{ route('frontend.blog.show', $new->id) }}"
                                class="list-group-item list-group-item-action wow fadeInUp"
                                data-wow-delay="0.{{ $delayNew }}s" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $new->title }}</h5>
                                    <small>{{ $new->getSelisihTanggal() }}</small>
                                </div>
                                <div class="mb-1 text-truncate">
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
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#mnBerita').addClass('active');
    </script>
@endpush

@push('css')
    <style>
        .blog-category {
            padding: 0.4rem;
            border-radius: 0.5rem;
            font-size: 0.8rem;
            color: var(--bs-light);
            background-color: var(--bs-primary);
            max-width: max-content;
        }

        .blog-category:hover {
            cursor: pointer;
            color: var(--bs-primary);
            background-color: var(--bs-light);
        }
    </style>
@endpush
