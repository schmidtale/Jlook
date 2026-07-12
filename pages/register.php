<?php

$pageTitle = "Jlook | Register";
$pageCSS = "../assets/css/register.css";

include "../includes/header.php";

?>

<!-- Register Page -->
<div class="register-page">

    <!-- Dark Overlay -->
    <div class="overlay">

        <div class="container">

            <div class="row min-vh-100 align-items-center">

                <!-- =========================
                     Left Side
                ========================== -->
                <div class="col-lg-6">

                    <h1 class="display-3 fw-bold text-white">
                        Welcome to
                        <span class="brand-name">Jlook</span>
                    </h1>

                    <p class="hero-text mt-4 mb-5">
                        Join Jlook and start exploring unforgettable
                        tours and activities across Japan.
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

                    <div class="register-card">

                        <h2 class="text-center text-white fw-bold mb-2">
                            Create Account
                        </h2>

                        <p class="text-center text-white-50 mb-4">
                            Join Jlook and start your journey.
                        </p>

                        <form action="../controller/register_process.php" method="POST">

                            <!-- Name -->
                            <div class="mb-3">

                                <label class="form-label text-white">
                                    Name
                                </label>

                                <div class="input-wrapper">

                                    <i class="bi bi-person-fill input-icon"></i>

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control custom-input"
                                        placeholder="Enter your name"
                                        required>

                                </div>

                            </div>

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

                                    <i class="bi bi-key-fill input-icon"></i>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control custom-input"
                                        placeholder="Enter your password"
                                        required>

                                </div>

                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">

                                <label class="form-label text-white">
                                    Confirm Password
                                </label>

                                <div class="input-wrapper">

                                    <i class="bi bi-key-fill input-icon"></i>

                                    <input
                                        type="password"
                                        name="confirm_password"
                                        class="form-control custom-input"
                                        placeholder="Confirm your password"
                                        required>

                                </div>

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100">

                                Create Account

                            </button>

                        </form>

                        <p class="text-center text-white mt-4 mb-0">

                            Already have an account?

                            <a
                                href="login.php"
                                class="signup-link fw-bold text-decoration-none">

                                Login

                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include "../includes/footer.php"; ?>