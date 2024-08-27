@extends('frontend::layouts.master', ['title' => 'Tentang Kami'])
@section('content')
    <div class="container-fluid py-5">
        <div class="p-5 mb-4 bg-white shadow-sm rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-6 fw-bold border-bottom pb-3">{{ $aboutCms->title }}</h1>
                <p class="fs-5">{{ $aboutCms->content }}</p>
            </div>
        </div>
    </div>
@endsection
