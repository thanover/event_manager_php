<?php include "view/header.php"; ?>
<?php
    
    $event = get_event_by_eventID($eventID);
    $eventDate = DateTime::createFromFormat('Y-m-d', $event['eventDate']);
    $displayDate = $eventDate->format('M d, Y');
    $users = get_all_users();
    
?>
    <div class="container">
        <br>
    <a href="./" class="btn waves-effects waves-light blue darken-3"><i class="material-icons left">arrow_back</i>Go Back</a>
    <h4>Event Status:</h4>
        <div class="row">
            <div class="col s4">
                <ul class="collection with-header">
                    <li class="collection-header"><h5>Invites Pending</h5></li>
                    <?php 
                        $invited_invites = get_invites_by_eventID_and_status($eventID, 'invited');
                        foreach ($invited_invites as $invite){
                            $user = get_user_by_id($invite['userID']);
                            echo '<li class="collection-item">'.'
                            <a class="red-text text-darken-3" href="./?action=remove_invite&userID='.$user['userID'].'&eventID='.$eventID.'">
                            <i class="material-icons right">highlight_off</i></a>
                            '.$user['userFirstName'].' '.$user['userLastName']
                            .'</li>';
                        }
                    ?>
                </ul>
            </div>

            <div class="col s4">
                <ul class="collection with-header">
                    <li class="collection-header"><h5>Accepted</h5></li>
                    <?php 
                        $invited_invites = get_invites_by_eventID_and_status($eventID, 'accepted');
                        foreach ($invited_invites as $invite){
                            $user = get_user_by_id($invite['userID']);
                            echo '<li class="collection-item">'.'
                            <a class="red-text text-darken-3" href="./?action=remove_invite&userID='.$user['userID'].'&eventID='.$eventID.'">
                            <i class="material-icons right">highlight_off</i></a>
                            '.$user['userFirstName'].' '.$user['userLastName']
                            .'</li>';
                        }
                    ?>
                </ul>
            </div>

            <div class="col s4">
                <ul class="collection with-header">
                    <li class="collection-header"><h5>Declined</h5></li>
                    <?php 
                        $invited_invites = get_invites_by_eventID_and_status($eventID, 'declined');
                        foreach ($invited_invites as $invite){
                            $user = get_user_by_id($invite['userID']);
                            echo '<li class="collection-item">'.'
                            <a class="red-text text-darken-3" href="./?action=remove_invite&userID='.$user['userID'].'&eventID='.$eventID.'">
                            <i class="material-icons right">highlight_off</i></a>
                            '.$user['userFirstName'].' '.$user['userLastName']
                            .'</li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="divider"></div>
    </div>
    



    <div class="container">
        <h4>Send Additional Invites:</h4>
        <form action='index.php' method='post' id='edit_event_form' class="col s12">
            <input type='hidden' name='action' value='add_invitees'>
            <input type='hidden' name='eventID' value='<?php echo $eventID ?>'>
            <?php
                    $invited_users = get_invites_by_eventID_rtn_user($eventID);
                    $temp_array = array();
                    foreach($invited_users as $user):
                        array_push($temp_array, $user[0]);
                    endforeach;
                    $invitees = $temp_array;
                    ?>
            <div class="row">
                <div class="input-field col s12">
                    <select multiple name="invitees[]">
                    <?php
                    foreach ($users as $user):
                        if($user['userID'] > 1 && !in_array($user['userID'], $invitees, true)){
                            echo '<option value="'.$user["userID"].'">'.$user["userFirstName"]." ".$user["userLastName"].'</option>'; 

                        }
                    endforeach; 
                    
                    ?>
                    </select>
                    <label>Select Invitees</label>
                </div>
            </div>
            <div class="row">
                <div class="col s10">
                    <button type="submit" class="waves-effect waves-light btn green darken-1">
                        <i class="material-icons left">send</i>Send Invites</button>

                </div>
            </div>
        </form>
        <div class="divider"></div>
    </div>

    <div class="container">
        <h4>Edit Event Info:</h4>
        <form action='index.php' method='post' id='edit_event_form' class="col s12">
            <input type='hidden' name='action' value='edit_event'>
            <input type='hidden' name='eventID' value='<?php echo $event['eventID']; ?>'>

            <div class="row">
                <div class="input-field col s2">
                    <input name="eventDate" id="eventDate" type="text" class="datepicker" value="<?php echo $displayDate; ?>">
                    <label for="eventDate">Event Date</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8">
                    <input name="eventTitle" id="eventTitle" type="text" class="validate" value="<?php echo $event['eventTitle']; ?>">
                    <label for="eventTitle">Event Title</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8">
                    <textarea name="eventDesc" id="eventDesc" class="materialize-textarea"><?php echo $event["eventDesc"]; ?></textarea>
                    <label for="eventDesc">Event Description</label>
                </div>
            </div>
            <div class="row">
                <div class="col s10">
                    <button type="submit" class="waves-effect waves-light btn yellow darken-3">
                        <i class="material-icons left">create</i>Update Event</button>

                    
                </div>
            </div>
        </form>
        <br>
        <div class="divider"></div>
    </div>

    <div class="container">
        <div class="row">

            <h4>Delete Event:</h4>
            <p class="red-text text-darken-2">Warning: This will permanently delete the event!</p>
            <a href="./?action=delete_event&eventID=<?php echo $event['eventID'];?>" class="btn waves-effects waves-light red darken-3">
                <i class="material-icons left">delete_forever</i>Delete Event</a>
        </div>
        <br>
    </div>

    <?php include "view/footer.php"; ?>