<?php
function add_favorite($user_id, $tour_id) {
    global $db;

    $query = 'INSERT INTO favorites (user_id, tour_id)
              VALUES (:user_id, :tour_id)';

    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':tour_id', $tour_id);

    $statement->execute();
    $statement->closeCursor();
}

function get_favorites($user_id) {
    global $db;

    $query = 'SELECT * FROM favorites
              WHERE user_id = :user_id';

    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();

    // Fetch all matching records as an associative array
    $favorites = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $favorites;
}