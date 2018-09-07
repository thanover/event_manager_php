<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>Event Manager</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
    <nav class="blue darken-1" role="navigation">
        <div class="nav-wrapper container">
            <a href="./" class="brand-logo center"><i class="material-icons large">event</i>Events Manager</a>

            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <?php if($_SESSION['user'] > 1){
                    include('user_menu.php');
                }
                ?>
                <?php if($_SESSION['user'] == 1){
                    include('admin_menu.php');
                }
                ?>
            </ul>
            <div class="row">
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><i class="material-icons user_icon">person_pin</i></li>
                    <li>Welcome, <?php echo $currentUser['userFirstName']; ?></li>
                    
                    <li><a href=".?action=reset_user">Sign Out</a></li>
                </ul>
            </div> 
        </div>
    </nav>