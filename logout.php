<?php
    session_start();
    session_destroy();
    include 'index.php';
    header('location: index.php?status=loggedout');
    if(!$_SESSION['userName']){
    $loginMessage = 'You Have Been Logged Out.';
    exit();
}
?>