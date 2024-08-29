@extends('frontend::layouts.master', ['title' => 'Wakaf'])
@section('content')
    <div class="container-fluid py-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h1 class="display-4 mb-4">{{ $wakafCms->title }}</h1>
            <p class="mb-0">{{ $wakafCms->description }}</p>
        </div>
        <div class="row g-4 pb-5">
            @foreach ($wakafs as $wakaf)
                @php
                    $delay = $loop->iteration + 2;
                @endphp
                <div class="col-4 wow fadeInUp" data-wow-delay="0.{{ $delay }}s">
                    <div class="card card-body">
                        <a href="{{ route('frontend.wakaf.show', $wakaf->id) }}" class="text-decoration-none">
                            <div class="img-wakaf"
                                style="background-image: url('{{ asset('storage' . '/' . $wakaf->image) }}')"></div>
                            <div class="d-flex justify-content-between align-items-center mb-3 g-4">
                                <h4 class="card-title text-truncate">{{ $wakaf->title }}</h4>
                                {!! $wakaf->getEndDate() !!}
                            </div>
                            <span class="badge bg-primary mb-4">Target: {{ $wakaf->getTargetAmount() }}</span>
                            <p class="card-text mb-3 text-truncate">{{ $wakaf->description }}</p>
                            <a href="{{ route('frontend.wakaf.show', $wakaf->id) }}"
                                class="btn btn-primary rounded-pill">Wakaf Sekarang</a>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="px-3">
            {{ $wakafs->links() }}
        </div>
    </div>
@endsection

@push('css')
    <style>
        .img-wakaf {
            background-position: auto;
            background-size: cover;
            background-repeat: no-repeat;
            height: 200px;
            margin-bottom: 1.4rem;
            border-radius: 10px;
        }
    </style>
@endpush
