<?php
session_start();
require_once "../model/database.php";
require_once "../model/favorites_db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$tour_id = filter_input(INPUT_POST, 'tour_id', FILTER_VALIDATE_INT);
$action = filter_input(INPUT_POST, 'action', FILTER_DEFAULT);

if ($tour_id) {
    if ($action === 'remove') {
        remove_favorite($user_id, $tour_id);
    } else {
        add_favorite($user_id, $tour_id);
    }
}

$redirect_url = $_SERVER['HTTP_REFERER'] ?? '../pages/favorites.php';
header("Location: " . $redirect_url);
exit();