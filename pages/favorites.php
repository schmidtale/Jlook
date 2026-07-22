<?php
session_start();

$basePath = "../";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "../model/database.php";
require_once "../model/favorites_db.php";

$user_id = $_SESSION['user_id'];

// Capture search query & sort parameter from URL
$search = filter_input(INPUT_GET, 'search', FILTER_DEFAULT) ?? '';
$sort = filter_input(INPUT_GET, 'sort', FILTER_DEFAULT) ?? 'recent';

// Fetch user's actual matching favorites
$favorite_tours = search_favorites($user_id, $search, $sort);

$pageTitle = "Jlook | Favorites";
$pageCSS = "../assets/css/favorites.css";

include "../includes/header.php";
?>

<link rel="stylesheet" href="../assets/css/home.css">
<?php include "../includes/navbar.php"; ?>

<div class="favorites-page">

    <header class="favorites-hero">
        <div class="banner-overlay d-flex align-items-end">
            <div class="container banner-content">
                <h1 class="display-4 fw-bold text-white mb-0">Explore our tour in Japan</h1>
            </div>
        </div>
    </header>

    <main class="favorites-content py-5">
        <div class="container">

            <form action="favorites.php" method="GET" class="search-bar-combined d-flex align-items-center justify-content-between mb-5">

                <div class="search-left d-flex align-items-center flex-grow-1">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" name="search" class="search-input" placeholder="Search your favorites..."
                           value="<?php echo htmlspecialchars($search); ?>">
                </div>

                <div class="sort-right d-flex align-items-center gap-1">
                    <span class="sort-label">Sorted by:</span>
                    <select name="sort" class="sort-select" onchange="this.form.submit()">
                        <option value="recent" <?php echo $sort === 'recent' ? 'selected' : ''; ?>>Recent additions</option>
                        <option value="price_low_high" <?php echo $sort === 'price_low_high' ? 'selected' : ''; ?>>Price: Low to High</option>
                        <option value="price_high_low" <?php echo $sort === 'price_high_low' ? 'selected' : ''; ?>>Price: High to Low</option>
                    </select>
                </div>

                <button type="submit" style="display: none;"></button>
            </form>

            <div class="favorites-grid">
                <?php if (!empty($favorite_tours)): ?>
                    <?php foreach ($favorite_tours as $tour): ?>
                        <div class="fav-card">
                            <div class="card-image-section">
                                <img src="<?php echo $basePath . 'assets/images/' . htmlspecialchars($tour['image']); ?>"
                                     alt="<?php echo htmlspecialchars($tour['name']); ?>"
                                     onerror="this.src='<?php echo $basePath; ?>assets/images/1.png'">

                                <form action="<?php echo $basePath; ?>controller/favorite_process.php" method="POST" class="d-inline">
                                    <input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
                                    <input type="hidden" name="action" value="remove">
                                    <button type="submit" class="fav-heart-btn" title="Remove from favorites">
                                        <i class="bi bi-heart-fill text-danger"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="card-info-section">
                                <h5 class="tour-title"><?php echo htmlspecialchars($tour['name']); ?></h5>
                                <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> <?php echo htmlspecialchars($tour['city']); ?></p>
                                <p class="tour-meta"><i class="bi bi-people-fill"></i> Available: <?php echo htmlspecialchars($tour['available_seats']); ?> seats</p>
                                <div class="card-action-row">
                                    <div class="price-container">
                                        <small>Start at</small>
                                        <h4>¥ <?php echo number_format($tour['price_yen']); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-heartbreak text-muted" style="font-size: 3rem;"></i>
                        <p class="mt-3 text-muted">No favorite tours found matching your selection.</p>
                        <a href="../index.php" class="btn btn-primary mt-2">Explore Tours</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

</div>

<?php include "../includes/footer.php"; ?>