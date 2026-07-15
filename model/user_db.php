<?php
require_once 'database.php';

function add_user($name, $email, $password) {
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'INSERT INTO users (name, email, password)
              VALUES (:name, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hash);
    $statement->execute();
    $statement->closeCursor();
}

function is_valid_user_login($username, $password) {
    global $db;
    $query = 'SELECT * FROM users WHERE name = :username';
    $stmt = $db->prepare($query);
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return password_verify($password, $user['password']);
    }
    return false;
}
// run
// password_hash('secret123', PASSWORD_DEFAULT);
// to generate hash for user passwords
?>
