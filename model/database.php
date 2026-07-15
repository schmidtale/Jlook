<?php
// ============================================================
// database.php  — shared database connection
// Include this file at the top of every page that needs the DB
// ============================================================

// TODO: change for school server
$dsn = 'mysql:host=localhost;dbname=jlook';
$username = 'root';
$password = '';
//$dsn      = 'mysql:host=172.21.82.206;dbname=jlook;charset=utf8';
//$username = 'group8';
//$password = '6827';

try {
    $db = new PDO($dsn, $username, $password);
    // Show errors as exceptions (easier to debug)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Return rows as associative arrays by default
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('<p style="color:red">Database connection failed: ' . $e->getMessage() . '</p>');
}
?>