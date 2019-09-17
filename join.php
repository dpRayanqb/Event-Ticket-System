<?php
    session_start();
    include 'config.php';
    date_default_timezone_set("Asia/Riyadh");       
    if(!isset($_SESSION['user'])){header("Location: signin.php");}

    $stmt = $con->prepare("INSERT INTO `reservation` (`reservarion_id`, `event_id`, `user_id`, `reservation_date`) VALUES (NULL, :event_id, :user_id, :date)");
    $stmt->execute(array(
        'event_id' => $_GET['ID'],
        'user_id' => $_SESSION['user'],
        'date' => date("Y-m-d")
    ));
    $stmt2 = $con->prepare("UPDATE `events` SET `tickets_number` = tickets_number-1 WHERE `events`.`event_id` = ?");
    $stmt2->execute(array($_GET['ID']));


	$pdf = fopen("pdfs/join.pdf", "w") or die("Unable to open file!");
	fwrite($pdf, $_GET['ID']);
	fwrite($pdf, $_SESSION['user']);
	fclose($pdf);

    header("Location: index.php");
?>