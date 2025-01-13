<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tentang Kami - Pemuda Grafika</title>
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
  </body>

    <main class="main">
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
        <nav class="breadcrumbs">
            <ol>
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li class="current">Tentang kami</li>
            </ol>
        </nav>
        <h1>Tantang kami</h1>
        </div>
    </div>
    </main>

<section class="about-us">
    <div class="container">
        <!-- Content Row -->
        <div class="row mb">
            <!-- Image Column -->
            <div class="col-lg-4 col-md-6 mb-4">
                <img src="{{ asset('assets/templates/user/img/about1a.jpg') }}" class="img-fluid rounded" alt="Team Image 1">
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <img src="{{ asset('assets/templates/user/img/about1aaa.jpg') }}" class="img-fluid rounded" alt="Team Image 2">
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <img src="{{ asset('assets/templates/user/img/about1aa.jpg') }}" class="img-fluid rounded" alt="Team Image 3">
            </div>
        </div>
        <!-- Descriptions -->
        <div class="row">
            <!-- Text Column 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="description-box">
                    <h4>Sejarah dan Perkembangan:</h4>
                    <p>
                        Didirikan pada 2018 oleh tiga pemuda kreatif—Taufiq Muammar, Jamaludin, dan Muhammad Rajudin—di Wonosari Timur, perusahaan ini mulai memperluas tim dengan merekrut karyawan desain pada 2019 dan administrasi pada 2020, kemudian membuka cabang di Pakning pada 2021 untuk memperluas layanan di Bengkalis, sebelum akhirnya relokasi ke lokasi strategis di Jalan Lembaga, Bengkalis pada 2023.
                    </p>
                </div>
            </div>
            <!-- Text Column 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="description-box">
                    <h4>Visi dan Misi:</h4>
                    <p>
                       Visi: Menjadi perusahaan percetakan terpercaya, andal, dan berdaya saing tinggi di tingkat daerah maupun nasional.
                    </p>
                    <p>
                       Misi: Menawarkan solusi cetak berkualitas, inovasi produk, dan menciptakan lingkungan kerja yang mendukung kreativitas.
                    </p>
                </div>
            </div>
            <!-- Text Column 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="description-box">
                    <h4>Lingkup Layanan:</h4>
                    <p>
                        Spanduk & Banner: Media promosi untuk berbagai acara atau kebutuhan bisnis.
                    </p>
                    <p>
                        Plakat & Selempang: Simbol penghargaan atau aksesori acara formal.
                    </p>
                    <p>
                        Stempel & Name Tag: Alat identitas untuk personal atau bisnis.
                    </p>
                    <p>
                        Gantungan Kunci & ID Card: Produk serbaguna untuk kebutuhan sehari-hari atau kantor.
                    </p>
                    <p>
                        Undangan (Fisik & Digital): Untuk keperluan acara formal atau informal.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

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