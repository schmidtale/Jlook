<?php
function get_tours() {
    global $db;
    $query = 'SELECT * FROM tours
              ORDER BY id';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;
}