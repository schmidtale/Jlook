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

function remove_favorite($user_id, $tour_id) {
    global $db;

    $query = 'DELETE FROM favorites
              WHERE user_id = :user_id AND tour_id = :tour_id';

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

function search_favorites($user_id, $search_term = '', $sort_by = 'recent') {
    global $db;

    $query = 'SELECT t.*, f.user_id
              FROM favorites f
              INNER JOIN tours t ON f.tour_id = t.id
              WHERE f.user_id = :user_id';

    if (!empty($search_term)) {
        $query .= ' AND (t.name LIKE :search
                      OR t.city LIKE :search
                      OR t.description LIKE :search)';
    }

    switch ($sort_by) {
        case 'price_low_high':
            $query .= ' ORDER BY t.price_yen ASC';
            break;
        case 'price_high_low':
            $query .= ' ORDER BY t.price_yen DESC';
            break;
        case 'recent':
        default:
            $query .= ' ORDER BY t.id DESC';
            break;
    }

    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);

    if (!empty($search_term)) {
        $like_term = '%' . $search_term . '%';
        $statement->bindValue(':search', $like_term);
    }

    $statement->execute();
    $favorites = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $favorites;
}