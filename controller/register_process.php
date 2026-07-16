<?php

require_once "../model/user_db.php";


$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


if (
    empty($name) ||
    empty($email) ||
    empty($password) ||
    empty($confirm_password)
) {

    die("Please fill in all fields.");

}


if ($password !== $confirm_password) {

    die("Passwords do not match.");

}

if (email_exists($email)) {

    die("Email already exists.");

}


add_user($name, $email, $password);

header("Location: ../pages/login.php");
exit();

?>