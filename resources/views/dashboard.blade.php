@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <!-- /.row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Monitoring Ketinggian Air Laut
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body text-center pb-0">

                </div>
                <div class="card-body pt-0">
                    <canvas id="ketinggian" height="300" style="height: 300px;"></canvas>
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>

        <section class="col-lg-6">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Monitoring Kecepatan
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body text-center pb-0">

                </div>
                <div class="card-body pt-0">
                    <canvas id="kecepatan" height="300" style="height: 300px;"></canvas>
                </div>
            </div>
        </section>
    </div>

    <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Monitoring Suhu
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body pt-0">
                    <div id="suhu" style="height: 300px"></div>
                </div><!-- /.card-body -->
            </div>
        </section>
        <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Monitoring Kelembapan
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body pt-0">
                    <div id="humidity" style="height: 300px"></div>
                </div><!-- /.card-body -->
            </div>
        </section>

    </div>
@endsection

@push('scripts_vendor')
    <script src="{{ asset('/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/code/highcharts.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/code/modules/exporting.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/code/modules/export-data.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/code/modules/accessibility.js"></script>

    <!-- Include Moment.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Include Moment Timezone plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.33/moment-timezone-with-data.min.js"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            updateDataSuhu();
            // Mengupdate grafik setiap 5 detik
            // setInterval(() => {
            //     updateKetinggianChart();
            //     updateKecepatanChart();

            // }, 1000);
        });
    </script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Highcharts.chart('suhu', {
                chart: {
                    type: 'line',
                    animation: true,
                },
                title: {
                    text: 'Monitoring Data Suhu'
                },

                xAxis: {
                    categories: [],
                    type: 'datetime',
                    crosshair: true, // Use datetime type for the x-axis
                    labels: {
                        format: '{value:%H:%M}' // Format the x-axis labels as hours and minutes
                    }
                },
                yAxis: {
                    title: {
                        text: 'Temperature (°C)'
                    },
                    crosshair: true
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true,
                            format: '{y} °C'
                        },
                        enableMouseTracking: false
                    }
                },
                tooltip: {
                    backgroundColor: '#FCFFC5',
                    borderColor: 'black',
                    borderRadius: 10,
                    borderWidth: 3,
                    formatter: function() {
                        return 'The value for <b>' + this.x + '</b> is <b>' + this.y +
                            '</b>, in series ' + this.series.name;
                    }
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                enabled: false
                            }
                        }
                    }]
                },
                series: [{
                    name: 'Waktu',
                    data: [0],
                }, ]
            });
        });


        function updateDataSuhu() {
            $.ajax({
                type: "GET",
                url: '{{ route('api.suhu.data') }}',
                dataType: "json",
                success: function(response) {
                    var chart = Highcharts.charts[0];

                    var suhu = response.data.map(item => item.suhu);
                    var tanggal = response.data.map(item => item.tanggal);


                    // Set the name of the series to the current date
                    var currentDate = new Date();
                    var formattedTime = currentDate.toLocaleTimeString();

                    // Update the series data
                    chart.xAxis[0].setCategories(tanggal);

                    chart.series[0].setData(suhu);
                    chart.series[0].setName(formattedTime);

                    // Redraw the chart with the updated data
                    chart.redraw();
                }
            });
        }
    </script>
@endpush


