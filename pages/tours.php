<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/database.php';
require_once '../model/tour_db.php';
require_once '../model/favorites_db.php';
$pageTitle = "Tours | Jlook";
$basePath = "../";
$pageCSS = "../assets/css/tours.css";

$user_id = $_SESSION['user_id'];
$tours = get_tours();

// Fetch user's favorite tour IDs from the database
$user_fav_ids = [];
$my_favs = search_favorites($user_id, '', 'recent');
if (!empty($my_favs)) {
    $user_fav_ids = array_column($my_favs, 'id');
}

include '../includes/header.php';
?>
<link rel="stylesheet" href="../assets/css/home.css">

<?php include "../includes/navbar.php"; ?>

<main>

    <!-- =========================
     Hero
========================= -->
    <section class="tour-hero">
        <div class="container">
            <div class="tour-hero-content">

                <span class="hero-tag">EXPLORE JAPAN</span>

                <h1>
                    Explore Our <span>Tours</span>
                </h1>

                <p>
                    Discover unforgettable experiences across Japan. Find the perfect tour for your next adventure.
                </p>

                <!-- Combined Search Bar with Sort Inside -->
                <div class="tour-search">
                    <div class="search-input">
                        <i class="bi bi-search"></i>
                        <input type="text" id="searchTour" placeholder="Search by tour or city...">
                    </div>

                    <div class="search-divider"></div>

                    <div class="sort-wrapper">
                        <i class="bi bi-arrow-down-up sort-icon"></i>
                        <select id="sortTour">
                            <option value="popular">Popularity</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="name">Name A-Z</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================
     Tour Layout
========================= -->
    <section class="tour-section">
        <div class="container">
            <div class="tour-layout">

                <!-- Sidebar -->
                <aside class="tour-sidebar">
                    <h3>
                        <i class="bi bi-sliders"></i>
                        Filters
                    </h3>

                    <div class="filter-group">
                        <h5>Destination</h5>
                        <label>
                            <input type="checkbox" class="city-filter" value="tokyo">
                            Tokyo
                        </label>
                        <label>
                            <input type="checkbox" class="city-filter" value="kyoto">
                            Kyoto
                        </label>
                        <label>
                            <input type="checkbox" class="city-filter" value="osaka">
                            Osaka
                        </label>
                        <label>
                            <input type="checkbox" class="city-filter" value="hokkaido">
                            Hokkaido
                        </label>
                    </div>

                    <div class="filter-group">
                        <h5>Price</h5>
                        <input type="range" min="5000" max="50000" value="50000">
                        <span>Up to ¥50,000</span>
                    </div>
                </aside>

                <!-- Tour Cards Area -->
                <div class="tour-content">
                    <div class="tour-grid">

                        <?php foreach($tours as $tour): ?>

                        <div class="tour-card" data-name="<?= strtolower($tour['name']) ?>"
                            data-city="<?= strtolower($tour['city']) ?>" data-price="<?= $tour['price_yen'] ?>">

                            <div class="tour-image">
                                <img src="../assets/images/<?= htmlspecialchars($tour['image']); ?>"
                                    alt="<?= htmlspecialchars($tour['name']); ?>">

                                <?php
                                $is_favorite = in_array($tour['id'], $user_fav_ids);
                                $fav_action = $is_favorite ? 'remove' : 'add';
                                $fav_icon = $is_favorite ? 'bi-heart-fill text-danger' : 'bi-heart';
                                $fav_title = $is_favorite ? 'Remove from favorites' : 'Add to favorites';
                                ?>

                                <form action="../controller/favorite_process.php" method="POST" class="d-inline">
                                    <input type="hidden" name="tour_id" value="<?= $tour['id']; ?>">
                                    <input type="hidden" name="action" value="<?= $fav_action; ?>">
                                    <button type="submit" class="fav-btn" title="<?= $fav_title; ?>">
                                        <i class="bi <?= $fav_icon; ?>"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="tour-content-body">
                                <span class="tour-city">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <?= htmlspecialchars($tour['city']); ?>
                                </span>

                                <h3>
                                    <?= htmlspecialchars($tour['name']); ?>
                                </h3>

                                <div class="tour-price">
                                    ¥<?= number_format($tour['price_yen']); ?>
                                    <span>/ person</span>
                                </div>

                                <?php
                                $seat = $tour['available_seats'];

                                if ($seat <= 5) {
                                    $seatIcon = "bi-fire";
                                    $seatText = "Only $seat Seats Left";
                                    $seatColor = "#ff5a5f";
                                } elseif ($seat <= 15) {
                                    $seatIcon = "bi-exclamation-circle-fill";
                                    $seatText = "$seat Seats Available";
                                    $seatColor = "#ffb400";
                                } else {
                                    $seatIcon = "bi-people-fill";
                                    $seatText = "$seat Seats Available";
                                    $seatColor = "#38d996";
                                }
                                ?>

                                <div class="seat-info">
                                    <i class="bi <?= $seatIcon ?>" style="color: <?= $seatColor ?>;"></i>
                                    <span><?= $seatText ?></span>
                                </div>

                                <button class="book-btn" onclick="openBookingModal(
                                    '<?= $tour['id']; ?>',
                                    '<?= htmlspecialchars($tour['name'], ENT_QUOTES); ?>',
                                    '<?= htmlspecialchars($tour['city'], ENT_QUOTES); ?>',
                                    '<?= $tour['price_yen']; ?>',
                                    '../assets/images/<?= htmlspecialchars($tour['image'], ENT_QUOTES); ?>'
                                )">
                                    Book Now
                                </button>
                            </div>

                        </div>

                        <?php endforeach; ?>

                    </div>

                    <!-- No Result -->
                    <div id="noResult">
                        <i class="bi bi-search"></i>
                        <h3>No tours found</h3>
                        <p>Try another keyword.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================
     Booking Modal (Pop-up)
========================= -->
    <div id="bookingModal" class="booking-modal-overlay">
        <div class="booking-modal-card">
            <button class="close-modal-btn" onclick="closeBookingModal()">
                &times;
            </button>

            <div class="booking-modal-body">
                <!-- Left -->
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

                <!-- Right -->
                <div class="modal-right-form">
                    <h3>Book Your Adventure</h3>
                    <p class="form-lead">Fill in the details below to secure your booking.</p>

                    <form action="../controller/booking_process.php" method="POST">
                        <input type="hidden" id="modalTourId" name="tour_id">

                        <div class="form-group mb-3">
                            <label for="bookingDate">
                                <i class="bi bi-calendar3"></i> Travel Date
                            </label>
                            <input type="date" id="bookingDate" name="travel_date" class="form-control-custom" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="bookingGuests">
                                <i class="bi bi-people"></i> Number of Guests
                            </label>
                            <select id="bookingGuests" name="guests" class="form-control-custom"
                                onchange="calculateTotalPrice()">
                                <option value="1">1 Person</option>
                                <option value="2">2 Persons</option>
                                <option value="3">3 Persons</option>
                                <option value="4">4 Persons</option>
                                <option value="5">5 Persons</option>
                            </select>
                        </div>

                        <div class="total-price-display">
                            <span>Total Price</span>
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

    <script src="../assets/js/tour.js"></script>

    <?php include '../includes/footer.php'; ?>
</main>