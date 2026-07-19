<?php
session_start();
require_once "../model/database.php";
require_once "../model/reservation_db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$reservation_id = filter_input(INPUT_POST, 'reservation_id', FILTER_VALIDATE_INT);
$action = filter_input(INPUT_POST, 'action', FILTER_DEFAULT);

if ($reservation_id && $action === 'cancel') {
    $success = cancel_reservation($reservation_id, $user_id);

    if ($success) {
        header("Location: ../pages/reservation.php?status=cancelled");
        exit();
    } else {
        header("Location: ../pages/reservation.php?status=confirmed&error=cancel_failed");
        exit();
    }
}

header("Location: ../pages/reservation.php");
exit();