<?php
session_start();
require_once "../model/user_db.php";

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    $_SESSION['login_error'] = "Please fill in all fields.";
    header("Location: ../pages/login.php");
    exit();
}

$user = login_user($email, $password);

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];

    header("Location: ../index.php");
    exit();
} else {
    $_SESSION['login_error'] = "Invalid email or password.";
    header("Location: ../pages/login.php");
    exit();
}
?>