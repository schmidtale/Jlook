<?php
function get_tours() {
    global $db;
    $query = 'SELECT * FROM tours
              ORDER BY id';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;
}

function search_tours($search_term) {
    global $db;

    $query = 'SELECT * FROM tours
              WHERE name LIKE :search
                 OR city LIKE :search
                 OR destination LIKE :search
              ORDER BY id';

    $statement = $db->prepare($query);

    // use wildcards for partial matches
    $like_term = '%' . $search_term . '%';
    $statement->bindValue(':search', $like_term);

    $statement->execute();
    $tours = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $tours;
}

// show tours with least available seats > 0 at top
function get_popular_tours() {
    global $db;

    $query = 'SELECT * FROM tours
              ORDER BY (available_seats = 0) ASC, available_seats ASC, id ASC';

    $statement = $db->prepare($query);
    $statement->execute();

    $tours = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $tours;
}