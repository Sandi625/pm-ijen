@extends('layouts.base')

@section('content')
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('pesanan.index') }}" style="text-decoration: none;">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pesanan (Bulan Ini)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pesanans->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>



    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('guide.index') }}" style="text-decoration: none;">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Guides
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $guides->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>



    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('paket.index') }}" style="text-decoration: none;">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Paket
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalPaket }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>



    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('review.all') }}" style="text-decoration: none;">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Review
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalReviews }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>


</div>
<div class="row">

    <!-- Area Chart -->
    <div class="card-body">
        <h2 class="h5 mb-4 font-weight-bold text-gray-800">Penilaian Terbaru</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Nama Guide</th>
                        <th>Tanggal Penilaian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPenilaians as $penilaian)
                        <tr>
                            <td>{{ $penilaian->guide->nama_guide ?? '-' }}</td>
                            <td>{{ $penilaian->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('penilaian.show', $penilaian) }}" class="text-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data penilaian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>


  <!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Review</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <!-- Display Recent Reviews -->
            <div class="mt-3">
                <h6>Recent Reviews:</h6>
                <ul class="list-unstyled">
                    @forelse($reviews as $review)
                        <li class="mb-2">
                            <p><strong>{{ $review->name }}</strong></p>
                            <p>{{ Str::limit($review->isi_testimoni, 150) }}</p> <!-- Membatasi panjang testimoni -->
                        </li>
                    @empty
                        <li>No reviews available.</li>
                    @endforelse
                </ul>
            </div>

            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChart"></canvas>
            </div>

            <!-- Display Total Reviews -->
            {{-- <div class="mt-4 text-center small">
                <span class="mr-2">
                    <i class="fas fa-circle text-primary"></i> Total Reviews: {{ $totalReviews }}
                </span>
            </div> --}}
        </div>
    </div>
</div>


<style>.card-body {
    max-height: 350px; /* Menyesuaikan tinggi maksimal */
    overflow-y: auto;  /* Menambahkan scroll jika konten lebih panjang */
}

    .chart-pie {
        max-height: 200px;
    }


ul.list-unstyled {
    max-height: 500px; /* Membatasi tinggi daftar review */
    overflow-y: auto; /* Menambahkan scroll pada daftar review jika terlalu banyak */
}
</style>



</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById("myAreaChart").getContext("2d");
    let myChart;

    fetch("{{ route('chart.pesanan.bulanan') }}")
        .then(res => res.json())
        .then(({ labels, data }) => {
            myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Total Pesanan",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: data,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: { left: 10, right: 25, top: 25, bottom: 0 }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            title: { display: true, text: 'Bulan' }
                        },
                        y: {
                            ticks: { beginAtZero: true },
                            title: { display: true, text: 'Jumlah Pesanan' }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
</script>

@endsection
