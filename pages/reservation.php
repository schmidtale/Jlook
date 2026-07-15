<?php

$basePath = "../";

$pageTitle = "Jlook | My Reservations";
$pageCSS = "../assets/css/reservation.css";

include "../includes/header.php";

?>

<link rel="stylesheet" href="../assets/css/home.css">

<?php include "../includes/navbar.php"; ?>

<!-- Reservations Page -->
<div class="reservations-page">

    <header class="page-banner">
        <div class="banner-overlay">
            <div class="container text-center text-md-start banner-content">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                    <h1 class="fw-bold text-white mb-0">My Reservations</h1>
                    <span class="calendar-icon-badge">
                        <i class="bi bi-calendar-check"></i>
                    </span>
                </div>
                <p class="text-white-50 mt-2 mb-0">View and manage all your upcoming tours.</p>
            </div>
        </div>
    </header>

    <main class="reservations-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">

                    <div class="d-flex flex-column align-items-start gap-3 mb-4">
                        <h3 class="text-white fw-bold mb-0">My Reservations</h3>

                        <div class="status-filters">
                            <button class="btn-filter active">Completed</button>
                            <button class="btn-filter">Cancelled</button>
                        </div>
                    </div>

                    <!-- TODO: Show logged in users reservations -->
                    <div class="booking-list d-flex flex-column gap-4">

                        <div class="booking-card">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4 col-lg-3">
                                    <div class="booking-img-wrapper">
                                        <img src="../assets/images/tokyo-tower.png" alt="Mt. Fuji Day Trip" class="booking-img" onerror="this.src='../assets/images/1.png'">
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-6">
                                    <div class="booking-details">
                                        <span class="badge badge-completed mb-2">Completed</span>
                                        <h4 class="text-white fw-bold mb-2">Mt. Fuji Day Trip</h4>
                                        <div class="details-meta d-flex flex-column gap-1">
                                            <span class="meta-item"><i class="bi bi-geo-alt-fill me-2"></i>Yamanashi, Japan</span>
                                            <span class="meta-item"><i class="bi bi-calendar3 me-2"></i>25 May 2026</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 text-md-end">
                                    <div class="booking-price-action">
                                        <div class="mb-3">
                                            <small class="price-label">Total Amount</small>
                                            <span class="price-amount">¥19,000</span>
                                        </div>
                                        <a href="#" class="btn btn-action">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="booking-card">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4 col-lg-3">
                                    <div class="booking-img-wrapper">
                                        <img src="../assets/images/tokyo-tower.png" alt="Kyoto Cultural Tour" class="booking-img" onerror="this.src='../assets/images/1.png'">
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-6">
                                    <div class="booking-details">
                                        <span class="badge badge-confirmed mb-2">Confirmed</span>
                                        <h4 class="text-white fw-bold mb-2">Kyoto Cultural Tour</h4>
                                        <div class="details-meta d-flex flex-column gap-1">
                                            <span class="meta-item"><i class="bi bi-geo-alt-fill me-2"></i>Kyoto, Japan</span>
                                            <span class="meta-item"><i class="bi bi-calendar3 me-2"></i>10 June 2026</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 text-md-end">
                                    <div class="booking-price-action">
                                        <div class="mb-3">
                                            <small class="price-label">Total Amount</small>
                                            <span class="price-amount">¥15,000</span>
                                        </div>
                                        <a href="#" class="btn btn-action">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="booking-card">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4 col-lg-3">
                                    <div class="booking-img-wrapper">
                                        <img src="../assets/images/tokyo-tower.png" alt="Tokyo Tower Tour" class="booking-img" onerror="this.src='../assets/images/1.png'">
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-6">
                                    <div class="booking-details">
                                        <span class="badge badge-completed mb-2">Completed</span>
                                        <h4 class="text-white fw-bold mb-2">Tokyo Tower Tour</h4>
                                        <div class="details-meta d-flex flex-column gap-1">
                                            <span class="meta-item"><i class="bi bi-geo-alt-fill me-2"></i>Tokyo, Japan</span>
                                            <span class="meta-item"><i class="bi bi-calendar3 me-2"></i>20 April 2026</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 text-md-end">
                                    <div class="booking-price-action">
                                        <div class="mb-3">
                                            <small class="price-label">Total Amount</small>
                                            <span class="price-amount">¥16,000</span>
                                        </div>
                                        <a href="#" class="btn btn-action">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="booking-card">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4 col-lg-3">
                                    <div class="booking-img-wrapper">
                                        <img src="../assets/images/tokyo-tower.png" alt="Osaka Castle Tour" class="booking-img" onerror="this.src='../assets/images/2.png'">
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-6">
                                    <div class="booking-details">
                                        <span class="badge badge-cancelled mb-2">Cancelled</span>
                                        <h4 class="text-white fw-bold mb-2">Osaka Castle & City Tour</h4>
                                        <div class="details-meta d-flex flex-column gap-1">
                                            <span class="meta-item"><i class="bi bi-geo-alt-fill me-2"></i>Osaka, Japan</span>
                                            <span class="meta-item"><i class="bi bi-calendar3 me-2"></i>8 March 2026</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 text-md-end">
                                    <div class="booking-price-action">
                                        <div class="mb-3">
                                            <small class="price-label">Total Amount</small>
                                            <span class="price-amount">¥13,600</span>
                                        </div>
                                        <a href="#" class="btn btn-action">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <p class="text-center text-white-50 mt-5 mb-0">
                        <i class="bi bi-info-circle me-1"></i> Can't find your booking?
                        <a href="#" class="text-decoration-none support-link ms-1 fw-bold">Contact our support team</a>
                    </p>

                </div>
            </div>
        </div>
    </main>

</div>

<?php include "../includes/footer.php"; ?>