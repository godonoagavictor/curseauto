@extends('frontend.layouts.app')
@section('title')
    {{ $page->seo_title ?? '' }}
@endsection
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5"
        style="background-image: url({{ $page->seo_image ? asset('storage/' . $page->seo_image) : asset('assets/frontend/img/default.jpg') }})">
        <div class="overlay"></div>
        <div class="container py-3">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{ $page->seo_title }}</h1>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        {!! $page->data->body !!}
    </div>
@endsection
