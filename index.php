<?php

$basePath = "";

include "includes/header.php";

?>

<!-- Home CSS -->
<link rel="stylesheet" href="assets/css/home.css">

<!-- Navbar -->
<?php include "includes/navbar.php"; ?>

<!-- =========================
     Hero Section
========================= -->
<section class="hero">

    <div class="container">

        <div class="hero-content">

            <!-- =========================
                 Left Content
            ========================== -->
            <div class="hero-left">

                <span class="hero-tag">
                    Tour and Activities to explore Japan
                </span>

                <h1>
                    Discover amazing tours and
                    <span> unforgettable experiences across Japan</span>
                </h1>

                <p>
                    Explore Japan's most iconic destinations,
                    hidden gems, and unforgettable adventures
                    with Jlook.
                </p>

                <a href="pages/tours.php" class="explore-btn">
                    Book now
                </a>

            </div>

            <!-- =========================
                 Right Content
            ========================== -->
            <div class="hero-right">

                <div class="hero-slider">

                    <!-- Featured Card -->
                    <div class="hero-card featured-card">

                        <img src="assets/images/tokyo-tower.png" alt="Tokyo Tower">

                        <div class="hero-card-body">

                            <h3>Tokyo Adventure</h3>

                            <p>
                                Experience the very best of Tokyo in one unforgettable day.
                            </p>

                        </div>

                    </div>

                    <!-- Small Card 1 -->
                    <div class="hero-card small-card">

                        <img src="assets/images/1.png" alt="Kyoto">

                    </div>

                    <!-- Small Card 2 -->
                    <div class="hero-card small-card">

                        <img src="assets/images/2.png" alt="Mt. Fuji">

                    </div>

                </div>

                <!-- Slider Navigation -->
                <div class="slider-control">

                    <button class="slider-btn">
                        ←
                    </button>

                    <button class="slider-btn">
                        →
                    </button>

                    <div class="slider-line"></div>

                    <span class="slider-count">
                        01/05
                    </span>

                </div>

            </div>

        </div>

        <div class="search-box">

            <div class="search-item">

                <i class="bi bi-geo-alt-fill"></i>

                <div>

                    <h6>Where to?</h6>

                    <small>Destination, city or tour name</small>

                </div>

            </div>

            <div class="search-divider"></div>

            <div class="search-item">

                <i class="bi bi-calendar-event-fill"></i>

                <div>

                    <h6>Check-in</h6>

                    <small>Select date</small>

                </div>

            </div>

            <div class="search-divider"></div>

            <div class="search-item">

                <i class="bi bi-person-fill"></i>

                <div>

                    <h6>Guests</h6>

                    <small>1 Guest</small>

                </div>

            </div>

            <button class="search-btn">

                <i class="bi bi-search"></i>

                Search Tour

            </button>

        </div>

    </div>

</section>

<!-- =========================
     Popular Tours
========================= -->
<section class="popular-section">

    <div class="container">

        <div class="section-header">

            <div>

                <span class="section-subtitle">
                    POPULAR DESTINATIONS
                </span>

                <h2 class="section-title">
                    Popular Tours
                </h2>

            </div>

            <a href="pages/tours.php" class="view-all">
                View All →
            </a>

        </div>

        <div class="popular-grid">

            <!-- Card 1 -->
            <div class="tour-card">

                <div class="tour-image">

                    <img src="assets/images/tokyo-tower.png" alt="Tokyo">

                    <button class="favorite-btn">

                        <i class="bi bi-heart"></i>

                    </button>

                </div>

                <div class="tour-info">

                    <h4>

                        Tokyo Tower Tour

                    </h4>

                    <p>

                        <i class="bi bi-geo-alt-fill"></i>

                        Tokyo

                    </p>

                    <div class="tour-footer">

                        <div>

                            <small>From</small>

                            <h3>¥8,000</h3>

                        </div>

                        <button class="book-btn">

                            Book Now

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- Footer -->
<?php include "includes/footer.php"; ?>