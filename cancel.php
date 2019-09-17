<?php
    session_start();
    include 'config.php';
    if(!isset($_SESSION['user'])){header("Location: signin.php");}

    $stmt = $con->prepare("DELETE FROM `reservation` WHERE `event_id` =? AND `user_id` = ?");
    $stmt->execute(array($_GET['ID'],$_SESSION['user']));
    header("Location: index.php");
?>