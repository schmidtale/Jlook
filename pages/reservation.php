<?php
session_start();
$basePath = "../";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "../model/database.php";
require_once "../model/reservation_db.php";
$user_id = $_SESSION['user_id'];

// Capture the currently selected status filter (Defaulting to 'confirmed')
$current_status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT) ?? 'confirmed';

// Fetch user's actual reservations matching the filter
$user_reservations = get_reservations($user_id, $current_status);

$pageTitle = "Jlook | My Reservations";
$pageCSS = "../assets/css/reservation.css";

include "../includes/header.php";
?>

<link rel="stylesheet" href="../assets/css/home.css">

<?php include "../includes/navbar.php"; ?>

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
                            <a href="?status=confirmed" class="btn-filter <?php echo $current_status === 'confirmed' ? 'active' : ''; ?>">Confirmed</a>
                            <a href="?status=completed" class="btn-filter <?php echo $current_status === 'completed' ? 'active' : ''; ?>">Completed</a>
                            <a href="?status=cancelled" class="btn-filter <?php echo $current_status === 'cancelled' ? 'active' : ''; ?>">Cancelled</a>
                        </div>
                    </div>

                    <div class="booking-list d-flex flex-column gap-4">
                        <?php if (!empty($user_reservations)): ?>
                            <?php foreach ($user_reservations as $res): ?>
                                <div class="booking-card">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-4 col-lg-3">
                                            <div class="booking-img-wrapper">
                                                <img src="<?php echo $basePath . 'assets/images/' . htmlspecialchars($res['image']); ?>"
                                                     alt="<?php echo htmlspecialchars($res['name']); ?>"
                                                     class="booking-img"
                                                     onerror="this.src='<?php echo $basePath; ?>assets/images/1.png'">
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-6">
                                            <div class="booking-details">
                                                <?php if ($res['status'] === 'completed'): ?>
                                                    <span class="badge badge-completed mb-2">
                                                        <i class="bi bi-check-circle-fill"></i> Completed
                                                    </span>
                                                <?php elseif ($res['status'] === 'confirmed'): ?>
                                                    <span class="badge badge-confirmed mb-2">
                                                        <i class="bi bi-check-circle"></i> Confirmed
                                                    </span>
                                                <?php elseif ($res['status'] === 'cancelled'): ?>
                                                    <span class="badge badge-cancelled mb-2">
                                                        <i class="bi bi-x-circle-fill"></i> Cancelled
                                                    </span>
                                                <?php endif; ?>

                                                <h4 class="text-white fw-bold mb-2"><?php echo htmlspecialchars($res['name']); ?></h4>
                                                <div class="details-meta d-flex flex-column gap-1">
                                                    <span class="meta-item">
                                                        <i class="bi bi-geo-alt-fill me-2"></i><?php echo htmlspecialchars($res['city']); ?>, Japan
                                                    </span>
                                                    <span class="meta-item">
                                                        <i class="bi bi-calendar3 me-2"></i><?php echo date('d M Y', strtotime($res['reservation_date'])); ?>
                                                    </span>
                                                    <span class="meta-item">
                                                        <i class="bi bi-people-fill me-2"></i>Guests: <?php echo htmlspecialchars($res['number_of_guests']); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 text-md-end">
                                            <div class="booking-price-action">
                                                <div class="mb-3">
                                                    <small class="price-label">Total Amount</small>
                                                    <span class="price-amount">¥<?php echo number_format($res['total_price_yen']); ?></span>
                                                </div>

                                                <?php if ($res['status'] === 'confirmed'): ?>
                                                    <form action="<?php echo $basePath; ?>controller/reservation_process.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                                        <input type="hidden" name="reservation_id" value="<?php echo $res['id']; ?>">
                                                        <input type="hidden" name="action" value="cancel">
                                                        <button type="submit" class="btn btn-action btn-outline-danger w-100">Cancel Tour</button>
                                                    </form>
                                                <?php else: ?>
                                                    <a href="tours.php" class="btn btn-action w-100">Book Again</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-3 text-muted">No <?php echo htmlspecialchars($current_status); ?> reservations found.</p>
                                <a href="../index.php" class="btn btn-primary mt-2">Find a Tour</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>

<?php include "../includes/footer.php"; ?>