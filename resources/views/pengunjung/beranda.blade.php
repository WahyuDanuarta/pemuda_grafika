<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pemuda Grafika - Website</title>
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
        <li><a href="#portfolio">Produk</a></li>

        <!-- Dropdown Kategori -->
        <li class="dropdown">
          <li class="dropdown"><a href="#"><span>Kategori</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul class="dropdown-menu">
            @foreach($kategori_produks as $kategori)
              <li><a href="{{ route('kategori.show', $kategori->id) }}">{{ $kategori->nama_kategori }}</a></li>
            @endforeach
          </ul>
        </li>

        <li><a href="#about">Tentang Kami</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>

      <!-- Form Pencarian -->
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

  <!-- Hero Section -->
  <section id="hero" class="hero section">
    <div class="container">
      <div class="row gy-4">
        <!-- Kolom Konten Teks -->
        <div class="col-lg-7 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>Selamat Datang di Website Pemuda Grafika</h1>
          <p>Pusat Undangan - Digital Printing</p>
          <div class="d-flex">
            <a href="#portfolio" class="btn-get-started">Lihat Produk</a>
          </div>
        </div>

      <!-- Kolom Slider Gambar -->
        <div class="col-lg-5 order-1 order-lg-2 hero-img">
          <!-- Slider Gambar -->
          <div class="portfolio-details-slider swiper">
            <div class="swiper-wrapper align-items-center">
              <!-- Setiap Gambar -->
              <div class="swiper-slide">
                <img src="{{ asset('assets/templates/user/img/dashboard/katalog-spanduk&bannerstempel.jpg') }}" alt="Katalog Spanduk dan Banner">
              </div>
              <div class="swiper-slide">
                <img src="{{ asset('assets/templates/user/img/dashboard/katalog-cetakstiker.jpg') }}" alt="Katalog Cetak Stiker">
              </div>
              <div class="swiper-slide">
                <img src="{{ asset('assets/templates/user/img/dashboard/katalog-jamoperasional.jpg') }}" alt="Katalog Jam Operasional">
              </div>
              <div class="swiper-slide">
                <img src="{{ asset('assets/templates/user/img/dashboard/katalog-idcard.jpg') }}" alt="Katalog ID Card">
              </div>
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Hero Section -->

    <!-- Include Swiper JS -->
    <script src="https://unpkg.com/swiper@10/swiper-bundle.min.js"></script>
    <script>
      // Swiper initialization for automatic swipe
      const swiper = new Swiper('.portfolio-details-slider', {
        loop: true,  // Enable infinite loop
        speed: 600,  // Transition speed
        autoplay: {
          delay: 5000, // Time before next slide (in ms)
          disableOnInteraction: false, // Keep autoplay after user interaction
        },
        slidesPerView: 'auto',  // Number of slides to show per view
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,  // Allows clicking pagination bullets
        },
      });
    </script>

  <!-- Produk Terlaris -->
  <section class="produk-terlaris" data-aos="fade-up" data-aos-delay="200">
    <div class="container section-title" data-aos="fade-up">
      <h2>Produk Terlaris</h2>
    </div>
    <div class="container">
      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
        @foreach($produkTerlarisWithName as $produk)
          <div class="col-lg-3 col-md-4 col-6 portfolio-item isotope-item">
            <a href="{{ route('pengunjung.detail', $produk->produk_id) }}" title="{{ $produk->nama_produk }}" class="portfolio-link">
              <div class="portfolio-content p-3 shadow-sm rounded">
                @if($produk->gambar_produk && file_exists(public_path('images/' . $produk->gambar_produk)))
                  <img src="{{ asset('images/' . $produk->gambar_produk) }}" class="img-fluid rounded" alt="{{ $produk->nama_produk }}">
                @else
                  <img src="{{ asset('images/default.png') }}" class="img-fluid rounded" alt="No Image">
                @endif
                <div class="portfolio-info mt-2 text-center">
                  <h4 class="mb-1">{{ $produk->nama_produk }}</h4>
                  <p class="text-primary fw-bold">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                  <p>Total Terjual: {{ $produk->total_terjual }}</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>


    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Produk</h2>
      <p>Cari Produk Yang Anda Inginkan Sekarang</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <!-- Portfolio Filters -->
        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">Semua Produk</li>
          <li data-filter=".filter-stempel">Stempel</li>
          <li data-filter=".filter-plakat">Plakat</li>
          <li data-filter=".filter-undangan">Undangan</li>
          <li data-filter=".filter-spanduk">Spanduk</li>
        </ul><!-- End Portfolio Filters -->

        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                  @foreach ($produks as $produk)
                  <div class="col-lg-3 col-md-4 col-6 portfolio-item isotope-item filter-{{ strtolower($produk->kategori->nama_kategori) }}">
                      <a href="{{ route('produk.detail', $produk->id) }}" title="{{ $produk->nama_produk }}" class="portfolio-link">
                          <div class="portfolio-content p-3 shadow-sm rounded">
                              @if($produk->images->isNotEmpty())
                                  <img src="{{ asset('images/' . $produk->images[0]->filename) }}" class="img-fluid rounded" alt="{{ $produk->nama_produk }}">
                              @else
                                  <img src="{{ asset('images/default.png') }}" class="img-fluid rounded" alt="No Image">
                              @endif
                              <div class="portfolio-info mt-2 text-center">
                                  <h4 class="mb-1">{{ $produk->nama_produk }}</h4>
                                  <p class="text-primary fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                  <p style="color: black; font-weight: normal;">Telah dilihat: {{ $produk->view_count }} kali</p>
                              </div>
                          </div>
                      </a>
                  </div>
                  @endforeach
              </div>

      </div><!-- End Portfolio Container -->

    </div><!-- End Container -->

    </section><!-- End Portfolio Section -->


            </div>

          </div>

        </section><!-- /Portfolio Section -->

    <!-- Section Title -->
    <!-- Pesan Section -->
    <section id="pesan" class="pesan section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Cara Pemesanan Produk</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3">
            <div class="info-item" data-aos="fade" data-aos-delay="200">
              <i class="bi bi-search"></i>
              <h3>1. Pilih produk</h3>
              <p>Temukan produk impian anda di Pemuda Grafika, berbagai macam-macam kategori produk tersedia!</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3">
            <div class="info-item" data-aos="fade" data-aos-delay="300">
              <i class="bi bi-cursor"></i>
              <h3>2. Klik produk yang di inginkan</h3>
              <p>Temukan informasi lebih lanjut tentang produk yang Anda minati untuk mendapatkan detail lengkap, termasuk harga dan spesifikasi</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3">
            <div class="info-item" data-aos="fade" data-aos-delay="400">
              <i class="bi bi-telephone"></i>
              <h3>3. Klik pesan sekarang</h3>
              <p>Klik pesan sekarang untuk mengirim pesan dan mulai obrolan dengan kami!</p><a href="https://api.whatsapp.com/send?phone=6282243117852&text=Halo,%20aku%20ingin%20menanyakan%20perihal%20transaksi">Klik di sini!</a></li>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3">
            <div class="info-item" data-aos="fade" data-aos-delay="500">
              <i class="bi bi-cash"></i>
              <h3>4. Lakukan pembayaran</h3>
              <p>Lakukan Pembayaran Sekarang dan Dapatkan Produk Anda!</p>
            </div>
          </div><!-- End Info Item -->

        </div><!-- End Row -->

      </div>

    </section><!-- /pesan Section -->

    <!-- End Section Title -->

    <!-- About Section -->
    <section id="about" class="about section">

          <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tentang Kami</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('assets/templates/user/img/About.jpg') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Siapakah kami?</h3>
              <p>
                Pemuda Grafika adalah perusahaan yang bergerak di bidang percetakan, melayani kebutuhan personal maupun perkantoran. Produk yang dihasilkan meliputi berbagai macam cetakan seperti spanduk, plakat, stempel, banner, ID card, undangan, dan banyak lagi. Lokasi utamanya terletak di Jalan Lembaga, Bengkalis, Riau, tepatnya di depan kampus STAIN Bengkalis.
              </p>
              <div class="text-center text-lg-start">
                <a href="{{ route('about') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Baca Selengkapnya</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>

    </section><!-- /About Section -->


