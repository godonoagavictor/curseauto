<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('frontend.layouts.head')

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-55JTPNK" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @include('frontend.layouts.spinner')
    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
    <script
        src="{{ asset('assets/frontend/js/toastify-js.js') }}?cache={{ filemtime(public_path('assets/frontend/js/toastify-js.js')) }}">
    </script>
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
    @if (session('toast.message'))
        <script>
            Toastify({
                text: "{{ session('toast.message') ?? ' ' }}",
                duration: 4000,
                newWindow: true,
                close: false,
                gravity: "top", // top or bottom
                position: "right", // left, center or right
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, {{ session('toast.gradient', '#32C36C, #32C36C') }})",
                }
            }).showToast();
        </script>
    @endif
    @if (session('toast.error'))
        <script type="text/javascript" src="{{ asset('assets/frontend/js/toastify-js.js') }}"></script>
        <script>
            Toastify({
                text: "{{ session('toast.error') ?? ' ' }}",
                duration: 4000,
                newWindow: true,
                close: false,
                gravity: "top", // top or bottom
                position: "right", // left, center or right
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, {{ session('toast.gradient', '#dc3545, #dc3545') }})",
                }
            }).showToast();
        </script>
    @endif
</body>

</html>
