<?php
session_start();
require_once "../model/database.php";
require_once "../model/reservation_db.php";

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_msg'] = "Please log in to book a tour.";
    header("Location: ../pages/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $tour_id = filter_input(INPUT_POST, 'tour_id', FILTER_VALIDATE_INT) ?? 0;
    $travel_date = filter_input(INPUT_POST, 'travel_date', FILTER_DEFAULT) ?? '';
    $guests = filter_input(INPUT_POST, 'guests', FILTER_VALIDATE_INT) ?? 1;

    // Validate incoming data
    if ($tour_id <= 0 || empty($travel_date) || $guests <= 0) {
        $_SESSION['error_msg'] = "Invalid booking details submitted. Please try again.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../pages/tours.php'));
        exit();
    }

    try {
        global $db;
        $db_instance = $db ?? $conn;

        if (!$db_instance) {
            throw new Exception("Database connection not found.");
        }

        $query_tour = "SELECT price_yen FROM tours WHERE id = :tour_id";
        $stmt_tour = $db_instance->prepare($query_tour);
        $stmt_tour->bindValue(':tour_id', $tour_id);
        $stmt_tour->execute();
        $tour = $stmt_tour->fetch(PDO::FETCH_ASSOC);
        $stmt_tour->closeCursor();

        if (!$tour) {
            $_SESSION['error_msg'] = "The selected tour could not be found.";
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../pages/tours.php'));
            exit();
        }

        $total_price = $tour['price_yen'] * $guests;

        $result = add_reservation($tour_id, $user_id, $travel_date, $guests, $total_price);

        if ($result['success']) {
            $_SESSION['success_msg'] = "Tour booked successfully!";
            header("Location: ../pages/reservation.php");
            exit();
        } else {
            $msg = $result['message'] ?? 'Not enough seats available for this tour.';
            $errorMessage = addslashes($msg);

            echo "<script>
                alert('$errorMessage');
                window.history.back();
            </script>";
            exit();
        }

    } catch (Exception $e) {
        error_log("Booking Process Exception: " . $e->getMessage());
        $_SESSION['error_msg'] = "An unexpected error occurred while processing your booking.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../pages/tours.php'));
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}