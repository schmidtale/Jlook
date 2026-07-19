<header class="top-navbar">

    <!-- Logo -->
    <a href="<?= $basePath ?>index.php" class="logo">
        <img src="<?= $basePath ?>assets/images/Jlook.png" alt="Jlook Logo">
    </a>


    <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation">
        <i class="bi bi-list"></i>
    </button>


    <div class="nav-container" id="navContainer">
        <nav class="glass-menu">
            <?php
            $current_page = basename($_SERVER['SCRIPT_NAME']);
            ?>

            <a href="<?= $basePath ?>index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a>
            <a href="<?= $basePath ?>pages/tours.php" class="<?= ($current_page == 'tours.php') ? 'active' : '' ?>">Tours</a>
            <a href="<?= $basePath ?>pages/favorites.php" class="<?= ($current_page == 'favorites.php') ? 'active' : '' ?>">Favorites</a>
            <a href="<?= $basePath ?>pages/reservation.php" class="<?= ($current_page == 'reservation.php') ? 'active' : '' ?>">My Reservation</a>
        </nav>
    </div>

    <!-- Login / User Profile -->
    <?php if(isset($_SESSION['user_id'])): ?>

    <div class="dropdown">

        <button class="user-btn dropdown-toggle" data-bs-toggle="dropdown">

            <div class="user-avatar">
                <?= strtoupper(substr($_SESSION['user_name'],0,1)); ?>
            </div>

            <span>
                <?= htmlspecialchars($_SESSION['user_name']); ?>
            </span>

        </button>

        <ul class="dropdown-menu dropdown-menu-end">

            <li class="dropdown-header">
                <?= htmlspecialchars($_SESSION['user_email']); ?>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item" href="<?= $basePath ?>controller/logout.php">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
            </li>

        </ul>

    </div>

    <?php else: ?>

    <a href="<?= $basePath ?>pages/login.php" class="login-btn">
        <i class="bi bi-person-circle me-2"></i>
        Login
    </a>

    <?php endif; ?>

</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const navContainer = document.getElementById('navContainer');

    if (menuToggle && navContainer) {
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation(); 
            navContainer.classList.toggle('active');
            
            const icon = menuToggle.querySelector('i');
            if (navContainer.classList.contains('active')) {
                icon.classList.replace('bi-list', 'bi-x');
            } else {
                icon.classList.replace('bi-x', 'bi-list');
            }
        });

        document.addEventListener('click', function(event) {
            if (!navContainer.contains(event.target) && !menuToggle.contains(event.target)) {
                navContainer.classList.remove('active');
                const icon = menuToggle.querySelector('i');
                if (icon) icon.classList.replace('bi-x', 'bi-list');
            }
        });
    }
});
</script>