@extends('frontend.layouts.app')

@section('title')
    {{ $itinerary->title }}
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5"
        style="background-image: url('{{ $itinerary->getFirstMediaUrl('image') }}')">
        <div class="overlay"></div>
        <div class="container py-3">
            <h1 class="display-3 text-center text-white mb-3 animated slideInDown">{{ $itinerary->title }}</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Quote Start -->
    <div class="container-fluid bg-light overflow-hidden px-lg-0" style="margin: 6rem 0;">
        <div class="container quote px-lg-0">
            <div class="row g-0 mx-lg-0 align-items-center">
                <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 mx-lg-0">
                        <div class="col-sm-12 px-lg-5 px-3">
                            <p>{!! $itinerary->description !!}</p>
                        </div>
                    </div>
                    <div class="row g-0 mx-lg-0">
                        <div class="col-sm-6 px-lg-5 px-3">
                            <div>
                                <h2 class="text-uppercase">{{ __('pages.tour_itinerary') }}</h2>
                                {!! $itinerary->tour_text !!}
                            </div>
                        </div>
                        <div class="col-sm-6 px-lg-5 px-3">
                            <div class="text-right">
                                <h2 class="text-uppercase">{{ __('pages.retour_itinerary') }}</h2>
                                {!! $itinerary->retour_text !!}
                            </div>
                        </div>
                    </div>
                    @if ($itinerary->itynerary_route || $itinerary->itynerary_route_details)
                        <div class="rounded position-relative px-lg-5 px-3">
                            @if ($itinerary->itynerary_route)
                                <h2 class="text-uppercase">{{ __('pages.route_itinerary') }}</h2>
                                {!! $itinerary->itynerary_route !!}
                            @endif
                            @if ($itinerary->itynerary_route_details)
                                <a href="{{ $itinerary->itynerary_route_details }}" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-map-marked-alt"></i>
                                    {{ __('pages.route_map') }} </a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-lg-6 quote-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <h3 class="mb-4">{{ __('pages.reserve_a_ticket') }}</h3>
                        <form method="POST" action="{{ route('frontend.itinerary.store', [$itinerary]) }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" name="name" required
                                        placeholder="{{ __('pages.name') }}" style="height: 55px;">
                                    @error('name')
                                        <span class="has-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="number" class="form-control border-0" name="phone" required
                                        placeholder="{{ __('pages.phone') }}" style="height: 55px;">
                                    @error('phone')
                                        <span class="has-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" style="height: 55px;" required name="count"
                                        aria-label="Default select example">
                                        <option selected>{{ __('pages.number_of_tickets') }}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    @error('count')
                                        <span class="has-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="hidden" name="itinerary_id" value="{{ $itinerary->id }}">
                                <div class="col-12 col-sm-6">
                                    <div class="form-check form-switch d-flex align-items-center" style="height: 55px;">
                                        <input class="form-check-input" name="two_way" value="1" type="checkbox"
                                            id="twoWayCheckbox">
                                        <label class="form-check-label ms-2"
                                            for="twoWayCheckbox">{{ __('pages.tour_retour_checkbox') }}</label>
                                    </div>
                                    @error('two_way')
                                        <span class="has-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary rounded-pill py-3 px-5"
                                        type="submit">{{ __('pages.send') }}</button>
                                </div>
                                <p>
                                    {{ __('pages.form_policy') }} <a
                                        href="{{ static_route('privacy-policy') }}">{{ __('menu.privacy_policy') }}</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->
@endsection
