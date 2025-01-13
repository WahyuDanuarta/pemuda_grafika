<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Kategori produk - Pemuda Grafika</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/templates/user/img/logoweb-removebg.png') }}" rel="icon">
  <link href="{{ asset('assets/templates/user/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com')" rel="preconnect">
  <link href="https://fonts.gstatic.com')" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap') }}" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/templates/user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/templates/user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/templates/user/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/templates/user/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/templates/user/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">


  <!-- Main CSS File -->
  <link href="{{ asset('assets/templates/user/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Scaffold
  * Template URL: https://bootstrapmade.com/scaffold-bootstrap-metro-style-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
            <li><a href="{{ url('/') }}">Beranda</a></li>
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
          <form class="search-form" action="#" method="get">
            <input type="text" placeholder="Cari produk.." name="search" class="search-input">
            <button type="submit" class="search-button"><i class="bi bi-search"></i></button>
          </form>

          <!-- Mobile Navigation Toggle -->
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </header>
  </body>

    <main class="main">
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
        <nav class="breadcrumbs">
            <ol>
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li class="current">Search Produk</li>
            </ol>
        </nav>
        <h1>Produk</h1>
        </div>
    </div>
    </main>

<!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">
  <div class="container">
    @if($produks->isEmpty())
      <p>Produk tidak ditemukan.</p>
    @else
      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <!-- Portfolio Items Grid -->
        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          @foreach($produks as $produk)
          <div class="col-lg-3 col-md-4 col-6 portfolio-item isotope-item filter-plakat">
            <a href="{{ route('produk.show', $produk->id) }}" title="{{ $produk->nama_produk }}" class="portfolio-link">
              <div class="portfolio-content p-3 shadow-sm rounded">
                <img src="{{ asset('images/' . $produk->image) }}" class="img-fluid rounded" alt="{{ $produk->nama_produk }}">
                <div class="portfolio-info mt-2 text-center">
                  <h4 class="mb-1">{{ $produk->nama_produk }}</h4>
                  <p class="text-primary fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div><!-- End Portfolio Container -->
      </div>
    @endif
  </div>
</section><!-- /Portfolio Section -->


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
                <p class="mt-3"></p>
                <strong>Phone:</strong> 
                <p style="margin: 0;"></p>
                <a href="https://api.whatsapp.com/send?phone=6282243117852&text=Halo,%20aku%20ingin%20menanyakan%20perihal%20transaksi" target="_blank" rel="noopener noreferrer">
                    0822 4311 7852
                </a>
                </p>
              <p class="mt-3"><strong>Email:</strong>
              <p style="margin: 0;"></p>
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
          
    <div class="copyright text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div>
            © Copyright <strong><span>MyWebsite</span></strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>

        <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
          <!-- <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a> -->
          <!-- <a href="https://www.instagram.com/pemudagrafika?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-linkedin"></i></a> -->
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