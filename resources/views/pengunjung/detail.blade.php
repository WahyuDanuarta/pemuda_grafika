<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Detail Produk - Pemuda Grafika</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/templates/user/img/logoweb-removebg.png') }}" rel="icon">
    <link href="{{ asset('assets/templates/user/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/templates/user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/templates/user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/templates/user/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/templates/user/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/templates/user/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/templates/user/css/main.css') }}" rel="stylesheet">
    <style>
        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            max-width: 100%;
            height: auto;
            border-radius: 8px; /* Rounded corners for images */
        }

        .portfolio-info ul {
            list-style: none;
            padding: 0;
        }

        .portfolio-info ul li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets/templates/user/img/logo/Logobarp1.png') }}" alt="Logo" class="logo-image">
            </a>

            <!-- Navigation Menu -->
            <nav id="navmenu" class="navmenu d-flex align-items-center">
                <ul class="nav-list">
                    <li><a href="{{ url('/') }}#hero" class="active">Beranda</a></li>
                    <li><a href="{{ url('/') }}#portfolio">Produk</a></li>

                    <!-- Dropdown Kategori -->
                    <li class="dropdown">
                        <li class="dropdown"><a href="#"><span>Kategori</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul class="dropdown-menu">
                            @foreach($kategori_produks as $kategori)
                                <li><a href="{{ route('kategori.show', $kategori->id) }}">{{ $kategori->nama_kategori }}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <li><a href="{{ url('/') }}#about">Tentang Kami</a></li>
                    <li><a href="{{ url('/') }}#contact">Kontak</a></li>
                </ul>

                <!-- Search Form -->
                <form class="search-form" action="{{ route('pengunjung.search') }}" method="get">
                    <input type="text" placeholder="Cari produk.." name="search" class="search-input" value="{{ request()->search }}">
                    <button type="submit" class="search-button"><i class="bi bi-search"></i></button>
                </form>

                <!-- Mobile Navigation Toggle -->
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <main class="main">
        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="current">Detail</li>
                    </ol>
                </nav>
                <h1>Detail Barang</h1>
            </div>
        </div><!-- End Page Title -->

        <!-- Portfolio Details Section -->
        <section id="portfolio-details" class="portfolio-details section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-8">
                        <div class="portfolio-details-slider swiper init-swiper">
                            <script type="application/json" class="swiper-config">
                                {
                                    "loop": true,
                                    "speed": 600,
                                    "autoplay": {
                                        "delay": 5000
                                    },
                                    "slidesPerView": "auto",
                                    "pagination": {
                                        "el": ".swiper-pagination",
                                        "type": "bullets",
                                        "clickable": true
                                    }
                                }
                            </script>

                            <div class="swiper-wrapper align-items-center">
                                @if($produk->images->isNotEmpty())
                                    @foreach($produk->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('images/' . $image->filename) }}" alt="{{ $produk->nama_produk }}">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="swiper-slide">
                                        <img src="{{ asset('images/default.png') }}" alt="No Image">
                                    </div>
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                            <h3>Spesifikasi Barang</h3>
                            <ul>
                                <li><strong>Nama Produk</strong>: {{ $produk->nama_produk }}</li>
                                <li><strong>Harga</strong>: {{ number_format($produk->harga, 0, ',', '.') }}</li>
                                <li><strong>Stok</strong>: {{ $produk->stok > 0 ? $produk->stok : 'Habis' }}</li>
                                <li><strong>Pesan sekarang</strong>: 
                                    <a href="https://api.whatsapp.com/send?phone=6282243117852&text=Halo%2C%20saya%20ingin%20memesan%20{{ urlencode($produk->nama_produk) }}%20dari%20Pemuda%20Grafika" target="_blank">
                                        0822 4311 7852
                                    </a>
                                </li>
                                <li><strong>Deskripsi Produk</strong>:</li>
                                    <li>
                                        <p>{!! nl2br(e($produk->deskripsi ?? 'Deskripsi produk tidak tersedia.')) !!}</p>
                                    </li>
                            </ul>
                        </div>
                        <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                            <!-- Optional description can be added here -->
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Portfolio Details Section -->
    </main>

    <footer id="footer" class="footer light-background">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span class="sitename">Pemuda Grafika</span>
                        </a>
                        <div class="footer-contact pt-3">
                            <p>
                                <a href="https://maps.app.goo.gl/4wXvDFJFq7D7UJuJ9" target="_blank" rel="noopener noreferrer">
                                    JL LEMBAGA, SENGGORO BENGKALIS
                                </a>
                            </p>
                            <p>
                                <a href="https://maps.app.goo.gl/g1QXigjWgUtDYbK89" target="_blank" rel="noopener noreferrer">
                                    JL JEND. SUDIRMAN SEI. PAKNING
                                </a>
                            </p>
                            <strong>Phone:</strong> 
                            <p>
                                <a href="https://api.whatsapp.com/send?phone=6282243117852&text=Halo,%20aku%20ingin%20menanyakan%20 perihal%20transaksi" target="_blank" rel="noopener noreferrer">
                                    0822 4311 7852
                                </a>
                            </p>
                            <p><strong>Email:</strong>
                                <span>pemudagrafika@gmail.com</span>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Tautan Berguna</h4>
                        <ul>
                            <li><a href="{{ url('/') }}#hero">Beranda</a></li>
                            <li><a href="{{ url('/') }}#portfolio">Produk</a></li>
                            <li><a href="{{ url('/') }}#about">Tentang Kami</a></li>
                            <li><a href="{{ url('/') }}#contact">Kontak</a></li>
                            <li><a href="https://jemputan.id/pemesanan/">Undangan Web</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Media Sosial</h4>
                        <ul>
                            <li>
                                <a href="https://www.instagram.com/pemudagrafika?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                                    <i class="bi bi-instagram"></i> Instagram
                                </a>
                            </li>
                            <li>
                                <a href="https://api.whatsapp.com/send?phone=6282243117852&text=Halo,%20aku%20ingin%20menanyakan%20perihal%20transaksi">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright text-center">
            <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
                <div class="d-flex flex-column align-items-center align-items-lg-start">
                    <div>
                        © Copyright <strong><span>Pemuda Grafika</span></strong>. All Rights Reserved
                    </div>
                    <div class="credits">
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>
                </div>

                <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                    <!-- Social media links can be added here -->
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/templates/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/templates/user/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/templates/user/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/templates/user/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/templates/user/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/templates/user/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/templates/user/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/templates/user/js/main.js') }}"></script>
</body>

</html>