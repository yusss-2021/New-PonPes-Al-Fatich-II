<?php

use Illuminate\Support\Facades\Route;

Route::name('Frontend')->get('/', function () {
    return view('frontend::index');
});
Route::name('Wakaftanah')->get('/Wakaftanah', function () {
    return view('frontend::Wakaf_tanah');
});
Route::name('berita')->get('/berita', function () {
    return view('frontend::berita');
});
Route::name('Tentang-kami')->get('/Tentang-kami', function () {
    return view('frontend::Tentang_kami');
});
Route::name('Galleri')->get('/Galleri', function () {
    return view('frontend::galleri');
});
Route::name('donasi')->get('/donasi', function () {
    return view('frontend::program');
});
