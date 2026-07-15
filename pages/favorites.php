<?php

$basePath = "../";

$pageTitle = "Jlook | Favorites";
$pageCSS = "../assets/css/favorites.css";

include "../includes/header.php";

?>

<link rel="stylesheet" href="../assets/css/home.css">

<?php include "../includes/navbar.php"; ?>

<!-- Favorites Page -->
<div class="favorites-page">

    <!-- Scenic Hero Banner Section -->
    <header class="favorites-hero">
        <div class="banner-overlay d-flex align-items-end">
            <div class="container banner-content">
                <h1 class="display-4 fw-bold text-white mb-0">Explore our tour in Japan</h1>
            </div>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="favorites-content py-5">
        <div class="container">

            <!-- Combined Search & Filter Bar -->
            <div class="search-bar-combined d-flex align-items-center justify-content-between mb-5">

                <!-- Left: Search Input -->
                <div class="search-left d-flex align-items-center flex-grow-1">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search your favorites...">
                </div>

                <!-- Right: Inline Dropdown Sorting -->
                <div class="sort-right d-flex align-items-center gap-1">
                    <span class="sort-label">Sorted by:</span>
                    <select class="sort-select">
                        <option value="recent">Recent additions</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                    </select>
                </div>

            </div>

            <!-- TODO: Display logged in users favorites-->
            <!-- 5-Column Grid Layout -->
            <div class="favorites-grid">
                <!-- Tour Card 1 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/ghibli.png" alt="Ghibli Museum Visit" onerror="this.src='../assets/images/1.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">Ghibli Museum Visit</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Tokyo</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 8,000</h4>
                            </div>
                            <a href="tour-details.php?id=1" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 2 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/bamboo.png" alt="Bamboo Grove" onerror="this.src='../assets/images/2.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">Bamboo Grove</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Kyoto</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 10,000</h4>
                            </div>
                            <a href="tour-details.php?id=2" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 3 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/shibuya.png" alt="Shibuya Crossing" onerror="this.src='../assets/images/tokyo-tower.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">Shibuya Crossing</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Tokyo</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 6,000</h4>
                            </div>
                            <a href="tour-details.php?id=3" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 4 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/tokyo-tower.png" alt="Tokyo Tower" onerror="this.src='../assets/images/tokyo-tower.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">Tokyo Tower</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Tokyo</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 8,000</h4>
                            </div>
                            <a href="tour-details.php?id=4" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 5 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/fushimi.png" alt="Fushimi Inari" onerror="this.src='../assets/images/2.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">Fushimi Inari</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Kyoto</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 8,000</h4>
                            </div>
                            <a href="tour-details.php?id=5" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 6 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/teamlab.png" alt="teamLab Borderless" onerror="this.src='../assets/images/1.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">teamLab Borderless</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Tokyo</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 102,000</h4>
                            </div>
                            <a href="tour-details.php?id=6" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 7 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/arashiyama.png" alt="Arashiyama" onerror="this.src='../assets/images/2.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">Arashiyama</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Kyoto</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 6,000</h4>
                            </div>
                            <a href="tour-details.php?id=7" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 8 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/harajuku.png" alt="Harajuku Street" onerror="this.src='../assets/images/tokyo-tower.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">Harajuku Street</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Tokyo</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 6,000</h4>
                            </div>
                            <a href="tour-details.php?id=8" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 9 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/nikko.png" alt="Nikko Shrine" onerror="this.src='../assets/images/1.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">Nikko Shrine</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Tochigi</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 6,000</h4>
                            </div>
                            <a href="tour-details.php?id=9" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 10 -->
                <div class="fav-card">
                    <div class="card-image-section">
                        <img src="../assets/images/sensoji.png" alt="Senso-ji" onerror="this.src='../assets/images/tokyo-tower.png'">
                        <button class="fav-heart-btn">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </div>
                    <div class="card-info-section">
                        <h5 class="tour-title">Senso-ji</h5>
                        <p class="tour-meta"><i class="bi bi-geo-alt-fill"></i> Tokyo</p>
                        <p class="tour-meta"><i class="bi bi-people-fill"></i> 2 Booked</p>
                        <div class="card-action-row">
                            <div class="price-container">
                                <small>Start at</small>
                                <h4>¥ 8,000</h4>
                            </div>
                            <a href="tour-details.php?id=10" class="btn btn-detail">View Detail</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

</div>

<?php include "../includes/footer.php"; ?>