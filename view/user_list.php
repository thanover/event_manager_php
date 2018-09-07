<?php include "view/header.php"; 
    $users = get_all_users();
?>
<div class="container">
    <br><br>
    <h5>Add A User:</h5>
    <form action='index.php' method='post' id='add_event_form' class="col s12">        
        <input type='hidden' name='action' value='add_user'>
        <div class="row">
            <div class="input-field col s8">
                <input name="userFirstName" id="userFirstName" type="text" class="validate">
                <label for="userFirstName">First Name</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s8">
                <input name="userLastName" id="userLastName" type="text" class="validate">
                <label for="userLastName">Last Name</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s8">
                <input name="userEmail" id="userEmail" type="email" class="validate">
                <label for="userEmail">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="col s10">
                <button type="submit" class="waves-effect waves-light btn green darken-1"><i class="material-icons left">add_circle</i>Add User</button>
            </div>               
        </div>
    </form>
    <br>
    <br>
    <div class='divider'></div>
</div>

<div class="container">
    <br>
    <br>
    <h5>All Users:</h5>
    <table class="highlight centered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['userID']; ?></td>
                    <td><?php echo $user['userFirstName']; ?></td>
                    <td><?php echo $user['userLastName']; ?></td>
                    <td><?php echo $user['userEmail']; ?></td>
                    <td>
                    <?php if($user['userID'] != 1){
                        echo 
                        '<form action="index.php" method="post">
                            <input type="hidden" name="action" value="delete_user">
                            <input type="hidden" name="user_id" value="'.$user['userID'].'">
                            <button type="submit" value="Delete" class="btn-small waves-effects waves-light red darken-3"><i class="material-icons left">delete_forever</i>Delete User</button>
                        </form>';
                    }
                    ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <br>
    <br>
</div>

<?php include "view/footer.php"; ?>