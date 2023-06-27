<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>Monitoring Ketinggian Air</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('images/icon.jpg') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/LineIcons.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.theme.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/nivo-lightbox.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/main.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/responsive.css">

    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 100%;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        /* .container {
            padding: 2px 16px;
        } */
    </style>

</head>

<body>

 <!-- Header Section Start -->
    <header id="home">


        <nav class="navbar navbar-expand-md bg-inverse menu-bg">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand"><img src="{{ asset('frontend') }}/img/logo1.jpg"
                        alt="" style="width: 35%; height:20%;"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ url('/') }}">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Header Section End -->



    <!-- Services Section Start -->
    <section id="tentang" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <img src="{{ Storage::url($post->path_image) }}" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>{{ $post->title }}</b></h4>
                            <p class="text-justify">{!! $post->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->




    <!-- Footer Section Start -->
    <footer>
        <!-- Footer Area Start -->
        <section id="footer-Content">
            <div class="copyright">
                <div class="container">
                    <!-- Star Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="site-info text-center">
                                <p>Crafted by <a href="http://uideck.com" rel="nofollow">UIdeck</a></p>
                            </div>

                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
            </div>
            <!-- Copyright End -->
        </section>
        <!-- Footer area End -->

    </footer>
    <!-- Footer Section End -->


    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{ asset('frontend') }}/js/jquery-min.js"></script>
    <script src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.nav.js"></script>
    <script src="{{ asset('frontend') }}/js/scrolling-nav.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.easing.min.js"></script>
    <script src="{{ asset('frontend') }}/js/nivo-lightbox.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/main.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


</body>

</html>
