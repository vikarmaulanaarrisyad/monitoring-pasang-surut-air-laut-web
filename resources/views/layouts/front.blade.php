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

</head>

<body>

    <!-- Header Section Start -->
    <header id="home" class="hero-area">
        <div class="overlay">
            <span></span>
            <span></span>
        </div>
        <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand"><img src="{{ asset('frontend') }}/img/logo1.jpg"
                        alt="" style="width: 25%; height: 20%;"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#tentang">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#statistik">Statistik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#blog">Postingan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ route('monitoring.index') }}">Monitoring</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ route('login') }}">Login Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row space-100">
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="contents">
                        <h2 class="head-title">Sistem Monitoring Pasang Surut Air Laut</h2>
                        <p>
                            PASCAL MAULANA HERMANSYAH <br>
                            APRI NUR ABDUL KHALIM
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12 p-0">
                    <div class="intro-img">
                        {{-- <img src="{{ asset('frontend') }}/img/intro.png" alt=""> --}}
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->


    <!-- Services Section Start -->
    <section id="tentang" class="section">
        <div class="container">

            <div class="row">
                <!-- Start Col -->
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="services-item text-center">
                        <div class="icon">
                            <i class="lni-cog"></i>
                        </div>
                        <h4>Ultrasonic hc-sr04</h4>
                        <p class="text-justify">
                            HC-SR04 merupakan sensor ultrasonik siap pakai, satu alat yang berfungsi sebagai pengirim,
                            penerima, dan pengontrol gelombang ultrasonik. Alat ini bisa digunakan untuk mengukur jarak
                            benda dari 2cm - 4m dengan akurasi 3mm
                        </p>
                    </div>
                </div>
                <!-- End Col -->
                <!-- Start Col -->
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="services-item text-center">
                        <div class="icon">
                            <i class="lni-brush"></i>
                        </div>
                        <h4>Anemomete</h4>
                        <p class="text-justify">
                            Anemometer adalah sebuah alat pengujian atau biasa disebut alat pengukur kecepatan angin
                            yang biasanya digunakan dalam bidang Meteorologi dan Geofisika atau stasiun prakiraan cuaca.
                            Anemometer Berfungsi untuk mengukur atau menentukan kecepatan angin. Selain mengukur
                            kecepatan angin, alat ini juga dapat mengukur besarnya tekanan angin, cuaca, dan tinggi
                            gelombang laut
                        </p>
                    </div>
                </div>
                <!-- End Col -->
                <!-- Start Col -->
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="services-item text-center">
                        <div class="icon">
                            <i class="lni-heart"></i>
                        </div>
                        <h4>ESP8266</h4>
                        <p class="text-justify">
                            ESP8266 merupakan modul wifi yang berfungsi sebagai perangkat tambahan mikrokontroler
                            seperti Arduino agar dapat terhubung langsung dengan wifi dan membuat koneksi TCP/IP.
                            Modul ini membutuhkan daya sekitar 3.3v dengan memiliki tiga mode wifi yaitu Station, Access
                            Point dan Both (Keduanya). Modul ini juga dilengkapi dengan prosesor, memori dan GPIO dimana
                            jumlah pin bergantung dengan jenis ESP8266 yang kita gunakan.
                        </p>
                    </div>
                </div>
                <!-- End Col -->

            </div>
        </div>
    </section>
    <!-- Services Section End -->



    <!-- Business Plan Section Start -->
    {{-- <section id="business-plan">
        <div class="container">

            <div class="row">
                <!-- Start Col -->
                <div class="col-lg-6 col-md-12 pl-0 pt-70 pr-5">
                    <div class="business-item-img">
                        <img src="{{ asset('frontend') }}/img/business/business-img.png" class="img-fluid"
                            alt="">
                    </div>
                </div>
                <!-- End Col -->
                <!-- Start Col -->
                <div class="col-lg-6 col-md-12 pl-4">
                    <div class="business-item-info">
                        <h3>Crafted For Business, Startup and Agency Websites</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <br> tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim <br> veniam, quis nostrud exercitation
                            ullamco laboris nisi ut aliquip ex ea <br> commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate <br> velit esse cillum dolore eu fugiat nulla pariatur.</p>

                        <a class="btn btn-common" href="#">download</a>
                    </div>
                </div>
                <!-- End Col -->

            </div>
        </div>
    </section> --}}
    <!-- Business Plan Section End -->



    <!-- Cool Fetatures Section Start -->
    <section id="statistik" class="section">
        <div class="container">
            <!-- Start Row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="features-text section-header text-center">
                        <div>
                            <h2 class="section-title">Statistik</h2>
                            <div class="desc-text">
                                <p>
                                    Statistik Monitoring
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Row -->
            <!-- Start Row -->
            <div class="row featured-bg">
                <!-- Start Col -->
                <div class="col-lg-6 col-md-6 col-xs-12 p-0">
                    <!-- Start Fetatures -->
                    <div class="feature-item featured-border1">
                        <div class="feature-icon float-left">
                            <i class="lni-coffee-cup"></i>
                        </div>
                        <div class="feature-info float-left">
                            <h4>Kecepatan Angin</h4>
                            <p>
                            <div id="container" style="width:100%; height:400px;"></div>
                            </p>
                        </div>
                    </div>
                    <!-- End Fetatures -->
                </div>
                <!-- Start Col -->
                <div class="col-lg-6 col-md-6 col-xs-12 p-0">
                    <!-- Start Fetatures -->
                    <div class="feature-item featured-border1">
                        <div class="feature-icon float-left">
                            <i class="lni-coffee-cup"></i>
                        </div>
                        <div class="feature-info float-left">
                            <h4>Ketinggian Air</h4>
                            <p>
                            <div id="container2" style="width:100%; height:400px;"></div>
                            </p>
                        </div>
                    </div>
                    <!-- End Fetatures -->
                </div>
            </div>
            <!-- End Row -->
        </div>
    </section>
    <!-- Cool Fetatures Section End -->

    <!-- Blog Section -->
    <section id="blog" class="section">
        <!-- Container Starts -->
        <div class="container">
            <!-- Start Row -->
            <div class="row">

                <div class="col-lg-12">
                    <div class="blog-text section-header text-center">
                        <div>
                            <h2 class="section-title">Latest Blog Posts</h2>
                            <div class="desc-text">
                                <p>Postingan Terbaru</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Row -->

            <!-- Start Row -->
            <div class="row">
                <!-- Start Col -->
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6 col-xs-12 blog-item">
                        <!-- Blog Item Starts -->
                        <div class="blog-item-wrapper">
                            <div class="blog-item-img">
                                <a href="{{ route('single_post', $post->slug) }}">
                                    <img src="{{ Storage::url($post->path_image) }}" class="img-fluid"
                                        alt="" width="100%" style="height:120px">
                                </a>
                            </div>
                            <div class="blog-item-text">
                                <h3><a href="{{ route('single_post', $post->slug) }}">{{ $post->title }}</a></h3>
                                <p class="text-justify">
                                    {{-- {!! $post->short_description !!} --}}
                                    {{ substr($post->short_description, 0, 200) . '.......' }}
                                </p>
                            </div>
                            <div class="author">
                                <span class="name"><i class="lni-user"></i><a href="#">Posted by
                                        Admin</a></span>
                                <span class="date float-right"><i class="lni-calendar"></i><a
                                        href="#">{{ tanggal_indonesia($post->created_at) }}</a></span>
                            </div>
                        </div>
                        <!-- Blog Item Wrapper Ends-->
                    </div>
                @endforeach

                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
    </section>
    <!-- blog Section End -->

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
    {{-- <script src="{{ asset('frontend') }}/js/form-validator.min.js"></script> --}}
    {{-- <script src="{{ asset('frontend') }}/js/contact-form-script.js"></script> --}}
    <script src="{{ asset('frontend') }}/js/main.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        Highcharts.chart('container', {

            chart: {
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: '90%'
            },

            title: {
                text: 'Speedometer'
            },

            pane: {
                startAngle: -90,
                endAngle: 89.9,
                background: null,
                center: ['50%', '75%'],
                size: '110%'
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 50,
                tickPixelInterval: 72,
                tickPosition: 'inside',
                tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                tickLength: 20,
                tickWidth: 2,
                minorTickInterval: null,
                labels: {
                    distance: 20,
                    style: {
                        fontSize: '14px'
                    }
                },
                lineWidth: 0,
                plotBands: [{
                    from: 0,
                    to: 10,
                    color: '#55BF3B', // green
                    thickness: 20
                }, {
                    from: 10,
                    to: 25,
                    color: '#DDDF0D', // yellow
                    thickness: 20
                }, {
                    from: 25,
                    to: 50,
                    color: '#DF5353', // red
                    thickness: 20
                }]
            },

            series: [{
                name: 'Speed',
                data: [0],
                tooltip: {
                    valueSuffix: ' m/s'
                },
                dataLabels: {
                    format: '{y} m/s',
                    borderWidth: 0,
                    color: (
                        Highcharts.defaultOptions.title &&
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || '#333333',
                    style: {
                        fontSize: '16px'
                    }
                },
                dial: {
                    radius: '80%',
                    backgroundColor: 'gray',
                    baseWidth: 12,
                    baseLength: '0%',
                    rearLength: '0%'
                },
                pivot: {
                    backgroundColor: 'gray',
                    radius: 6
                }

            }]

        });

        // Add some life
        setInterval(() => {
            const chart = Highcharts.charts[0];
            if (chart && !chart.renderer.forExport) {
                const point = chart.series[0].points[0];
                // Menggunakan AJAX untuk mengambil data dari server
                $.ajax({
                    url: '{{ route('sensor.data_single') }}',
                    method: 'GET',
                    success: function(response) {
                        var data = response.data.weend_speed;

                        // Memperbarui nilai pada grafik dengan data yang diperoleh dari server
                        let newVal = parseFloat(data);
                        if (!isNaN(newVal)) {
                            point.update(newVal);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Terjadi kesalahan dalam mengambil data: ' + error);
                    }
                });
            }
        }, 2000);
    </script>

    <script>
        // Inisialisasi grafik
        var chart = Highcharts.chart('container2', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Ketinggian Air'
            },
            subtitle: {
                text: 'Source: ' +
                    '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
                    'target="_blank">Wikipedia.com</a>'
            },
            xAxis: {
                categories: []
            },
            yAxis: {
                title: {
                    text: 'Distance (Cm)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Ketinggian Air',
                data: []
            }]
        });


        // Fungsi untuk mengambil data sensor dari server
        function getSensorData() {
            $.ajax({
                url: '{{ route('sensor.data_multiple') }}',
                method: 'GET',
                success: function(response) {
                    // Mengambil data tanggal dan weend_speed dari respons
                    var sensor = response.data.map(function(item) {
                        return parseFloat(item.sensor); // Menggunakan format [tanggal, weend_speed]
                    });

                    // Mengisi kategori pada sumbu x dengan tanggal
                    var categories = response.data.map(function(item) {
                        var timestamps = item.created_at;
                        var dateObj = new Date(timestamps);
                        var options = {
                            timeZone: 'Asia/Jakarta',
                            hour: '2-digit',
                            minute: '2-digit'
                        };
                        var time = dateObj.toLocaleTimeString('id-ID', options);
                        return time;
                    });

                    // Memperbarui kategori dan data pada grafik dengan efek animasi
                    if (chart) {
                        chart.series[0].update({
                            data: sensor,
                            animation: {
                                duration: 1000 // Durasi animasi dalam milidetik
                            }
                        });
                        chart.xAxis[0].update({
                            categories: categories,
                            animation: {
                                duration: 1000 // Durasi animasi dalam milidetik
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Terjadi kesalahan dalam mengambil data dari sumber eksternal
                    console.log('Terjadi kesalahan dalam mengambil data: ' + error);
                }
            });
        }

        // Memanggil fungsi getSensorData setiap 3 detik (interval polling)
        setInterval(getSensorData, 2000);
    </script>

</body>

</html>
