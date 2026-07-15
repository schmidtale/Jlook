<?php
function add_reservation($tour_id, $user_id, $reservation_date, $number_of_guests, $total_price_yen) {
    global $db;

    $query = 'INSERT INTO reservations (tour_id, user_id, reservation_date, number_of_guests, total_price_yen)
              VALUES (:tour_id, :user_id, :reservation_date, :number_of_guests, :total_price_yen)';

    $statement = $db->prepare($query);

    $statement->bindValue(':tour_id', $tour_id);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':reservation_date', $reservation_date);
    $statement->bindValue(':number_of_guests', $number_of_guests);
    $statement->bindValue(':total_price_yen', $total_price_yen);

    $statement->execute();
    $statement->closeCursor();
}

function get_reservations($user_id) {
    global $db;

    $query = 'SELECT * FROM reservations
              WHERE user_id = :user_id
              ORDER BY id';

    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();

    // Fetch all matching records as an associative array
    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $reservations;
}