@push('scripts')
    <script>
        $(document).ready(function() {
            updateDataHumidity();
        });
        document.addEventListener('DOMContentLoaded', function() {
            Highcharts.chart('humidity', {
                chart: {
                    type: 'line',
                    animation: true,
                },
                title: {
                    text: 'Monitoring Data Kelembaban'
                },

                xAxis: {
                    categories: [],
                    type: 'datetime',
                    crosshair: true, // Use datetime type for the x-axis
                    labels: {
                        format: '{value:%H:%M}' // Format the x-axis labels as hours and minutes
                    }
                },
                yAxis: {
                    title: {
                        text: 'Humidity (%)'
                    },
                    crosshair: true
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true,
                            format: '{y} °%'
                        },
                        enableMouseTracking: false
                    }
                },
                
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                enabled: false
                            }
                        }
                    }]
                },
                series: [{
                    name: 'Waktu',
                    data: [0],
                }, ]
            });
        });


        function updateDataHumidity() {
            $.ajax({
                type: "GET",
                url: '{{ route('api.humidity.data') }}',
                dataType: "json",
                success: function(response) {
                    var chart1 = Highcharts.charts[1];

                    var humidity = response.data.map(item => item.kelembaban);
                    var tanggal = response.data.map(item => item.tanggal);


                    // Set the name of the series to the current date
                    var currentDate = new Date();
                    var formattedTime = currentDate.toLocaleTimeString();

                    // Update the series data
                    chart1.xAxis[0].setCategories(tanggal);

                    chart1.series[0].setData(humidity);
                    chart1.series[0].setName(formattedTime);

                    // Redraw the chart with the updated data
                    chart1.redraw();
                }
            });
        }
    </script>
@endpush

@push('scripts')
    <script>
        // Ketinggian air chart
        var ketinggianChartCanvas = document.getElementById('ketinggian').getContext('2d');

        var ketinggianChartData = {
            labels: [],
            datasets: [{
                label: [],
                backgroundColor: [], // Menggunakan array kosong untuk menyimpan warna latar belakang
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [],
                borderWidth: 2,
            }]
        };

        var ketinggianChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    },
                    display: true // Menghilangkan sumbu X (sebelah kiri)
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 10, // Langkah nilai pada sumbu Y
                        max: 100 // Nilai maksimal pada sumbu Y
                    }
                }]
            }
        };

        var ketinggianChart = new Chart(ketinggianChartCanvas, {
            type: 'bar',
            data: ketinggianChartData,
            options: ketinggianChartOptions
        });


        var areaChartCanvas = $('#kecepatan').get(0).getContext('2d')

        var areaChartData = {
            labels: [],
            datasets: [{
                    label: [],
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: []
                },

            ]
        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })


        function updateKetinggianChart() {
            $.ajax({
                url: '{{ route('sensor.ajax') }}',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var data = response.data;
                    var air = data.sensor;
                    // Mengupdate label dan data pada chart ketinggian air
                    ketinggianChart.data.labels = [air];
                    ketinggianChart.data.datasets[0].label = [data.status];
                    ketinggianChart.data.datasets[0].data = [air];

                    // Mengupdate warna latar belakang chart ketinggian air berdasarkan status
                    var ketinggianBackgroundColor;
                    if (data.status == 'Aman') {
                        ketinggianBackgroundColor = 'green';
                    } else if (data.status == 'Siaga') {
                        ketinggianBackgroundColor = 'yellow';
                    } else {
                        ketinggianBackgroundColor = 'red';
                    }
                    ketinggianChart.data.datasets[0].backgroundColor = [ketinggianBackgroundColor];

                    // Mengupdate grafik ketinggian air
                    ketinggianChart.update();

                },
                error: function(xhr, status, error) {
                    console.log(error); // Menampilkan pesan error jika terjadi kesalahan
                }
            });
        }

        function updateKecepatanChart() {
            $.ajax({
                type: "GET",
                url: "{{ route('sensor.kecepatan_all') }}",
                dataType: "json",
                success: function(response) {
                    // Mendapatkan data kecepatan
                    var kecepatan = response.data.map(item => item.weend_speed);
                    var tanggal = response.data.map(item => item.tanggal);

                    // Mengupdate label dan data pada chart kecepatan
                    areaChartData.labels = tanggal;
                    areaChartData.datasets[0].data = kecepatan;
                    areaChartData.datasets[0].label = kecepatan;

                    // Mengupdate grafik kecepatan
                    areaChart.update();
                }
            });
        }
    </script>
@endpush
