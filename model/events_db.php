<?php

function get_all_events(){
    global $db;
    $query =    'SELECT * FROM events
                ORDER BY eventDate';
    $statement = $db->prepare($query);
    $statement->execute();
    $events = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $events;
}

function add_event($eventDate, $eventTitle, $eventDesc){
    global $db;
    $query =    'INSERT INTO EVENTS (eventDate,eventTitle,eventDesc)
                VALUES (:event_date, :event_title, :event_desc)';
    $statement = $db->prepare($query);
    $statement->bindValue(':event_date', $eventDate);
    $statement->bindValue(':event_title', $eventTitle);
    $statement->bindValue(':event_desc', $eventDesc);
    $statement->execute();
    $statement->closeCursor();
    return get_event_by_eventTitle($eventTitle);
}

function get_event_registrations_by_userid($userID){
    global $db;
    $query =    'SELECT * 
                FROM events
                    INNER JOIN registrations
                    ON events.eventID = registrations.eventID
                WHERE userID = :userid
                ORDER BY events.eventID';
    $statement = $db->prepare($query);
    $statement->bindValue(':userid', $userID);
    $statement->execute();
    $events = $statement->fetchAll();
    $statement->closeCursor();
    return $events;
}

function get_event_by_eventID($eventID){
    global $db;
    $query =    'SELECT * FROM events
                WHERE eventID = :eventID';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventID', $eventID);
    $statement->execute();
    $event = $statement->fetch();
    $statement->closeCursor();
    return $event;
}

function get_event_by_eventTitle($eventTitle){
    global $db;
    $query =    'SELECT * FROM events
                WHERE eventTitle = :eventTitle';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventTitle', $eventTitle);
    $statement->execute();
    $event = $statement->fetch();
    $statement->closeCursor();
    return $event;
}

function update_event($eventID, $eventDate, $eventTitle, $eventDesc){
    global $db;
    $query =    'UPDATE events
                SET eventDate = :event_date, eventTitle = :event_title, eventDesc = :event_desc
                WHERE eventID = :event_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':event_id', $eventID);
    $statement->bindValue(':event_date', $eventDate);
    $statement->bindValue(':event_title', $eventTitle);
    $statement->bindValue(':event_desc', $eventDesc);
    $statement->execute();
    $statement->closeCursor();
}

function delete_event_by_eventID($eventID){
    global $db;
    $query =    'DELETE FROM events
                WHERE eventID = :eventID';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventID', $eventID);
    $success = $statement->execute();
    $statement->closeCursor();
}

function get_event_count_by_userID($userID){
    global $db;
    $query =    'SELECT COUNT(*) as total
                FROM events
                WHERE userID = :userID';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $userID);
    $statement->execute();
    $count = $statement->fetch();
    $statement->closeCursor();
    return $count;
}
?>