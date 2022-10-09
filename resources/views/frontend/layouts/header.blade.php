<header>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark p-0 pt-2 pb-2">
        <div class="row gx-0">
            <div class="col-12">
                <div class="d-flex justify-content-center flex-wrap justify-content-sm-end text-end">
                    @if (nova_get_setting('phone'))
                        <div class="d-inline-flex align-items-center me-4">
                            <small class="fa fa-phone-alt text-primary me-2"></small>
                            <a href="tel:{{ nova_get_setting('phone') }}">{{ nova_get_setting('phone') }}</a>
                        </div>
                    @endif
                    @if (nova_get_setting('phone_2'))
                        <div class="d-inline-flex align-items-center me-4">
                            <small class="fa fa-phone-alt text-primary me-2"></small>
                            <a href="tel:{{ nova_get_setting('phone_2') }}">{{ nova_get_setting('phone_2') }}</a>
                        </div>
                    @endif
                    <div class="d-flex align-items-center">
                        @if (nova_get_setting('facebook'))
                            <a target="_blank"
                                class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary"
                                href="{{ nova_get_setting('facebook') }}"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if (nova_get_setting('instagram'))
                            <a target="_blank"
                                class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary"
                                href="{{ nova_get_setting('instagram') }}"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if (nova_get_setting('email'))
                            <a target="_blank" class="btn btn-square btn-link rounded-0"
                                href="mailto:{{ nova_get_setting('email') }}"><i class="fab fa-google"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="{{ route('frontend.homepage') }}"
            class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            @if (nova_get_setting('logo'))
                <img src="{{ asset('storage/' . nova_get_setting('logo')) }}" alt="Logo">
            @else
                <h2 class="m-0 text-primary">CurseAuto</h2>
            @endif
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('frontend.homepage') }}"
                    class="nav-item nav-link @if (Route::current()->getName() == 'frontend.homepage') active @endif">{{ __('menu.homepage') }}</a>
                <a href="{{ static_route('about-us') }}"
                    class="nav-item nav-link @if (Route::current()->getName() == 'frontend.about') active @endif">{{ __('menu.about') }}</a>
                <a href="{{ route('frontend.countries') }}"
                    class="nav-item nav-link @if (Route::current()->getName() == 'frontend.countries') active @endif">{{ __('menu.countries') }}</a>
                <a href="{{ static_route('contacts') }}"
                    class="nav-item nav-link @if (Route::current()->getName() == 'frontend.contacts') active @endif">{{ __('menu.contacts') }}</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown">{{ app()->getLocale() }}</a>
                    <div class="dropdown-menu bg-light m-0 lang-dropdown-menu">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if (app()->getLocale() !== $localeCode)
                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, []) }}"
                                    class="dropdown-item">
                                    {{ strtoupper($properties['regional']) }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
</header>
