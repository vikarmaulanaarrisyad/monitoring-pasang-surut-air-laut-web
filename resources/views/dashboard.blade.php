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
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Laporan data sensor {{ date('Y') }}
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body text-center pb-0">
                    {{ date('Y-m-d') }}
                </div>
                <div class="card-body pt-0">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.Left col -->
        {{--
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">10 projek populer bulan ini</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Jumlah Donasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projekPopuler as $key => $item)
                            <tr>
                                <td><a href="{{ route('campaign.show', $item->id) }}">{{ $key+1 }}</a></td>
                                <td>{{ $item->title }}</td>
                                <td><span class="badge badge-{{ $item->statusColor() }}">{{ $item->status }}</span></td>
                                <td>{{ $item->donations_count }}x</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Tidak tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header border-transparent">
              <h3 class="card-title">Top 10 donatur bulan ini</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
              <div class="table-responsive">
                  <table class="table m-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Nama</th>
                                <th>Jumlah Donasi</th>
                                <th>Jumlah Projek</th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse ($topDonatur as $key => $item)
                            <tr>
                                <td><a href="{{ route('donatur.index', ['email' => $item->email]) }}">{{ $key+1 }}</a></td>
                                <td>
                                    {{ $item->name }}
                                    <br>
                                    <a href="mailto:{{ $item->email }}" target="_blank">{{ $item->email }}</a>
                                </td>
                                <td>{{ $item->donations_count }}x</td>
                                <td>{{ $item->campaigns_count }}x</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Tidak tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                  </table>
              </div>
              <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div> --}}
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        {{-- <section class="col-lg-5 connectedSortable">

        <!-- Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Pengguna bulan ini
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="sales-chart-canvas" height="150" style="height: 150px;"></canvas>
                    </div>
                    <div class="col-md-6">
                        <ul class="chart-legend clearfix">
                            <li><i class="far fa-circle text-danger"></i> Donatur</li>
                            <li><i class="far fa-circle text-success"></i> Subscriber</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Notifikasi terbaru <span class="badge badge-danger">{{ $countNotifikasi }}</span></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach ($listNotifikasi as $key => $notifikasi)
                    @foreach ($notifikasi as $item)
                    <li class="item">
                        <div class="product-info ml-1">
                            <a href="{{ route("$key.index") }}" class="product-title">
                                {{ $item->name ?? $item->email ?? $item->user->name ?? "" }}
                                <span class="badge
                                @switch($key)
                                    @case('donatur') badge-warning @break
                                    @case('subscriber') badge-secondary @break
                                    @case('contact') badge-info @break
                                    @case('donation') badge-primary @break
                                    @case('cashout') badge-success @break
                                @endswitch
                                float-right">{{ $key }} baru</span>
                            </a>
                            <span class="product-description">
                                {{ now()->parse($item->created_at)->diffForHumans() }}
                            </span>
                        </div>
                    </li>
                    @endforeach
                @endforeach
              </ul>
            </div>
          </div>
    </section> --}}
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    {{-- @dd($listDataSensor) --}}
@endsection

@push('scripts_vendor')
    <script src="{{ asset('/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
@endpush

@push('scripts')
    {{-- <script>
        /* Chart.js Charts */
        // Sales chart
        var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
        // $('#revenue-chart').get(0).getContext('2d');

        var salesChartData = {
            labels: @json($listTanggal),
            datasets: [{
                label: 'Jarak ',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: @json($listDataSensor)
                // data: [28, 48, 40, 19, 86, 27, 90]
            }, ]
        }

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'bar',
            data: salesChartData,
            options: salesChartOptions
        })
    </script> --}}


    <script>
        $(document).ready(function() {
            // Mengupdate grafik setiap 5 detik
            setInterval(() => {
                updateChart();
            }, 1000);
        });

        // Sales chart
        var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');

        var salesChartData = {
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

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        };

        var salesChart = new Chart(salesChartCanvas, {
            type: 'bar',
            data: salesChartData,
            options: salesChartOptions
        });


        function updateChart() {
            $.ajax({
                url: '{{ route('sensor.ajax') }}',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Mengambil 10 data terakhir
                    var latestLabels = response.listTanggal.slice(-10);
                    var latestData = response.listDataSensor.slice(-10);
                    var latestStatus = response.listStatus.slice(-10);

                    // Mengupdate label dan data pada grafik
                    salesChart.data.labels = latestLabels;
                    salesChart.data.datasets[0].data = latestData;

                    // Mengupdate warna latar belakang berdasarkan status
                    var backgroundColors = latestStatus.map(function(status) {
                        if (status == 'Aman') {
                            return 'green';
                        } else if (status == 'Siaga') {
                            return 'yellow';
                        } else {
                            return 'red';
                        }
                    });
                    salesChart.data.datasets[0].backgroundColor = backgroundColors;

                    // Mengupdate grafik
                    salesChart.update();
                },
                error: function(xhr, status, error) {
                    console.log(error); // Menampilkan pesan error jika terjadi kesalahan
                }
            });
        }
    </script>
@endpush
