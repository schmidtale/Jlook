<?php

$pageTitle = "Jlook | Login";
$pageCSS = "../assets/css/login.css";

include "../includes/header.php";

?>

<!-- Login Page -->
<div class="login-page">

    <!-- Dark Overlay -->
    <div class="overlay">

        <!-- Container -->
        <div class="container">

            <!-- Row -->
            <div class="row min-vh-100 align-items-center">

                <!-- =========================
                     Left Side
                ========================== -->
                <div class="col-lg-6">

                    <h1 class="display-3 fw-bold text-white">
                        Welcome to
                        <img src="../assets/images/Jlook.png" alt="Logo" class="hero-logo">
                    </h1>

                    <p class="hero-text mt-4 mb-5">
                        Discover unforgettable tours and activities
                        across Japan with ease.
                    </p>

                    <!-- Feature Card -->
                    <div class="feature-card">

                        <div class="feature-item">

                            <i class="bi bi-stars"></i>

                            <h6>Easy to Use</h6>

                            <small>Simple Interface</small>

                        </div>

                        <div class="feature-divider"></div>

                        <div class="feature-item">

                            <i class="bi bi-wallet2"></i>

                            <h6>Budget-Friendly</h6>

                            <small>Affordable Tours</small>

                        </div>

                        <div class="feature-divider"></div>

                        <div class="feature-item">

                            <i class="bi bi-shield-check"></i>

                            <h6>Trusted</h6>

                            <small>Secure Booking</small>

                        </div>

                    </div>

                </div>

                <!-- =========================
                     Right Side
                ========================== -->
                <div class="col-lg-6 d-flex justify-content-center justify-content-lg-end">

                    <div class="login-card">

                        <h2 class="text-center text-white fw-bold mb-2">
                            Welcome Back
                        </h2>

                        <p class="text-center text-white-50 mb-4">
                            Sign in to continue your journey
                        </p>

                        <form action="../controller/login_process.php" method="POST">

                            <!-- Email -->
                            <div class="mb-3">

                                <label class="form-label text-white">
                                    Email
                                </label>

                                <div class="input-wrapper">

                                    <i class="bi bi-envelope-fill input-icon"></i>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control custom-input"
                                        placeholder="Enter your email"
                                        required>

                                </div>

                            </div>

                            <!-- Password -->
                            <div class="mb-3">

                                <label class="form-label text-white">
                                    Password
                                </label>

                                <div class="input-wrapper">

                                    <i class="bi bi-lock-fill input-icon"></i>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control custom-input"
                                        placeholder="Enter your password"
                                        required>

                                </div>

                            </div>

                            <!-- Forgot Password -->
                            <div class="d-flex justify-content-end mb-3">

                                <a href="#" class="forgot-link">
                                    Forgot Password?
                                </a>

                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-4">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="remember">

                                <label
                                    class="form-check-label text-white"
                                    for="remember">

                                    Remember Me

                                </label>

                            </div>

                            <!-- Login Button -->
                            <button
                                type="submit"
                                class="btn btn-primary w-100">

                                Login

                            </button>

                        </form>

                        <!-- Register -->
                        <p class="text-center text-white mt-4 mb-0">

                            Don't have an account?

                            <a
                                href="register.php"
                                class="signup-link fw-bold text-decoration-none">

                                Sign Up

                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include "../includes/footer.php"; ?>