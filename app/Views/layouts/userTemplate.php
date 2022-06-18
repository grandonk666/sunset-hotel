<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title><?= $title ?></title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="<?= base_url('/images/favicon.png') ?>" rel="icon" />
  <link href="<?= base_url('/images/favicon.png') ?>" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('/userAsset/vendor/animate.css/animate.min.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('/userAsset/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('/userAsset/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('/userAsset/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="<?= base_url('/userAsset/css/style.css') ?>" rel="stylesheet" />

</head>

<body>
  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand me-5" href="<?= base_url() ?>">
        <!-- Sunset<span class="color-b">Hotel</span> -->
        <img src="<?= base_url('/images/logo-hotel.svg') ?>" width="180" height="auto">
      </a>

      <div class="navbar-collapse collapse justify-content-between" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link <?= ($nav == 'home') ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= ($nav == 'rooms') ? 'active' : '' ?>" href="<?= base_url('/rooms') ?>">Rooms</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= ($nav == 'transaction') ? 'active' : '' ?>" href="<?= base_url('/transaction') ?>">Transaction</a>
          </li>
        </ul>
        <a href="<?= base_url('/profile') ?>" class="btn btn-b-n nav-item">
          <?= logged_in() ? (in_groups('admin') ? 'Dashboard' : 'Profile') : 'Login' ?>
        </a>
      </div>

    </div>
  </nav>
  <!-- End Header/Navbar -->



  <?= $this->renderSection('content'); ?>

  <!-- ======= Footer ======= -->
  <footer class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright-footer">
            <p class="copyright color-text-a mb-2">
              &copy; Copyright
              <span class="color-a">Sunset Hotel</span> All Rights Reserved.
            </p>
          </div>
          <div class="credits">
            <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=EstateAgency
          -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('/userAsset/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('/userAsset/vendor/php-email-form/validate.js') ?>"></script>
  <script src="<?= base_url('/userAsset/vendor/swiper/swiper-bundle.min.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('/userAsset/js/main.js') ?>"></script>
</body>

</html>