<!-- Contact Section -->
<section id="contact" class="contact section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Kontak</h2>
    <p>Hubungi Kami</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-3">
        <div class="info-item" data-aos="fade" data-aos-delay="200">
          <i class="bi bi-geo-alt"></i>
          <h3>Alamat</h3>
          <p>JL LEMBAGA, SENGGORO BENGKALIS</p>
          <p>JL JEND.SUDIRMAN SEI.PAKNING</p>
        </div>
      </div><!-- End Info Item -->

      <div class="col-lg-3">
        <div class="info-item" data-aos="fade" data-aos-delay="300">
          <i class="bi bi-telephone"></i>
          <h3>Hubungi Kami</h3>
          <p>0852 7212 8296</p>
          <p>0822 9852 3300</p>
        </div>
      </div><!-- End Info Item -->

      <div class="col-lg-3">
        <div class="info-item" data-aos="fade" data-aos-delay="400">
          <i class="bi bi-envelope"></i>
          <h3>Email</h3>
          <p>pemudagrafika@gmail.com</p>
        </div>
      </div><!-- End Info Item -->

      <div class="col-lg-3">
        <div class="info-item" data-aos="fade" data-aos-delay="500">
          <i class="bi bi-clock"></i>
          <h3>Jam Buka</h3>
          <p>Senin - Jum'at: 08.00 - 21.30</p>
          <p>Sabtu: 08.00 - 17.00</p>
          <p>Minggu: 08.00 - 13.00</p>
        </div>
      </div><!-- End Info Item -->
      <!-- Tampilan Map -->
      <div class="google-maps-container">
          <div class="google-map">
              <h5>Lokasi Bengkalis</h5>
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d205.46102247799487!2d102.1329868!3d1.4865131!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d15f2fd9d4ebad%3A0x26d62e9f7075c824!2sPemuda%20Grafika%20Bengkalis%20(Percetakan%20Undangan%20Spanduk%20Bengkalis)!5e1!3m2!1sid!2sid!4v1734617911323!5m2!1sid!2sid" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div class="google-map">
              <h5>Lokasi Pakning</h5>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3287.5631011589594!2d102.1564097!3d1.3553024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d159747050295d%3A0x9ebe190fce1774a8!2sPemuda%20Grafika%20Sei.Pakning%20(Undangan%20-%20Spanduk%20-%20Stempel%20-%20Papan%20Ucapan)!5e1!3m2!1sid!2sid!4v1734632734679!5m2!1sid!2sid" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
      </div>

      <style>
      .google-maps-container {
          display: flex;
          justify-content: center; /* Menyelaraskan peta ke tengah secara horizontal */
          align-items: center; /* Menyelaraskan peta ke tengah secara vertikal */
          flex-wrap: wrap; /* Mengizinkan peta untuk turun ke baris baru jika diperlukan */
          width: 100%; /* Pastikan container memenuhi lebar penuh */
          margin: 0 auto; /* Menjaga agar container terpusat */
          padding: 20px; /* Memberikan sedikit ruang di sekitar container */
          box-sizing: border-box; /* Memastikan padding tidak mempengaruhi ukuran total */
      }

      .google-map {
          flex: 1 1 45%; /* Mengatur peta untuk menggunakan sekitar 45% lebar kontainer */
          min-width: 300px; /* Menentukan lebar minimum peta */
          max-width: 500px; /* Menentukan lebar maksimum peta */
          box-sizing: border-box; /* Memastikan padding dan margin tidak mempengaruhi ukuran total */
          margin: 10px; /* Memberikan jarak antar peta */
          text-align: center; /* Menyelaraskan judul peta ke tengah */
      }

      @media (max-width: 1024px) {
          .google-map {
              flex: 1 1 100%; /* Mengatur peta untuk menggunakan 100% lebar kontainer pada layar menengah */
              max-width: 100%; /* Menghapus batas maksimum lebar peta */
          }
      }

      @media (max-width: 768px) {
          .google-maps-container {
              /* Mengubah menjadi kolom pada layar kecil */
              align-items: center; /* Menyelaraskan peta ke tengah di perangkat kecil */
              gap: 20px; /* Mengatur jarak antar peta di layar kecil */
              padding: 10px; /* Mengurangi padding di sekitar container */
          }
          .google-map {
              width: 100%; /* Agar peta mengambil 100% lebar layar pada perangkat kecil */
              margin: 0; /* Menghapus margin untuk peta di perangkat kecil */
          }
      }
      </style>


</section><!-- /Contact Section -->


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
                  <!-- Tampilan Map -->
              <p class="mt-3"><strong>Email:</strong>
              <p style="margin: 0;"></p>
                <span>pemudagrafika@gmail.com</span>
              </p>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Tautan Berguna</h4>
            <ul>
              <li><a href="#hero">Beranda</a></li>
              <li><a href="#portfolio">Produk</a></li>
              <li><a href="#about">Tentang Kami</a></li>
              <li><a href="#contact">Kontak</a></li>
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
      <!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>WhatsApp Icon</title>
          <!-- Link Font Awesome untuk ikon WhatsApp -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
          <!-- Link ke file CSS -->
          <link rel="stylesheet" href="style.css">
      </head>
      <body>
          <!-- Container untuk ikon WhatsApp -->
          <div class="whatsapp-icon">
              <a href="https://api.whatsapp.com/send?phone=6282243117852&text=Halo,%20Saya%20Ingin%20Menanyakan%20Terkait%20Pemuda_Grafika" target="_blank">
                  <i class="fab fa-whatsapp"></i> <!-- Menggunakan kelas yang benar untuk Font Awesome -->
              </a>
              <div class="admin-status">Chat Kami Sekarang!</div>
          </div>
      </body>
      </html>

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