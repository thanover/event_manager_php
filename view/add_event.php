<?php include 'view/header.php'; 
    $users = get_all_users();
?>
<div class="container">
    <h4>Add An Event:</h4>
    <form action='index.php' method='post' id='add_event_form' class="col s12">        
    <input type='hidden' name='action' value='add_event'>
            
            <div class="row">
                <div class="input-field col s2">
                    <input name="eventDate" id="eventDate" type="text" class="datepicker">
                    <label for="eventDate">Event Date</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8">
                    <input name="eventTitle" id="eventTitle" type="text" class="validate">
                    <label for="eventTitle">Event Title</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8">
                    <textarea name="eventDesc" id="eventDesc" class="materialize-textarea">Enter a description for your event. Be sure to include relevant details, such as the location.</textarea>
                    <label for="eventDesc">Event Description</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select multiple name="invitees[]">
                    <?php 
                    foreach ($users as $user):
                        if($user['userID'] > 1){                
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
                    <button type="submit" class="waves-effect waves-light btn green darken-1"><i class="material-icons left">note_add</i>Add Event</button>                                
                    <a href="./" class="btn waves-effects waves-light blue darken-3">Cancel</a> 
                </div>               
            </div>
    </form>
</div>
<?php include 'view/footer.php'; ?>