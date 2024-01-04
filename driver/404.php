<?php include 'includes/head.php'; ?>
<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/pages/page-misc.css">

<body>

  <!-- Content -->

  <!-- Error -->
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2">Page Not Found :(</h2>
      <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
      <a href="#" onclick="history.back()" class="btn btn-primary">Back to Previous Page</a><br>
      <a href="home" class="btn btn-primary">Back to home</a>
      <div class="mt-3">
        <img src="<?php echo $settings['site_url']; ?>assets/img/illustrations/page-misc-error-light.png" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-light.png" data-app-light-img="illustrations/page-misc-error-light.png">
      </div>
    </div>
  </div>
  <!-- /Error -->

  <?php include 'includes/scripts.php'; ?>
</body>
</html>
