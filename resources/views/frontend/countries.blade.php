@extends('frontend.layouts.app')
@section('title')
    {{ __('menu.countries') }}
@endsection
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5"
        style="background-image: url({{ nova_get_setting('countries_page_breadcrumbs_image') ? asset('storage/' . nova_get_setting('countries_page_breadcrumbs_image')) : asset('assets/frontend/img/default.jpg') }}">
        <div class="overlay"></div>
        <div class="container py-3">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('menu.countries') }}</h1>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container-xxl py-5">
        @foreach ($countries as $country)
            <div class="container">
                <div class="text-left wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="mb-4">{{ $country->title }}</h2>
                </div>
                <div class="row g-4 mb-5">
                    @foreach ($country->itineraries as $itinerary)
                        <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.itinerary', ['itinerary' => $itinerary->slug]) }}"
                            class="wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item rounded overflow-hidden">
                                <div class="position-relative p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="servie-item-text">
                                            <h4 class="mb-3">{{ $itinerary->title }}</h4>
                                            <p>{{ $itinerary->price }}</p>
                                        </div>
                                        <img class="service-item-img" src="{{ $itinerary->getFirstMediaUrl('image') }}"
                                            alt="{{ $itinerary->title }}">
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
