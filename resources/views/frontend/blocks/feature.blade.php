  <!-- Feature Start -->
  <div class="container-xxl py-5">
      <div class="container">
          <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
              <h2 class="mb-4 display-5">{{ __('pages.features') }}</h2>
          </div>
          <div class="row g-5">
              @foreach ($features as $feature)
                  <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                      <div class="d-flex align-items-center mb-4">
                          <div class="btn-lg-square bg-primary rounded-circle me-3">
                              <i class="{{ $feature->font_awesome }} text-white"></i>
                          </div>
                          @if ($feature->count)
                              <h2 class="mb-0" data-toggle="counter-up">{{ $feature->count }}</h2>
                          @endif
                      </div>
                      @if ($feature->title)
                          <h3 class="mb-3">{{ $feature->title }}</h5>
                      @endif
                  </div>
              @endforeach
          </div>
      </div>
  </div>
  <!-- Feature Start -->
