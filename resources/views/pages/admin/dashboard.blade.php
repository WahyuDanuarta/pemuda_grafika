@extends('layouts.admin.main')
@section('title', 'Admin Dashboard')
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

             <!-- Card Total Pengguna -->
             <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Produk</h4>
                        </div>
                        <div class="card-body">
                            {{ $produks }}
                        </div>
                    </div>
                </div>
            </div>

             <!-- Card Total Pengguna -->
             <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kategori Produk</h4>
                        </div>
                        <div class="card-body">
                            {{ $kategori_produks }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Total Pengguna -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Produk</h4>
                        </div>
                        <div class="card-body">
                            {{ $transaksi_produks }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Total Produk -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Operasional</h4>
                        </div>
                        <div class="card-body">
                            {{ $transaksi_operasionals }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Total Distributor -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kategori Operasional</h4>
                        </div>
                        <div class="card-body">
                            {{ $kategori_operasionals }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</div>
@endsection
