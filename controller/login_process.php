<?php

session_start();

require_once "../model/user_db.php";


$email = trim($_POST['email']);
$password = $_POST['password'];


if (empty($email) || empty($password)) {

    die("Please fill in all fields.");

}


$user = login_user($email, $password);

if ($user) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];

    header("Location: ../index.php");
    exit();

} else {

    die("Invalid email or password.");

}

?>