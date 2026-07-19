<?php
session_start();
require_once "../model/database.php"; // ปรับ path ให้ตรงกับโครงสร้างโปรเจกต์ของคุณ


if (!isset($_SESSION['user_id'])) {

    header("Location: ../index.php?error=please_login");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $tour_id = isset($_POST['tour_id']) ? intval($_POST['tour_id']) : 0;
    $travel_date = isset($_POST['travel_date']) ? $_POST['travel_date'] : '';
    $guests = isset($_POST['guests']) ? intval($_POST['guests']) : 1;


    if ($tour_id <= 0 || empty($travel_date)) {
        header("Location: ../index.php?error=invalid_data");
        exit();
    }

    try {
        global $db; 
        

        $db_instance = isset($db) ? $db : $conn; 

        if (!$db_instance) {
            throw new Exception("Database connection variable not found.");
        }


        $query_tour = "SELECT price_yen FROM tours WHERE id = :tour_id";
        $stmt_tour = $db_instance->prepare($query_tour);
        $stmt_tour->bindValue(':tour_id', $tour_id);
        $stmt_tour->execute();
        $tour = $stmt_tour->fetch();
        $stmt_tour->closeCursor();

        if (!$tour) {
            header("Location: ../index.php?error=tour_not_found");
            exit();
        }

    

        $total_price = $tour['price_yen'] * $guests;


        $query_insert = "INSERT INTO reservations (tour_id, user_id, reservation_date, number_of_guests, total_price_yen, status) 
                         VALUES (:tour_id, :user_id, :reservation_date, :number_of_guests, :total_price_yen, 'confirmed')";

        $stmt_insert = $db_instance->prepare($query_insert);
        $stmt_insert->bindValue(':tour_id', $tour_id);
        $stmt_insert->bindValue(':user_id', $user_id);
        $stmt_insert->bindValue(':reservation_date', $travel_date); // วันที่เลือกจากฟอร์ม
        $stmt_insert->bindValue(':number_of_guests', $guests);      // จำนวนแขก
        $stmt_insert->bindValue(':total_price_yen', $total_price);  // ราคารวมเยน

        $stmt_insert->execute();
        $stmt_insert->closeCursor();

        $query_update_tour = "UPDATE tours 
        SET available_seats = available_seats - :guests 
        WHERE id = :tour_id";

        $stmt_update_tour = $db_instance->prepare($query_update_tour);
        $stmt_update_tour->bindValue(':guests', $guests);
        $stmt_update_tour->bindValue(':tour_id', $tour_id);
        $stmt_update_tour->execute();
        $stmt_update_tour->closeCursor();

        header("Location: ../index.php?booking=success");
        exit();

    } catch (Exception $e) {
        echo "Booking Error: " . $e->getMessage();
        exit();
    }
} else {

    header("Location: ../index.php");
    exit();
}