<?php

require_once 'model/database.php';
require_once 'model/tour_db.php';
require_once "model/favorites_db.php";


$user_fav_ids = [];
$tour_statement = get_tours();
$budget_tours = get_budget_tours();
$tours = $tour_statement->fetchAll(PDO::FETCH_ASSOC);
$tour_statement->closeCursor();

$basePath = "";

include "includes/header.php";

$basePath = "";


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];


    $my_favs = search_favorites($user_id, '', 'recent');


    if (!empty($my_favs)) {
        $user_fav_ids = array_column($my_favs, 'id');
    }
}
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

                    <?php
                    $is_favorite = in_array($tour['id'], $user_fav_ids);
                    $fav_action = $is_favorite ? 'remove' : 'add';
                    $fav_icon = $is_favorite ? 'bi-heart-fill text-danger' : 'bi-heart';
                    ?>
                    <form action="controller/favorite_process.php" method="POST" class="d-inline">
                        <input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
                        <input type="hidden" name="action" value="<?php echo $fav_action; ?>">
                        <button type="submit" class="fav-btn">
                            <i class="bi <?php echo $fav_icon; ?>"></i>
                        </button>
                    </form>

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


                    <button class="book-btn" onclick="openBookingModal(
                        '<?= $tour['id']; ?>',
                        '<?= htmlspecialchars($tour['name'], ENT_QUOTES); ?>',
                        '<?= $tour['city']; ?>',
                        '<?= $tour['price_yen']; ?>',
                        'assets/images/<?= $tour['image']; ?>'
                    )">
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
            $current_price = $tour['price_yen'];

            $old_price = $current_price / 0.7;

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
                    <?php

                    $is_favorite = in_array($tour['id'], $user_fav_ids);


                    $fav_action = $is_favorite ? 'remove' : 'add';
                    $fav_icon = $is_favorite ? 'bi-heart-fill text-danger' : 'bi-heart';
                    $fav_title = $is_favorite ? 'Remove from favorites' : 'Add to favorites';
                    ?>
                    <form action="controller/favorite_process.php" method="POST" class="d-inline">
                        <input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
                        <input type="hidden" name="action" value="<?php echo $fav_action; ?>">
                        <button type="submit" class="fav-btn" title="<?php echo $fav_title; ?>">
                            <i class="bi <?php echo $fav_icon; ?>"></i>
                        </button>
                    </form>

                    <span class="budget-badge">SAVE 30%</span>
                </div>

                <div class="tour-content">
                    <span class="tour-city"><i class="bi bi-geo-alt-fill"></i> <?= $tour['city']; ?></span>
                    <h3><?= $tour['name']; ?></h3>

                    <div class="price-row" style="margin: 15px 0 5px 0;">
                        <span class="old-price"
                            style="text-decoration: line-through; color: #999;">¥<?= number_format($old_price); ?></span>
                        <span class="new-price"
                            style="color: #FFD369; font-size: 28px; font-weight: 700;">¥<?= number_format($current_price); ?></span>
                    </div>


                    <button class="book-btn" onclick="openBookingModal(
                        '<?= $tour['id']; ?>',
                        '<?= htmlspecialchars($tour['name'], ENT_QUOTES); ?>',
                        '<?= $tour['city']; ?>',
                        '<?= $tour['price_yen']; ?>',
                        'assets/images/<?= $tour['image']; ?>'
                    )">
                        Book Now
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =========================
     Booking Modal (Pop-up)
========================= -->
<div id="bookingModal" class="booking-modal-overlay">
    <div class="booking-modal-card">

        <button class="close-modal-btn" onclick="closeBookingModal()">&times;</button>

        <div class="booking-modal-body">
            <div class="modal-left-summary">
                <div class="modal-tour-img-wrap">
                    <img id="modalTourImage" src="" alt="Tour Image">
                </div>
                <div class="modal-tour-info">
                    <span id="modalTourCity" class="modal-city-tag"></span>
                    <h3 id="modalTourName"></h3>
                    <div class="modal-base-price">
                        <small>Price per person</small>
                        <p>¥<span id="modalBasePriceNum">0</span></p>
                    </div>
                </div>
            </div>

            <div class="modal-right-form">
                <h3>Book Your Adventure</h3>
                <p class="form-lead">Fill in the details below to secure your slots instantly.</p>

                <form action="controller/booking_process.php" method="POST">
                    <input type="hidden" id="modalTourId" name="tour_id" value="">

                    <div class="form-group mb-3">
                        <label for="bookingDate"><i class="bi bi-calendar3"></i> Travel Date</label>
                        <input type="date" id="bookingDate" name="travel_date" class="form-control-custom" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>


                    <div class="form-group mb-4">
                        <label for="bookingGuests"><i class="bi bi-people"></i> Number of Guests</label>
                        <select id="bookingGuests" name="guests" class="form-control-custom"
                            onchange="calculateTotalPrice()">
                            <option value="1">1 Person</option>
                            <option value="2">2 Persons</option>
                            <option value="3">3 Persons</option>
                            <option value="4">4 Persons</option>
                            <option value="5">5+ Persons</option>
                        </select>
                    </div>

                    <div class="total-price-display">
                        <span>Total Price:</span>
                        <strong id="modalTotalPrice">¥0</strong>
                    </div>

                    <button type="submit" class="confirm-booking-btn">
                        <i class="bi bi-credit-card-fill"></i> Proceed to Checkout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const tours = <?= json_encode($tours, JSON_UNESCAPED_UNICODE); ?>;
</script>

<script src="assets/js/home.js"></script>
<!-- Footer -->
<?php include "includes/footer.php"; ?>