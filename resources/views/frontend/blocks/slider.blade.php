  <!-- Carousel Start -->
  <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="owl-carousel header-carousel position-relative">
          @foreach ($sliders as $slider)
              <div class="owl-carousel-item position-relative"
                  data-dot="<img src='{{ $slider->getFirstMediaUrl('image') }}'>">
                  <img class="img-fluid slider-img-fluid" src="{{ $slider->getFirstMediaUrl('image') }}"
                      alt="{{ $slider->title }}">
                  <div class="owl-carousel-inner">
                      <div class="container">
                          <div class="row justify-content-start">
                              <div class="col-10 col-lg-8">
                                  @if ($slider->title)
                                      <h2 class="display-2 text-white animated slideInDown">
                                          {{ $slider->title }}
                                      </h2>
                                  @endif
                                  @if ($slider->description)
                                      <p class="fs-5 fw-medium text-white mb-4 pb-3">
                                          {!! $slider->description !!}
                                      </p>
                                  @endif
                                  @if ($slider->link)
                                      <a href="{{ $slider->link }}" target="_blank" rel="nofollow"
                                          class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">{{ __('pages.read_more') }}</a>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
  </div>
  <!-- Carousel End -->
