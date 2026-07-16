<?php
require_once 'database.php';

/**
 * Add New User
 */
function add_user($name, $email, $password)
{
    global $db;

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password)
              VALUES (:name, :email, :password)";

    $statement = $db->prepare($query);

    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hash);

    $statement->execute();
    $statement->closeCursor();
}

/**
 * Check Email Already Exists
 */
function email_exists($email)
{
    global $db;

    $query = "SELECT id
              FROM users
              WHERE email = :email";

    $statement = $db->prepare($query);

    $statement->bindValue(':email', $email);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $statement->closeCursor();

    return $user ? true : false;
}

/**
 * Login User
 * Return user data if login success
 * Return false if login failed
 */
function login_user($email, $password)
{
    global $db;

    $query = "SELECT *
              FROM users
              WHERE email = :email";

    $statement = $db->prepare($query);

    $statement->bindValue(':email', $email);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $statement->closeCursor();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}
?>