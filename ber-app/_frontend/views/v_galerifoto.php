<!doctype html>
<html lang="en">

<head>
    <!-- MULAI META TAGS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $judulapp; ?></title>
    <!-- SELESAI META TAGS -->

    <!-- MULAI CSS -->
    <link rel="icon" href="<?php echo base_url(); ?>style/_/img/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/slick.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/style.css">
    <!-- SELESAI CSS -->
</head>

<body>

    <?php $this->load->view($vheader); ?>
    <?php $this->load->view($vdata); ?>
    <?php $this->load->view($vkanan); ?>
    <?php $this->load->view($vfooter); ?>


    <!-- MULAI JAVASCRIPT -->
    <script src="<?php echo base_url(); ?>style/_/js/jquery-1.12.1.min.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/jquery.magnific-popup.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/swiper.min.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/masonry.pkgd.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/slick.min.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>style/_/js/custom.js"></script>
    <!-- SELESAI JAVASCRIPT -->
</body>
</html>

