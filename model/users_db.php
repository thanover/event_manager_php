<?php

function get_all_users(){
    global $db;
    $query =    'SELECT * FROM users
                ORDER BY userID';
    $statement = $db->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $users;
}

function delete_user($userID){
    global $db;
    $query =    'DELETE FROM users
                WHERE userID = :userID';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $userID);
    $success = $statement->execute();
    $statement->closeCursor();
}

function add_user($userFirstName, $userLastName, $userEmail){
    global $db;
    $query =    'INSERT INTO users (userFirstName,userLastName,userEmail)
                VALUES (:userFirstName, :userLastName, :userEmail)';
    $statement = $db->prepare($query);
    $statement->bindValue(':userFirstName', $userFirstName);
    $statement->bindValue(':userLastName', $userLastName);
    $statement->bindValue(':userEmail', $userEmail);
    $statement->execute();
    $statement->closeCursor();
}

function get_user_by_id($userID){
    global $db;
    $query =    'SELECT * FROM users
                WHERE userID = :userID';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $userID);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;

}
?>