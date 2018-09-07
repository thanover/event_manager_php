<?php include "view/header.php"; ?>
<?php $users = get_all_users(); ?>
<div class="container">
    <div class="row">
        <form action='index.php' method='post' id='select_user_form' class='col s12'>
        <input type='hidden' name='action' value='set_user'> 
            <div class="input-field col s12">
                <select name="userID">
                    <option value="" disabled selected>Select a User:</option>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?php echo $user['userID']; ?>"><?php echo $user['userID'].": ".$user['userLastName'].", ".$user['userFirstName']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row">
                <div class="col s10">
                <button type="submit" class="waves-effect waves-light btn green darken-1"><i class="material-icons left">forward</i>Sign In</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "view/footer.php"; ?>