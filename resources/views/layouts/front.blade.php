<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('frontend') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('frontend') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('frontend') }}/assets/css/style.css" rel="stylesheet">


</head>

<body>

    <!-- ======= Header ======= -->
    @include('layouts.partials.front_header')
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    @include('layouts.partials.front_hero')
    <!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        @include('layouts.partials.front_about')
        <!-- End About Section -->

        <!-- ======= Features Section ======= -->
        @include('layouts.partials.front_feature')
        <!-- End Features Section -->

        <!-- ======= Counts Section ======= -->
        @include('layouts.partials.front_count')
        <!-- End Counts Section -->

        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Gallery</h2>
                    <p>Check our Gallery</p>
                </div>

                <div class="row g-0" data-aos="fade-left">
                    @foreach ($postingan as $post)
                        <div class="col-lg-3 col-md-4">
                            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
                                <a href="{{ Storage::url($post->path_image) }}" class="gallery-lightbox">
                                    <img src="{{ Storage::url($post->path_image) }}" alt="" class="img-fluid" style="height: 120px;">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Gallery Section -->
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('layouts.partials.front_footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/php-email-form/validate.js"></script>

    @stack('scripts_vendor')
    <!-- Template Main JS File -->
    <script src="{{ asset('frontend') }}/assets/js/main.js"></script>

    <script src="{{ asset('/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('/AdminLTE') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="{{ asset('/AdminLTE') }}/plugins/flot/plugins/jquery.flot.pie.js"></script>



    @stack('scripts')

</body>

</html>
