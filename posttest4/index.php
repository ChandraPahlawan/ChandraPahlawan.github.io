<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./dist/css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <title>INDO PRIDE</title>
  </head>
  <body id="home">
    <header>
      <!-- navigation -->
      <section class="navigation">
        <div class="container">
          <div class="box-navigation animate__animated animate__fadeInDown">
            <div class="box">
              <h1>CARP</h1>
            </div>
            <div class="box menu-navigation">
              <ul>
                <li>
                  <i class="ri-home-3-line"></i>
                  <a href="#home">Beranda</a>
                </li>
                <li>
                  <i class="ri-information-line"></i>
                  <a href="#about">About Me</a>
                </li>
                <li>
                  <i class="ri-dashboard-line"></i>
                  <a href="#famous">Famous</a>
                </li>
                <li>
                  <i class="ri-image-line"></i>
                  <a href="#gallery">Gallery</a>
                </li>
                <li>
                  <i class="dark-mode-toggle"></i>
                  <button id="darkModeToggle">Dark Mode</button>
                </li>
                <li>
                  <i class="ri-phone-line"></i>
                  <a href="booking.php">Booking</a>
                </li>
              </ul>
            </div>
            <div class="box menu-bar">
              <i class="ri-menu-3-fill" style="color: white"></i>
          </div>
        </div>
      </section>
      <!-- navigation -->

      <!-- hero -->
      <section class="hero">
        <h1 class="animate__animated animate__pulse">Keindahan Bumi Nusantara Indonesia Raya</h1>
      </section>
      <!-- hero -->
    </header>

    <!-- about -->
    <section class="about" id="about">
      <div class="container">
        <div class="box-about">
          <div class="box" data-aos="fade-right" data-aos-duration="1000">
            <h1>About Me</h1>
            <p>
              Hai, saya Chandra Adha Rezki Pahlawan, seorang pecinta traveling yang membuat website ini untuk berbagi pengalaman, tips, dan inspirasi perjalanan. Bagi saya, traveling adalah cara terbaik untuk mengenal dunia, menemukan keindahan alam dan budaya, serta memperkaya perspektif hidup. Melalui website ini, saya berharap bisa membantu Anda merencanakan petualangan impian dan menikmati serunya menjelajahi dunia.
            </p>
          </div>
          <div class="box" data-aos="zoom-in" data-aos-duration="1000">
            <img src="./image/1.jpg" alt="" />
          </div>
        </div>
      </div>
    </section>
    <!-- about -->

    <!-- famous -->
    <section class="famous" id="famous">
      <div class="container">
        <div class="box-famous">
          <div class="box" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100">
            <img src="./image/toraja-famous.jpg" alt="" />
            <h1>Tanah Toraja</h1>
            <p>Adat Toraja dikenal dengan upacara kematian yang megah dan rumah tradisional tongkonan yang unik.</p>
          </div>
          <div class="box" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
            <img src="./image/famous-dayak.jpg" alt="" />
            <h1>Dayak</h1>
            <p>Suku Dayak memiliki tradisi seni ukir, rumah panjang, dan budaya yang erat terkait dengan alam.</p>
          </div>
          <div class="box" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
            <img src="./image/famous-timur.jpg" alt="" />
            <h1>Indonesia Timur</h1>
            <p>Suku Papua terkenal dengan beragam seni tubuh, rumah honai, dan kehidupan yang selaras dengan alam liar.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- famous -->

    <!-- gallery -->
    <section class="gallery" id="gallery">
      <div class="container">
        <div class="box-gallery">
          <img src="./image/g1.jpg" alt="" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100" />
          <img src="./image/g2.jpg" alt="" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300" />
          <img src="./image/g3.jpg" alt="" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500" />
          <img src="./image/g4.jpg" alt="" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="700" />
          <img src="./image/g5.jpg" alt="" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="900" />
          <img src="./image/g6.jpg" alt="" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="1100" />
        </div>
      </div>
    </section>
    <!-- gallery -->

    <!-- footer -->
    <footer>

      <p>&copy; 2024 by Chandra Adha Rezki Pahlawan</p>
    </footer>
    <!-- footer -->

    <script src="./dist/js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
