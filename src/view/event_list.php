<?php 
include('header.php');
if($_SESSION['user'] == 1){
    include('admin_event_list.php');
} else {
    include('user_event_list.php');
}include('footer.php'); 
?>
