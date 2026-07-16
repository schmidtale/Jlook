<?php
function add_reservation($tour_id, $user_id, $reservation_date, $number_of_guests, $total_price_yen) {
    global $db;

    try {
        // 1. Start a transaction
        $db->beginTransaction();

        // 2. Deduct seats from the tour
        $update_query = 'UPDATE tours
                         SET available_seats = available_seats - :guests
                         WHERE id = :tour_id';
        $update_stmt = $db->prepare($update_query);
        $update_stmt->bindValue(':guests', $number_of_guests);
        $update_stmt->bindValue(':tour_id', $tour_id);
        $update_stmt->execute();
        $update_stmt->closeCursor();

        // 3. Insert the reservation
        $query = 'INSERT INTO reservations (tour_id, user_id, reservation_date, number_of_guests, total_price_yen, status)
                  VALUES (:tour_id, :user_id, :reservation_date, :number_of_guests, :total_price_yen, "confirmed")';
        $statement = $db->prepare($query);
        $statement->bindValue(':tour_id', $tour_id);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':reservation_date', $reservation_date);
        $statement->bindValue(':number_of_guests', $number_of_guests);
        $statement->bindValue(':total_price_yen', $total_price_yen);
        $statement->execute();
        $statement->closeCursor();

        // 4. If both actions succeeded, save them permanently
        $db->commit();
        return true;

    } catch (PDOException $e) {
        $db->rollBack();
        error_log("Reservation failed: " . $e->getMessage());
        return false;
    }
}

function get_reservations($user_id, $status = null) {
    global $db;

    // 1. Automatically update past "confirmed" reservations to "completed"
    try {
        $update_query = 'UPDATE reservations
                         SET status = "completed"
                         WHERE user_id = :user_id
                           AND reservation_date < CURDATE()
                           AND status = "confirmed"';
        $update_stmt = $db->prepare($update_query);
        $update_stmt->bindValue(':user_id', $user_id);
        $update_stmt->execute();
        $update_stmt->closeCursor();
    } catch (PDOException $e) {
        error_log("Failed to auto-complete past reservations: " . $e->getMessage());
    }

    // 2. Fetch the reservations JOINED with the tours table
    if ($status !== null) {
        $query = 'SELECT r.*, t.name, t.city
                  FROM reservations r
                  INNER JOIN tours t ON r.tour_id = t.id
                  WHERE r.user_id = :user_id AND r.status = :status
                  ORDER BY r.id DESC';
    } else {
        $query = 'SELECT r.*, t.name, t.city
                  FROM reservations r
                  INNER JOIN tours t ON r.tour_id = t.id
                  WHERE r.user_id = :user_id
                  ORDER BY r.id DESC';
    }

    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);

    if ($status !== null) {
        $statement->bindValue(':status', $status);
    }

    $statement->execute();
    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $reservations;
}

function cancel_reservation($reservation_id, $user_id) {
    global $db;

    try {
        $db->beginTransaction();

        // 1. Get reservation details to find out how many seats to restore
        $query = 'SELECT tour_id, number_of_guests, status FROM reservations
                  WHERE id = :reservation_id AND user_id = :user_id FOR UPDATE';
        $statement = $db->prepare($query);
        $statement->bindValue(':reservation_id', $reservation_id);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $reservation = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        if (!$reservation) {
            throw new Exception("Reservation not found.");
        }

        // 2. Only restore seats if the reservation is currently "confirmed"
        if ($reservation['status'] === 'confirmed') {
            $restore_query = 'UPDATE tours
                              SET available_seats = available_seats + :guests
                              WHERE id = :tour_id';
            $restore_stmt = $db->prepare($restore_query);
            $restore_stmt->bindValue(':guests', $reservation['number_of_guests']);
            $restore_stmt->bindValue(':tour_id', $reservation['tour_id']);
            $restore_stmt->execute();
            $restore_stmt->closeCursor();
        }

        // 3. Update the reservation status to cancelled
        $update_query = 'UPDATE reservations
                         SET status = "cancelled"
                         WHERE id = :reservation_id AND user_id = :user_id';
        $update_stmt = $db->prepare($update_query);
        $update_stmt->bindValue(':reservation_id', $reservation_id);
        $update_stmt->bindValue(':user_id', $user_id);
        $update_stmt->execute();
        $update_stmt->closeCursor();

        $db->commit();
        return true;

    } catch (Exception $e) {
        $db->rollBack();
        error_log("Cancellation failed: " . $e->getMessage());
        return false;
    }
}