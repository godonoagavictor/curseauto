   <!-- Footer Start -->
   <div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
       <div class="container py-5">
           <div class="row g-5">
               <div class="col-lg-4 col-md-6">
                   <h4 class="text-white mb-4">{{ __('pages.contacts') }}</h4>
                   @if (nova_get_setting('phone'))
                       <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>
                           <a href="tel:{{ nova_get_setting('phone') }}">{{ nova_get_setting('phone') }}</a>
                       </p>
                   @endif
                   @if (nova_get_setting('phone_2'))
                       <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>
                           <a href="tel:{{ nova_get_setting('phone_2') }}">{{ nova_get_setting('phone_2') }}</a>
                       </p>
                   @endif
                   @if (nova_get_setting('email'))
                       <p class="mb-2"><i class="fa fa-envelope me-3"></i>
                           <a href="mailto:{{ nova_get_setting('email') }}">{{ nova_get_setting('email') }}</a>
                       </p>
                   @endif
                   <div class="d-flex pt-2">
                       @if (nova_get_setting('facebook'))
                           <a target="_blank" class="btn btn-square btn-outline-light btn-social"
                               href="{{ nova_get_setting('facebook') }}"><i class="fab fa-facebook-f"></i></a>
                       @endif
                       @if (nova_get_setting('instagram'))
                           <a target="_blank" class="btn btn-square btn-outline-light btn-social"
                               href="{{ nova_get_setting('instagram') }}"><i class="fab fa-instagram"></i></a>
                       @endif
                   </div>
               </div>
               <div class="col-lg-4 col-md-6">
                   <h4 class="text-white mb-4">{{ __('pages.menu') }}</h4>
                   <a class="btn btn-link" href="{{ route('frontend.homepage') }}">{{ __('menu.homepage') }}</a>
                   <a class="btn btn-link" href="{{ static_route('about-us') }}">{{ __('menu.about') }}</a>
                   <a class="btn btn-link" href="{{ route('frontend.countries') }}">{{ __('menu.countries') }}</a>
                   <a class="btn btn-link" href="{{ static_route('contacts') }}">{{ __('menu.contacts') }}</a>
                   @if (static_route('privacy-policy'))
                       <a class="btn btn-link"
                           href="{{ static_route('privacy-policy') }}">{{ __('menu.privacy_policy') }}</a>
                   @endif

               </div>
               <div class="col-lg-4 col-md-6">
                   <h4 class="text-white mb-4">{{ __('menu.countries') }}</h4>
                   <div class="row g-2">
                       @for ($i = 1; $i < 7; $i++)
                           <div class="col-4">
                               <img class="img-fluid rounded footer-img-fluid" style="height: 100%; object-fit:cover; max-height: 70px"
                                   src="{{ asset('assets/frontend/img/gallery-' . $i . '.png') }}" alt="gallery" . $i>
                           </div>
                       @endfor
                   </div>
               </div>
           </div>
       </div>
       <div class="container">
           <div class="copyright">
               <div class="row">
                   <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                       &copy; <a href="{{ route('frontend.homepage') }}">curseauto.md</a>,
                       {{ __('pages.all_rigts') }}
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- Footer End -->
