<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Simpel Unisa</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset("templates/img/logo.png") }}" rel="icon">
  <link href="{{ asset("templates/img/logo.png") }}" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset("templates/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("templates/vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
  <link href="{{ asset("templates/vendor/aos/aos.css") }}" rel="stylesheet">
  <link href="{{ asset("templates/vendor/glightbox/css/glightbox.min.css") }}" rel="stylesheet">
  <link href="{{ asset("templates/vendor/swiper/swiper-bundle.min.css") }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset("templates/css/main.css") }}" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset("templates/img/logo.png") }}" alt="">
        <h1 class="sitename">Simpel Unisa</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    <a class="btn-getstarted btn btn-success" href="/login">LogIn</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <img src="{{ asset('templates/img/hero-bg-abstract.jpg') }}" alt="" data-aos="fade-in" class="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-out">
          <div class="col-xl-7 col-lg-9 text-center">
            <h1>Selamat Datang Di Simpel Unisa</h1>
            <p>Simpel Unisa Adalah Web Pengelola Informasi Pengolahan Sampah Yang ada di Lingkungan Kampus Universitas Aisyiyah Yogyakarta</p>
          </div>
        </div>
        <div class="text-center" data-aos="zoom-out" data-aos-delay="100">
          <a href="/login" class="btn-get-started">Get Started</a>
        </div>
        <div class="row gy-4 mt-5">
          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-bar-chart"></i></div>
                <h4 class="title"><a href="">Timbunan Sampah</a></h4>
                <p class="description">Jumlah: {{ $trashes->where('created_at', '>=', now()->startOfYear())->sum('weight') }} kg</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="200">
            <div class="icon-box">
                <div class="icon"><i class="bi bi-recycle"></i></div>
              <h4 class="title"><a href="">Pengurangan Sampah</a></h4>
                <p class="description">
                @php
                  $twoYearsAgoWeight = $trashes->where('collection_date', '>=', now()->subYears(2)->startOfYear())
                     ->where('collection_date', '<', now()->subYear()->startOfYear())
                     ->sum('weight');
                  $lastYearWeight = $trashes->where('collection_date', '>=', now()->subYear()->startOfYear())
                     ->where('collection_date', '<', now()->startOfYear())
                     ->sum('weight');
                  $percentageReduction = $twoYearsAgoWeight > 0 ? (($twoYearsAgoWeight - $lastYearWeight) / $twoYearsAgoWeight) * 100 : 0;
                @endphp
                Penurunan: {{ number_format($percentageReduction, 2) }}%
                </p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="300">
            <div class="icon-box">
                <div class="icon"><i class="bi bi-trash"></i></div>
                <h4 class="title"><a href="">Jenis Sampah Terbanyak</a></h4>
                <p class="description">{{ $trashes->where('created_at', '>=', now()->startOfYear())->groupBy('category.name')->sortByDesc(function ($group) {
                  return $group->sum('weight');
                })->keys()->first() }}</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-command"></i></div>
              <h4 class="title"><a href="">Sampah Saat Ini</a></h4>
                <p class="description">Jumlah: {{ $trashes->where('collection_date', '>=', now()->startOfYear())->sum('weight') }} kg</p>
            </div>
          </div><!--End Icon Box -->

        </div>
      </div>

    </section>
    <!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us<br></h2>
        <p>Selamat datang di Sistem Informasi Pengelolaan Sampah Universitas 'Aisyiyah Yogyakarta!
          Sistem Informasi Pengelolaan Sampah ini dikembangkan untuk mendukung upaya pelestarian lingkungan di lingkungan kampus Universitas 'Aisyiyah Yogyakarta. 
          Kami berkomitmen untuk menciptakan lingkungan kampus yang bersih, sehat, dan ramah lingkungan melalui pengelolaan sampah yang efektif dan efisien.
        </p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p>
              Tujuan Kami.
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> 
                <span>
                    Meningkatkan Kesadaran Lingkungan
                    Membantu civitas akademika dalam memahami pentingnya pengelolaan sampah yang benar dan dampaknya terhadap lingkungan.
                </span>
              </li>
              <li><i class="bi bi-check2-circle"></i> 
                <span>
                  Mengoptimalkan Pengelolaan Sampah
                  Memastikan pengelolaan sampah di lingkungan kampus dilakukan dengan sistematis, mulai dari pemilahan, pengumpulan, hingga daur ulang.
                </span>
              </li>
              <li><i class="bi bi-check2-circle"></i> 
                <span>
                  Mendukung Program Kampus Hijau
                  Berperan aktif dalam mendukung Universitas 'Aisyiyah Yogyakarta menjadi kampus hijau dan ramah lingkungan.
                </span>
              </li>
            </ul>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <p>
              Komitmen Kami
            </p>
            <p>
              Kami percaya bahwa perubahan besar dimulai dari langkah kecil. Dengan adanya Sistem Informasi Pengelolaan Sampah ini, kami berharap seluruh civitas akademika Universitas 'Aisyiyah Yogyakarta dapat berperan aktif dalam menjaga kebersihan dan kelestarian lingkungan kampus.
              Mari bersama-sama wujudkan kampus yang bersih, hijau, dan lestari! 🌿 
            </p>
            <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

        </div>

      </div>

    </section>
    <!-- /About Section -->

    <!-- About Alt Section -->
    <section id="about-alt" class="about-alt section">

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('templates/img/logo-unisa.jpg')}}" class="img-fluid" alt="">
            <a href="https://youtu.be/BAB4N_t9lh0?si=Brb5xm8gN4u2bnaW" class="glightbox pulsating-play-btn"></a>
          </div>
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
            <h3>Universitas ’Aisyiyah Yogyakarta</h3>
            <p class="fst-italic">
              Universitas ‘Aisyiyah Yogyakarta (UNISA) sebagai sebuah institusi pendidikan tinggi  berdiri sejak 6 Juni 1991. Dengan pengalaman lebih dari 30 tahun UNISA Yogyakarta bertransformasi menjadi sebuah universitas yang mempunyai cita-cita besar untuk menjadi universitas unggul dan pilihan berlandaskan spirit Islam berkemajuan dengan fokus pada kajian dan pengembangan bidang kesehatan.
            </p>
            <p>
            </p>
          </div>
        </div>

      </div>

    </section>
    <!-- /About Alt Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('templates/img/clients/unisa.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('templates/img/clients/unisa.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('templates/img/clients/unisa.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('templates/img/clients/unisa.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('templates/img/clients/unisa.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('templates/img/clients/unisa.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- Statistik Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Statistik</h2>
        <p>Statistik ini menyajikan data pengelolaan sampah sebagai dasar evaluasi dan perencanaan dalam mendukung kebijakan lingkungan yang berkelanjutan.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
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
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 1,
                  "spaceBetween": 20
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                {{-- <p> --}}
                  <div class="chart-area">
                    {!! $chart->container() !!}
                  </div>
                {{-- </p> --}}
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                {{-- <p> --}}
                  <div class="chart-area">
                    {!! $chart2->container() !!}
                  </div>
                {{-- </p> --}}
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                {{-- <p> --}}
                  <div class="chart-area">
                    {!! $chart3->container() !!}
                  </div>
                {{-- </p> --}}
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                {{-- <p> --}}
                  <div class="chart-area">
                    {!! $chart4->container() !!}
                  </div>
                {{-- </p> --}}
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                {{-- <p> --}}
                  <div class="chart-area">
                    {!! $chart5->container() !!}
                  </div>
                {{-- </p> --}}
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                {{-- <p> --}}
                  <div class="chart-area">
                    {!! $chart6->container() !!}
                  </div>
                {{-- </p> --}}
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                {{-- <p> --}}
                  <div class="chart-area">
                    {!! $chart7->container() !!}
                  </div>
                {{-- </p> --}}
              </div>
            </div><!-- End testimonial item -->

          </div>
          
          <div class="swiper-pagination"></div>
        </div>

      </div>

      <!-- Include Swiper CSS -->
      <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

      <!-- Include Swiper JS -->
      <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
          768: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
        },
          });

          // Adjust chart area size
          const chartAreas = document.querySelectorAll('.chart-area');
          chartAreas.forEach(chart => {
        chart.style.width = '100%';
        chart.style.height = 'auto';
          });
        });
      </script>
      
    </section>
    <!-- /Testimonials Section -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                </svg>
                <i class="bi bi-activity"></i>
              </div>
              <a href="#services" class="stretched-link">
                <h3>Pencatatan dan Pemantauan Sampah</h3>
              </a>
              <p>Sistem ini memungkinkan pencatatan dan pemantauan jumlah sampah yang dihasilkan di lingkungan kampus secara real-time.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                </svg>
                <i class="bi bi-broadcast"></i>
              </div>
              <a href="#services" class="stretched-link">
                <h3>Pengelolaan Sampah Terpilah</h3>
              </a>
              <p>Membantu memisahkan jenis sampah organik, anorganik, dan B3 (Bahan Berbahaya dan Beracun) untuk pengelolaan yang lebih efektif.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781"></path>
                </svg>
                <i class="bi bi-easel"></i>
              </div>
              <a href="#services" class="stretched-link">
                <h3>Laporan dan Statistik</h3>
              </a>
              <p>Menyediakan laporan terperinci mengenai pengelolaan sampah untuk evaluasi dan perbaikan berkelanjutan.</p>
            </div>
          </div><!-- End Service Item -->
        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Team Section -->
    <section id="team" class="team section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Adapun tim penyusun terdiri dari:</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset ('templates/img/team/avatars-4.png') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Sugi</h4>
                <span>Chief Executive Officer</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset ('templates/img/team/avatar-1.png') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Rizki</h4>
                <span>Product Manager</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset ('templates/img/team/avatars-2.png') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Restu</h4>
                <span>CTO</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset ('templates/img/team/avatars-3.png') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Fikri</h4>
                <span>Accountant</span>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau memerlukan informasi lebih lanjut tentang sistem pengelolaan sampah di kampus. Kami siap membantu! 🌿</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63251.235634654666!2d110.27491522594714!3d-7.768367689929516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a587709f8feb9%3A0x9092c640c6f901ac!2s&#39;Aisyiyah%20Yogyakarta%20University!5e0!3m2!1sen!2sid!4v1732624803854!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->
        
        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>Jl. Ring Road Barat, Nogotirto, Gamping, Sleman, Yogyakarta, 55292</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>(0274) 4469199</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>info@unisayogya.ac.id</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">SimpelUnisa</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Jl. Ring Road Barat, Nogotirto, Gamping, Sleman, Yogyakarta, 55292</p>
          <p class="mt-4"><strong>Phone:</strong> <span>(0274) 4469199</span></p>
          <p><strong>Email:</strong> <span>info@unisayogya.ac.id</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p><span class="small-text">Copyright &copy; Simpel Unisa {{ date('Y') }}</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('templates/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('templates/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('templates/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('templates/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('templates/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('templates/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('templates/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('templates/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('templates/js/main.js') }}"></script>

  <script src="{{ $chart->cdn() }}"></script>
  {{ $chart->script() }}

  <script src="{{ $chart2->cdn() }}"></script>
  {{ $chart2->script() }}

  <script src="{{ $chart3->cdn() }}"></script>
  {{ $chart3->script() }}

  <script src="{{ $chart4->cdn() }}"></script>
  {{ $chart4->script() }}

  <script src="{{ $chart5->cdn() }}"></script>
  {{ $chart5->script() }}

  <script src="{{ $chart6->cdn() }}"></script>
  {{ $chart6->script() }}

  <script src="{{ $chart7->cdn() }}"></script>
  {{ $chart7->script() }}
</body>

</html>