<?php

require_once 'model/database.php';
require_once 'model/tour_db.php';

$tour_statement = get_tours();
$tours = $tour_statement->fetchAll(PDO::FETCH_ASSOC);
$tour_statement->closeCursor();

$basePath = "";

include "includes/header.php";

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
========================= -->
            <div class="hero-right">

                <!-- Hero Slider -->
                <div class="hero-slider">

                    <!-- Featured Card -->
                    <div class="hero-card featured-card">

                        <img id="featuredImage" src="" alt="">

                        <div class="hero-card-body">

                            <h3 id="featuredTitle"></h3>

                            <p id="featuredDesc"></p>

                        </div>

                    </div>

                    <!-- Small Card 1 -->
                    <div class="hero-card small-card">

                        <img id="smallImage1" src="" alt="">

                        <div class="small-card-body">

                            <h5 id="smallTitle1"></h5>

                        </div>

                    </div>

                    <!-- Small Card 2 -->
                    <div class="hero-card small-card">

                        <img id="smallImage2" src="" alt="">

                        <div class="small-card-body">

                            <h5 id="smallTitle2"></h5>

                        </div>

                    </div>

                </div>

                <!-- Slider Navigation -->
                <div class="slider-control">

                    <button id="prevBtn" class="slider-btn">
                        <i class="bi bi-arrow-left"></i>
                    </button>

                    <button id="nextBtn" class="slider-btn">
                        <i class="bi bi-arrow-right"></i>
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

            <!-- Tour Card -->
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

                    <p class="tour-location">

                        <i class="bi bi-geo-alt-fill"></i>

                        Tokyo

                    </p>

                    <p class="tour-booked">

                        <i class="bi bi-people-fill"></i>

                        245 Booked

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

<!-- =========================
     Budget Friendly
========================= -->

<section class="budget-section">

    <div class="container">

        <div class="section-header">

            <div>

                <span class="section-subtitle">
                    SAVE MORE
                </span>

                <h2 class="section-title">
                    Budget-Friendly Tours
                </h2>

            </div>

            <a href="pages/tours.php" class="view-all">
                View All →
            </a>

        </div>

        <div class="budget-grid">

            <!-- Card -->

            <div class="budget-card">

                <img src="assets/images/2.png" alt="Osaka">

                <div class="budget-body">

                    <span class="discount-badge">
                        SAVE 30%
                    </span>

                    <h4>Osaka City Tour</h4>

                    <p>

                        <i class="bi bi-geo-alt-fill"></i>

                        Osaka

                    </p>

                    <div class="price-row">

                        <span class="old-price">
                            ¥10,000
                        </span>

                        <span class="new-price">
                            ¥7,000
                        </span>

                    </div>

                    <button class="book-btn">

                        Book Now

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>

<script>
const tours = <?= json_encode($tours, JSON_UNESCAPED_UNICODE); ?>;
</script>t
<script src="assets/js/home.js"></script>
<!-- Footer -->
<?php include "includes/footer.php"; ?>