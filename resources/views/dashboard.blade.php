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
                        Monitoring Kecepatan Angin
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div id="kecepatan" style="height: 300px;"></div>
                </div><!-- /.card-body -->
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
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
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

            updateData();
            // Mengupdate grafik setiap 5 detik
            // setInterval(() => {
            //     // updateKetinggianChart();
            //     // updateKecepatanChart();
            //     // updateDataSuhu();
            //     // updateDataHumidity();
            // }, 5000);
        });
    </script>
@endpush


@push('scripts')
    <script>
        function updateData() {
            $.ajax({
                type: "GET",
                url: "{{ route('ajax.getAllData') }}",
                dataType: "json",
                success: function(response) {
                    updateKetinggianAir(response);
                    updateKecepatanAngin(response);
                    updateSuhu(response);
                    updateHumidity(response);
                }
            });
        }

        function updateKetinggianAir(data) {
            ketinggianChart.data.labels = [data.sensor];
            ketinggianChart.data.datasets[0].label = [data.status];
            ketinggianChart.data.datasets[0].data = [data.sensor];

            let ketinggianColor;
            if (data.status === "Aman") {
                ketinggianColor = 'green';
            } else if (data.status === "Siaga") {
                ketinggianColor = 'yellow';
            } else {
                ketinggianColor = 'red';
            }

            ketinggianChart.data.datasets[0].backgroundColor = [ketinggianColor];
            ketinggianChart.update();
        }

        function updateKecepatanAngin(data) {
            const chart = Highcharts.charts[0];
            const point = chart.series[0].points[0];

            console.log(data);
            let newVal = data.weend_speed;

            point.update(newVal);
        }

        function updateSuhu(data) {
            const chart = Highcharts.charts[1];
            const point = chart.series[0].points[0];

            console.log(data);
            let newVal = data.suhu;

            point.update(newVal);
        }

        function updateHumidity(data) {
            const point = chartSpeed.series[0].points[0];

            let newVal = data.kelembaban;

            point.update(newVal);
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
                data: [0],
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
    </script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Highcharts.chart('kecepatan', {

                chart: {
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '65%'
                },

                title: {
                    text: ''
                },

                pane: {
                    startAngle: -90,
                    endAngle: 89.9,
                    background: null,
                    center: ['50%', '75%'],
                    size: '140%'
                },

                // the value axis
                yAxis: {
                    min: 0,
                    max: 200,
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
                        to: 120,
                        color: '#55BF3B', // green
                        thickness: 20
                    }, {
                        from: 120,
                        to: 160,
                        color: '#DDDF0D', // yellow
                        thickness: 20
                    }, {
                        from: 160,
                        to: 200,
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
        });
    </script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Highcharts.chart('suhu', {

                chart: {
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '65%'
                },

                title: {
                    text: ''
                },

                pane: {
                    startAngle: -90,
                    endAngle: 89.9,
                    background: null,
                    center: ['50%', '75%'],
                    size: '120%'
                },

                // the value axis
                yAxis: {
                    min: 0,
                    max: 100,
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
                        to: 30,
                        color: '#DDDF0D', // yellow
                        thickness: 20
                    }, {
                        from: 30,
                        to: 100,
                        color: '#DF5353', // red
                        thickness: 20
                    }]
                },

                series: [{
                    name: 'Suhu',
                    data: [0],
                    tooltip: {
                        valueSuffix: ' °C'
                    },
                    dataLabels: {
                        format: '{y} °C',
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
        });
    </script>
@endpush

@push('scripts')
    <script>
        var gaugeOptions = {
            chart: {
                type: 'solidgauge'
            },

            title: null,

            pane: {
                center: ['50%', '85%'],
                size: '140%',
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                    innerRadius: '60%',
                    outerRadius: '100%',
                    shape: 'arc'
                }
            },

            exporting: {
                enabled: false
            },

            tooltip: {
                enabled: false
            },

            // the value axis
            yAxis: {
                stops: [
                    [0.1, '#55BF3B'], // green
                    [0.5, '#DDDF0D'], // yellow
                    [0.9, '#DF5353'] // red
                ],
                lineWidth: 0,
                tickWidth: 0,
                minorTickInterval: null,
                tickAmount: 2,
                title: {
                    y: -70
                },
                labels: {
                    y: 16
                }
            },

            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: 5,
                        borderWidth: 0,
                        useHTML: true
                    }
                }
            }
        };

        // The speed gauge
        var chartSpeed = Highcharts.chart('humidity', Highcharts.merge(gaugeOptions, {
            yAxis: {
                min: 0,
                title: {
                    text: 'Humidity'
                }
            },

            credits: {
                enabled: false
            },

            series: [{
                name: 'Humidity',
                data: [0],
                dataLabels: {
                    format: '<div style="text-align:center">' +
                        '<span style="font-size:25px">{y}</span><br/>' +
                        '<span style="font-size:12px;opacity:0.4">%</span>' +
                        '</div>'
                },
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        }));
    </script>
@endpush
