<?php

require_once 'model/database.php';
require_once 'model/tour_db.php';

$tour_statement = get_tours();
$budget_tours = get_budget_tours();
$tours = $tour_statement->fetchAll(PDO::FETCH_ASSOC);
$tour_statement->closeCursor();

$basePath = "";

include "includes/header.php";

$basePath = "";

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

        <form class="search-box" action="pages/tours.php" method="GET">

            <div class="search-item">

                <i class="bi bi-geo-alt-fill"></i>

                <div class="search-input-group">

                    <label>Where to?</label>

                    <input type="text" id="searchTour" name="search" placeholder="Destination, city or tour">

                    <div id="searchSuggestion" class="search-suggestion"></div>

                </div>

            </div>
            <div class="search-divider"></div>

            <div class="search-item">

                <i class="bi bi-calendar-event-fill"></i>

                <div>

                    <label>Check-in</label>

                    <input type="date" name="date">

                </div>

            </div>

            <div class="search-divider"></div>

            <div class="search-item">

                <i class="bi bi-person-fill"></i>

                <div>

                    <label>Guests</label>

                    <select name="guest">

                        <option value="1">1 Guest</option>

                        <option value="2">2 Guests</option>

                        <option value="3">3 Guests</option>

                        <option value="4">4 Guests</option>

                        <option value="5">5+ Guests</option>

                    </select>

                </div>

            </div>

            <button type="submit" class="search-btn">

                <i class="bi bi-search"></i>

                Search Tour

            </button>

        </form>

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

            <a href="pages/tours.php" class="view-all-btn">

                View All
                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

        <div class="tour-grid">

            <?php foreach(array_slice($tours, 0, 4) as $tour): ?>

            <?php

            $seat = $tour['available_seats'];

            if ($seat <= 5) {

                $seatIcon = "bi-fire";
                $seatText = "Only $seat Seats Left";
                $seatColor = "#ff5a5f";

                $badge = "🔥 Almost Full";
                $badgeClass = "danger";

            } elseif ($seat <= 15) {

                $seatIcon = "bi-exclamation-circle-fill";
                $seatText = "$seat Seats Available";
                $seatColor = "#ffb400";

                $badge = "Limited";
                $badgeClass = "warning";

            } else {

                $seatIcon = "bi-people-fill";
                $seatText = "$seat Seats Available";
                $seatColor = "#38d996";

                $badge = "Available";
                $badgeClass = "success";

            }

            ?>

            <div class="tour-card">

                <div class="tour-image">

                    <img src="assets/images/<?php echo $tour['image']; ?>" alt="<?php echo $tour['name']; ?>">

                    <span class="tour-badge <?= $badgeClass ?>">
                        <?= $badge ?>
                    </span>

                </div>

                <div class="tour-content">

                    <span class="tour-city">

                        <i class="bi bi-geo-alt-fill"></i>

                        <?= $tour['city']; ?>

                    </span>

                    <h3>

                        <?= $tour['name']; ?>

                    </h3>

                    <div class="tour-price">

                        <i class="bi bi-cash-stack"></i>

                        ¥<?= number_format($tour['price_yen']); ?>

                        <span>/ person</span>

                    </div>

                    <div class="seat-info">

                        <i class="bi <?= $seatIcon ?>" style="color:<?= $seatColor ?>"></i>

                        <span><?= $seatText ?></span>

                    </div>

                    <button class="book-btn">

                        Book Now

                    </button>

                </div>

            </div>

            <?php endforeach; ?>

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
                <span class="section-subtitle">SAVE MORE</span>
                <h2 class="section-title">Budget-Friendly Tours</h2>
            </div>
            <a href="pages/tours.php" class="view-all-btn">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="tour-grid">
            <?php foreach(array_slice($budget_tours, 0, 4) as $tour): ?>
            <?php
            // 1. ดึงราคาปัจจุบัน (ราคาที่ลดแล้ว) จาก Database[cite: 1]
            $current_price = $tour['price_yen'];
            
            // 2. คำนวณราคาเต็ม (สมมติว่าลดราคามา 30% ราคาเต็มจึงเป็นราคาปัจจุบันหารด้วย 0.7)
            $old_price = $current_price / 0.7;
            
            // 3. จัดการเรื่องจำนวนที่นั่ง[cite: 1]
            $seat = $tour['available_seats'];
            if ($seat <= 5) {
                $seatIcon = "bi-fire"; $seatText = "Only $seat Seats Left"; $seatColor = "#ff5a5f";
            } elseif ($seat <= 15) {
                $seatIcon = "bi-exclamation-circle-fill"; $seatText = "$seat Seats Available"; $seatColor = "#ffb400";
            } else {
                $seatIcon = "bi-people-fill"; $seatText = "$seat Seats Available"; $seatColor = "#38d996";
            }
            ?>
            
            <div class="tour-card">
                <div class="tour-image">
                    <img src="assets/images/<?php echo $tour['image']; ?>" alt="<?php echo $tour['name']; ?>">
                    <!-- ปรับจาก Badge สถานะที่นั่ง เป็น Badge บอกเปอร์เซ็นต์ส่วนลดสีน้ำเงินเด่นๆ -->
                    <span class="discount-badge">SAVE 30%</span>
                </div>
                
                <div class="tour-content">
                    <span class="tour-city"><i class="bi bi-geo-alt-fill"></i> <?= $tour['city']; ?></span>
                    <h3><?= $tour['name']; ?></h3>
                    
                    <!-- ส่วนแสดงราคาเดิมเปรียบเทียบกับราคาใหม่ -->
                    <div class="price-row" style="margin: 15px 0 5px 0;">
                        <span class="old-price" style="text-decoration: line-through; color: #999; font-size: 16px; margin-right: 10px;">
                            ¥<?= number_format($old_price); ?>
                        </span>
                        <span class="new-price" style="color: #FFD369; font-size: 28px; font-weight: 700;">
                            ¥<?= number_format($current_price); ?>
                        </span>
                        <span style="font-size: 14px; color: #bbb; font-weight: 500;">/ person</span>
                    </div>

                    <div class="seat-info" style="margin-top: 10px;">
                        <i class="bi <?= $seatIcon ?>" style="color:<?= $seatColor ?>"></i> <span><?= $seatText ?></span>
                    </div>
                    
                    <button class="book-btn">Book Now</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
const tours = <?= json_encode($tours, JSON_UNESCAPED_UNICODE); ?>;
</script>

<script src="assets/js/home.js"></script>
<!-- Footer -->
<?php include "includes/footer.php"; ?>