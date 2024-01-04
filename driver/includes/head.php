<?php session_start();?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed " dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template">
<?php include 'include/session.php'; ?>
<?php
date_default_timezone_set("Africa/Lagos");
$conn = $pdo->open();
try{
  $stmt = $conn->prepare("SELECT * FROM about WHERE id = 1");
  $stmt->execute();
  $about = $stmt->fetch();
}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();
$now = date('d F, Y');
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo $settings['site_name']; ?> | <?php echo $admin['username']; ?></title>
  <meta name="description" content="<?php echo $settings['site_desc']; ?>">
  <meta name="keyword" content="<?php echo $settings['site_keyword']; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="theme-color" content="<?php echo $settings['theme']; ?>">
  <meta name="msapplication-navbutton-color" content="<?php echo $settings['theme']; ?>">
  <meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $settings['theme']; ?>">
  <meta name="language" content="English">
  <meta name="revisit-after" content="1 days">
  <meta name="author" content="Adebisi Covenant">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?php echo $settings['site_url']; ?>" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta property="og:title" content="<?php echo $settings['site_name']; ?>"/>
  <meta property="og:locale" content="en_US"/>
  <meta property="og:url" content="<?php echo $settings['site_url']; ?>"/>
  <meta property="og:type" content="website"/>
  <meta property="og:description" content="<?php echo $settings['site_desc']; ?>">
  <meta property="og:image" content="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">

  <meta property="twitter:card" content="summary"/>
  <meta property="twitter:title" content="<?php echo $settings['site_name']; ?>"/>
  <meta property="twitter:description" content="<?php echo $settings['site_desc']; ?>">
  <meta property="twitter:url" content="<?php echo $settings['site_url']; ?>"/>
  <meta property="twitter:image" content="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">

  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">
  <link rel="manifest" href="<?php echo $settings['site_url']; ?>assets/pwa/manifest">
  <meta name="msapplication-TileImage" content="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">

  <!-- Icons -->
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/fonts/fontawesome.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/fonts/flag-icons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/css/demo.css" />


  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/flatpickr/flatpickr.css" />
  <!-- Row Group CSS -->
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/animate-css/animate.css">

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/select2/select2.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/pages/card-analytics.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/pages/page-profile.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/pages/page-faq.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/pages/app-invoice.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/pages/app-chat.css">
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/spinkit/spinkit.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/quill/typography.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/quill/editor.css" />
  <!-- Helpers -->
  <script src="<?php echo $settings['site_url']; ?>assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="<?php echo $settings['site_url']; ?>assets/vendor/js/template-customizer.js"></script>
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?php echo $settings['site_url']; ?>assets/js/config.js"></script>
  <!-- Custom notification for demo -->
  <!-- beautify ignore:end -->
</head>
<?php include 'format.php'; ?>
