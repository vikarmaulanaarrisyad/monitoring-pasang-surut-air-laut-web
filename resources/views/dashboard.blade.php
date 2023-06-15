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
@endsection

@push('scripts_vendor')
    <script src="{{ asset('/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Mengupdate grafik setiap 5 detik
            setInterval(() => {
                updateKetinggianChart();
                updateKecepatanChart();

            }, 1000);
        });

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
                    // variabel untuk menampung tinggi aquarium
                    var tinggiMaxAquarium = 2500;
                    // mengukur tinggi air
                    var tinggiAir = tinggiMaxAquarium - data.sensor;
                    // presentasi ketinggian air
                    var presentaseTinggiAir = (tinggiAir/tinggiMaxAquarium)*100; // hasil

                    // Mengubah data ketinggian air menjadi integer atau dibulatkan
                    var roundedKetinggian = Math.round(presentaseTinggiAir);

                    // Mengupdate label dan data pada chart ketinggian air
                    ketinggianChart.data.labels = [roundedKetinggian];
                    ketinggianChart.data.datasets[0].label = [data.status];
                    ketinggianChart.data.datasets[0].data = [roundedKetinggian];

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
