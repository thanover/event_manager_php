<?php

function add_invite($eventID, $userID){
    global $db;
    $status = 'invited';
    $query =    'INSERT INTO invites (eventID, userID, status)
                VALUES (:eventID, :userID, :status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventID', $eventID);
    $statement->bindValue(':userID', $userID);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();
}

function get_invite_count_by_userID_and_status($userID, $status){
    global $db;
    $query =    'SELECT COUNT(*) as total
                FROM invites
                WHERE userID = :userID
                AND status = :status';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $userID);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $count = $statement->fetch();
    $statement->closeCursor();
    return $count;
}

function delete_all_invites_by_IDs($eventID, $userID){
    global $db;
    $query =    'DELETE FROM invites
                WHERE eventID = :eventID
                AND userID = :userID';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventID', $eventID);
    $statement->bindValue(':userID', $userID);
    $success = $statement->execute();
    $statement->closeCursor();
}

function delete_invites_by_eventID($eventID){
    global $db;
    $query =    'DELETE FROM invites
                WHERE eventID = :eventID';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventID', $eventID);
    $success = $statement->execute();
    $statement->closeCursor();
}

function delete_invites_by_userID($userID){
    global $db;
    $query =    'DELETE FROM invites
                WHERE userID = :userID';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $userID);
    $success = $statement->execute();
    $statement->closeCursor();
}

function get_invites_by_IDs_and_status($eventID, $userID, $status){
    global $db;
    $query =    'SELECT * FROM invites
                WHERE eventID = :eventID
                AND userID = :userID
                ORDER BY eventID';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventID', $eventID);
    $statement->bindValue(':userID', $userID);
    $statement->execute();
    $invites = $statement->fetchAll();
    $statement->closeCursor();
    return $invites;
}

function get_invites_by_userID_and_status($userID, $status){
    global $db;
    $query =    'SELECT * FROM invites
                WHERE userID = :userID
                AND status = :status
                ORDER BY eventID';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $userID);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $invites = $statement->fetchAll();
    $statement->closeCursor();
    return $invites;
}

function get_invites_by_eventID_and_status($eventID, $status){
    global $db;
    $query =    'SELECT * FROM invites
                WHERE eventID = :eventID
                AND status = :status
                ORDER BY eventID';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventID', $eventID);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $invites = $statement->fetchAll();
    $statement->closeCursor();
    return $invites;
}

function edit_invite_status_by_IDs($eventID, $userID, $status){
    global $db;
    $query =    'UPDATE invites 
                SET status = :status
                WHERE eventID = :event_id
                AND userID = :userID';
    $statement = $db->prepare($query);
    $statement->bindValue(':event_id', $eventID);
    $statement->bindValue(':userID', $userID);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();
}

function get_invites_by_eventID($eventID){
    global $db;
    $query =    'SELECT * FROM invites
                WHERE eventID = :eventID
                ORDER BY eventID';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventID', $eventID);
    $statement->execute();
    $invites = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $invites;
}

function get_invites_by_eventID_rtn_user($eventID){
    global $db;
    $query =    'SELECT userID
                FROM invites
                WHERE eventID = :eventID
                ORDER BY eventID'; 
    $statement = $db->prepare($query);
    $statement->bindValue(':eventID', $eventID);
    $statement->execute();
    $users = $statement->fetchAll();
    $statement->closeCursor();
    return $users;
}
?>