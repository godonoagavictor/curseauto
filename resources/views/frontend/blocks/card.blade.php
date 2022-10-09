<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-4 display-5">{{ __('pages.curses') }}</h1>
        </div>
        <div class="row g-4">
            @foreach ($itineraries as $itinerary)
                <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.itinerary', ['itinerary' => $itinerary->slug]) }}"
                    class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" style="height: 260px; width: 100%; object-fit: cover;"
                            src='{{ $itinerary->getFirstMediaUrl('image') }}' alt="{{ $itinerary->title }}">
                        <div class="position-relative">
                            <div class="service-icon">
                                <img src="{{ $itinerary->getFirstMediaUrl('tour_image') }}"
                                    alt="{{ $itinerary->title }}">
                            </div>
                            <div class="service-icon service-icon-right">
                                <img src="{{ $itinerary->getFirstMediaUrl('retour_image') }}"
                                    alt="{{ $itinerary->title }}">
                            </div>
                            <div class="service-item-text">
                                <h3 class="mb-3">{{ $itinerary->title }}</h3>
                                <h4>{{ $itinerary->price }}</h4>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
