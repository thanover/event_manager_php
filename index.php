<?php
require('model/database.php');
require('model/events_db.php');
require('model/users_db.php');
require('model/invites_db.php');

//create a session that stores the current user
session_start();
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = 0;
}

//grab the action. if the action isn't set, set it to 'list_events'
$action = filter_input(INPUT_POST, 'action');
if ($action ==  NULL || $action == false){ 
    $action = filter_input(INPUT_GET, 'action');
    if($action ==  NULL || $action == false){
        $action = 'list_events';
    }
}

//checks if the userID isn't stored in 'user' element in the global $_SESSION variable, and redirects to get the user if not
if ($_SESSION['user'] == 0 && $action != 'set_user'){
    $action = 'get_user';
}

//store the user in this variable according
$currentUser = get_user_by_id($_SESSION['user']);

//list of actions
if($action == 'list_events'){
    include('view/event_list.php');
} else if ($action == 'get_user'){    
    include('view/get_user.php');
} else if ($action == 'set_user'){    
    $userID = filter_input(INPUT_POST, 'userID');
    $_SESSION['user'] = $userID;
    header("Location: index.php");
} else if ($action == 'reset_user'){
    $_SESSION['user'] = 0;
    header("Location: index.php");
} else if ($action == 'show_add_event_form'){    
    include('view/add_event.php');
}  else if ($action == 'add_event'){
    $date = DateTime::createFromFormat('M d, Y', filter_input(INPUT_POST, 'eventDate'));
    $eventDate = $date->format('Y-m-d');
    $eventTitle = filter_input(INPUT_POST, 'eventTitle');
    $eventDesc = filter_input(INPUT_POST, 'eventDesc');
    $invitees = $_POST['invitees'];
    if($eventDate == NULL || $eventDate == FALSE || $eventTitle == NULL || $eventTitle == FALSE || $eventDesc == NULL || $eventDesc == FALSE){
        $error = "Invalid event data. Check all fields and try again.";
        echo $error;
    } else {
        $event = add_event($eventDate, $eventTitle, $eventDesc);
    }
    foreach ($invitees as $invitee):
        add_invite($event['eventID'], $invitee);
    endforeach;
    header("Location: index.php");
} else if ($action == 'show_users'){    
    include('view/user_list.php');
} else if ($action == 'delete_user'){
    $userID = filter_input(INPUT_POST, 'user_id');
    delete_user($userID);
    delete_invites_by_userID($userID);
    include('view/user_list.php');
} else if ($action == 'add_user'){
    $userFirstName = filter_input(INPUT_POST, 'userFirstName');
    $userLastName = filter_input(INPUT_POST, 'userLastName');
    $userEmail = filter_input(INPUT_POST, 'userEmail');
    if($userFirstName == NULL || $userFirstName == FALSE || $userLastName == NULL || $userLastName == FALSE || $userEmail == NULL || $userEmail == FALSE){
        $error = "Invalid event data. Check all fields and try again.";
        echo $error;
    } else {
        add_user($userFirstName, $userLastName, $userEmail);
    }
    include('view/user_list.php');
} else if ($action == 'show_edit_event_form'){
    $eventID = filter_input(INPUT_GET, 'eventID');
    include('view/edit_event.php');
} else if ($action == 'edit_event'){
    $date = DateTime::createFromFormat('M d, Y', filter_input(INPUT_POST, 'eventDate'));
    $eventDate = $date->format('Y-m-d');
    $eventTitle = filter_input(INPUT_POST, 'eventTitle');
    $eventDesc = filter_input(INPUT_POST, 'eventDesc');
    $eventID = filter_input(INPUT_POST, 'eventID');
    if($eventDate == NULL || $eventDate == FALSE || $eventTitle == NULL || $eventTitle == FALSE || $eventDesc == NULL || $eventDesc == FALSE){
        $error = "Invalid event data. Check all fields and try again.";
        echo $error;
    } else {
        update_event($eventID, $eventDate, $eventTitle, $eventDesc);
    }
    header("Location: index.php");
} else if ($action == 'delete_event'){
    $eventID = filter_input(INPUT_GET, 'eventID');
    echo "event id: ".$eventID;
    delete_event_by_eventID($eventID);
    delete_invites_by_eventID($eventID);
    header("Location: index.php");
} else if ($action == 'list_invites') {
    include('view/event_list.php');
} else if ($action == 'accept_invite'){
    $eventID = filter_input(INPUT_GET, 'eventID');
    $userID = filter_input(INPUT_GET, 'userID');
    edit_invite_status_by_IDs($eventID, $userID, 'accepted');
    include('view/event_list.php');
} else if ($action == 'decline_invite'){
    $eventID = filter_input(INPUT_GET, 'eventID');
    $userID = filter_input(INPUT_GET, 'userID');
    edit_invite_status_by_IDs($eventID, $userID, 'declined');
    include('view/event_list.php');
} else if ($action == 'add_invitees'){
    $eventID = $_POST['eventID'];
    $invitees = $_POST['invitees'];
    foreach ($invitees as $invitee):
        add_invite($eventID, $invitee);
    endforeach;
    include('view/edit_event.php');
} else if ($action == 'remove_invite') {
    $eventID = filter_input(INPUT_GET, 'eventID');
    $userID = filter_input(INPUT_GET, 'userID');
    delete_all_invites_by_IDs($eventID, $userID);
    include('view/edit_event.php');
}
?>