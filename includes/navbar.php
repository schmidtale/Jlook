<header class="top-navbar">

    <!-- Logo -->
    <a href="<?= $basePath ?>index.php" class="logo">

        <img
            src="<?= $basePath ?>assets/images/Jlook.png"
            alt="Jlook Logo">

    </a>

    <!-- Center Menu -->
    <nav class="glass-menu">

        <a href="<?= $basePath ?>index.php" class="active">
            Home
        </a>

        <a href="<?= $basePath ?>pages/tours.php">
            Tours
        </a>

        <a href="<?= $basePath ?>pages/favorites.php">
            Favorites
        </a>

        <a href="<?= $basePath ?>pages/reservation.php">
            My Reservation
        </a>

    </nav>

    <!-- Login -->
    <?php if(isset($_SESSION['user_id'])): ?>

<div class="dropdown">

    <button
        class="user-btn dropdown-toggle"
        data-bs-toggle="dropdown">

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

            <a
                class="dropdown-item"
                href="<?= $basePath ?>controller/logout.php">

                <i class="bi bi-box-arrow-right me-2"></i>

                Logout

            </a>

        </li>

    </ul>

</div>

<?php else: ?>

<a
    href="<?= $basePath ?>pages/login.php"
    class="login-btn">

    Login

</a>

<?php endif; ?>

</header>