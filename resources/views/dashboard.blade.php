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
                        Grafik Ketinggian Air
                    </h3>
                </div>

                <div class="card-body pt-0">
                    <canvas id="ketinggian"style="height: 300px;"></canvas>

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
                        Grafik Kecepatan Angin
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <canvas id="kecepatan" height="220px" style="height: 280px;"></canvas>
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
                        Grafik Suhu
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body pt-0">
                    <canvas id="suhu" height="220px"></canvas>
                </div>
            </div>
        </section>
        <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Grafik Kelembapan
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body pt-0">
                    <canvas id="humidity" height="220px"></canvas>

                </div><!-- /.card-body -->
            </div>
        </section>

    </div>
@endsection

@push('scripts_vendor')
    <script src="{{ asset('/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Include Moment.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Include Moment Timezone plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.33/moment-timezone-with-data.min.js"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {

            // Mengupdate grafik setiap 5 detik
            setInterval(() => {
                updateData();
            }, 5000);
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


        // function updateKetinggianChart() {
        //     $.ajax({
        //         url: '{{ route('sensor.ajax') }}',
        //         method: 'GET',
        //         dataType: 'json',
        //         success: function(response) {
        //             var data = response.data;
        //             var air = data.sensor;
        //             // Mengupdate label dan data pada chart ketinggian air
        //             ketinggianChart.data.labels = [air];
        //             ketinggianChart.data.datasets[0].label = [data.status];
        //             ketinggianChart.data.datasets[0].data = [air];

        //             // Mengupdate warna latar belakang chart ketinggian air berdasarkan status
        //             var ketinggianBackgroundColor;
        //             if (data.status == 'Aman') {
        //                 ketinggianBackgroundColor = 'green';
        //             } else if (data.status == 'Siaga') {
        //                 ketinggianBackgroundColor = 'yellow';
        //             } else {
        //                 ketinggianBackgroundColor = 'red';
        //             }
        //             ketinggianChart.data.datasets[0].backgroundColor = [ketinggianBackgroundColor];

        //             // Mengupdate grafik ketinggian air
        //             ketinggianChart.update();

        //         },
        //         error: function(xhr, status, error) {
        //             console.log(error); // Menampilkan pesan error jika terjadi kesalahan
        //         }
        //     });
        // }
    </script>
@endpush


@push('scripts')
    <script>
        var data = {
            labels: [0],
            datasets: [{
                label: 'Kecepatan Angin',
                data: [0],
                borderColor: 'rgb(189,195,199)',
                lineTension: 0.5
            }]
        };

        var config = {
            type: 'line',
            data: data,
            options: {
                responsive: true
            }
        };

        var kecepatanChart = new Chart(
            document.getElementById('kecepatan'),
            config
        );

        function mycallback() {
            $.ajax({
                type: "GET",
                url: "{{ route('ajax.getLatestData') }}",
                dataType: "json",
                success: function(response) {
                    let data = response.data;
                    let index = 0;

                    function updateChart() {
                        if (index < data.length) {
                            let item = data[index];
                            let tanggal = item.tanggal;
                            let weend_speed = item.weend_speed;
                            let createdAt = moment(item.created_at);
                            let waktu = createdAt.format('HH:mm:ss')

                            if (kecepatanChart.data.datasets[0].data.length >= 10) {
                                kecepatanChart.data.labels.shift();
                                kecepatanChart.data.datasets[0].data.shift();
                            }

                            kecepatanChart.data.labels.push(waktu);
                            kecepatanChart.data.datasets[0].data.push(weend_speed);

                            kecepatanChart.update();

                            index++;

                            // Wait for a certain period of time before updating with the next data
                            setTimeout(updateChart, 5000);
                        }
                    }

                    // Start updating the chart
                    updateChart();
                }
            });
        }


        setInterval(mycallback, 5000);
    </script>
@endpush




@push('scripts')
    <script>
        var data = {
            labels: [0],
            datasets: [{
                label: 'Suhu',
                data: [0],
                borderColor: 'rgb(189,195,199)',
                lineTension: 0.5
            }]
        };

        var config = {
            type: 'line',
            data: data,
            options: {
                responsive: true
            }
        };

        var suhuChart = new Chart(
            document.getElementById('suhu'),
            config
        );

        function suhu() {
            $.ajax({
                type: "GET",
                url: "{{ route('ajax.getLatestData') }}",
                dataType: "json",
                success: function(response) {
                    let data = response.data;
                    let index = 0;

                    function updateChart() {
                        if (index < data.length) {
                            let item = data[index];
                            let tanggal = item.tanggal;
                            let suhu = item.suhu;
                            let createdAt = moment(item.created_at);
                            let waktu = createdAt.format('HH:mm:ss');

                            // console.log('Waktu:', waktu);

                            if (suhuChart.data.datasets[0].data.length >= 10) {
                                suhuChart.data.labels.shift();
                                suhuChart.data.datasets[0].data.shift();
                            }

                            suhuChart.data.labels.push(waktu);
                            suhuChart.data.datasets[0].data.push(suhu);

                            suhuChart.update();

                            index++;

                            // Wait for a certain period of time before updating with the next data
                            setTimeout(updateChart, 5000);
                        }
                    }

                    // Start updating the chart
                    updateChart();
                }
            });
        }


        setInterval(suhu, 5000);
    </script>
@endpush


@push('scripts')
    <script>
        var data = {
            labels: [0],
            datasets: [{
                label: 'Humidity',
                data: [0],
                borderColor: 'rgb(189,195,199)',
                lineTension: 0.5
            }]
        };

        var config = {
            type: 'line',
            data: data,
            options: {
                responsive: true
            }
        };

        var humidityChart = new Chart(
            document.getElementById('humidity'),
            config
        );

        function humidity() {
            $.ajax({
                type: "GET",
                url: "{{ route('ajax.getLatestData') }}",
                dataType: "json",
                success: function(response) {
                    let data = response.data;
                    let index = 0;

                    function updateChart() {
                        if (index < data.length) {
                            let item = data[index];
                            let tanggal = item.tanggal;
                            let humidity = item.kelembaban;
                            let createdAt = moment(item.created_at);
                            let waktu = createdAt.format('HH:mm:ss');

                            // console.log('Waktu:', waktu);

                            if (humidityChart.data.datasets[0].data.length >= 10) {
                                humidityChart.data.labels.shift();
                                humidityChart.data.datasets[0].data.shift();
                            }

                            humidityChart.data.labels.push(waktu);
                            humidityChart.data.datasets[0].data.push(humidity);

                            humidityChart.update();

                            index++;

                            // Wait for a certain period ohumidityf time before updating with the next data
                            setTimeout(updateChart, 5000);
                        }
                    }

                    // Start updating the chart
                    updateChart();
                }
            });
        }


        setInterval(humidity, 5000);
    </script>
@endpush

