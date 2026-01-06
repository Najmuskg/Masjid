<?php
// Is intro forced via URL?
$intro = isset($_GET['intro']) ? $_GET['intro'] : NULL;
// If intro isn't in URL, check cookie - if less than 1... intro = 1
if (!$intro) {
    if (isset($_COOKIE['masjid_home_visited'])) {
        $intro = 0;
    } else {
        // First visit
        setcookie("masjid_home_visited", 1, time() + (60 * 60 * 24 * 7), '/');
        $intro = 1;
    }
}
?>


<!doctype html>
<html class="loading" <?php language_attributes(); ?>>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php if ($intro == 1) : ?>
        <?php //get_template_part('layout-modules/_preloader');
        ?>
    <?php endif; ?>


    <div class="main--wrapper">

        <!-- ==================== Start header--wrapper ==================== -->

        <section class="header--wrapper">
            <?php get_template_part('layout-modules/_top-header'); ?>

            <?php get_template_part('layout-modules/_header-image-banner'); ?>

        </section>

        <!-- ==================== End header--wrapper ==================== -->

        <div class="holder container">

            <!-- ==================== Start Article ==================== -->