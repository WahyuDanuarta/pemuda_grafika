@extends('layouts.owner.main')
@section('title', 'Owner Dashboard')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>          
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            </div>
        </div>

        <div class="row">
            <!-- Card Total Admin -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-shield fa-sm"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Admin</h4>
                        </div>
                        <div class="card-body">
                            {{ $admins }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Transaksi Produk -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-cogs fa-sm"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Transaksi Produk</h4>
                        </div>
                        <div class="card-body">
                            {{ $transaksiProduks }} 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Transaksi Operasional -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-tools fa-sm"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Transaksi Operasional</h4>
                        </div>
                        <div class="card-body">
                            {{ $transaksiOperasionals }} 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Grafik Transaksi Produk -->
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Transaksi Produk</h4>
                        <p class="text-muted">Grafik ini menunjukkan jumlah transaksi produk berdasarkan minggu dalam bulan.</p>
                    </div>
                    <div class="card-body">
                        <canvas id="transaksiProdukChart" style="height: 300px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Card Grafik Transaksi Operasional -->
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Transaksi Operasional</h4>
                        <p class="text-muted">Grafik ini menunjukkan jumlah transaksi operasional berdasarkan minggu dalam bulan.</p>
                    </div>
                    <div class="card-body">
                        <canvas id="transaksiOperasionalChart" style="height: 300px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxProduk = document.getElementById('transaksiProdukChart').getContext('2d');
    const ctxOperasional = document.getElementById('transaksiOperasionalChart').getContext('2d');

    // Grafik Transaksi Produk
    const transaksiProdukChart = new Chart(ctxProduk, {
        type: 'bar',
        data: {
            labels: {!! json_encode($transaksiProdukPerMinggu->keys()) !!}, // Label Minggu
            datasets: [{
                label: 'Jumlah Transaksi Produk',
                data: {!! json_encode($transaksiProdukPerMinggu->values()) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Transaksi'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Minggu dalam Bulan'
                    }
                }
            }
        }
    });

    // Grafik Transaksi Operasional
    const transaksiOperasionalChart = new Chart(ctxOperasional, {
        type: 'bar',
        data: {
            labels: {!! json_encode($transaksiOperasionalPerMinggu->keys()) !!}, // Label Minggu
            datasets: [{
                label: 'Jumlah Transaksi Operasional',
                data: {!! json_encode($transaksiOperasionalPerMinggu->values()) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Transaksi'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Minggu dalam Bulan'
                    }
                }
            }
        }
    });
</script>
@endsection
