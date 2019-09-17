<?php
session_start();
include 'config.php';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$title = $_POST['title'];
		$type = $_POST['type'];
		$date = $_POST['date'];
		$tickets = $_POST['tickets'];
		if(empty($title) || empty($type)|| empty($date) || empty($tickets)){
			echo '<b>Empty Data.</b>
			<a href="?manage=" class="btn btn-primary">Back</a>
			';
		}else{
			if(!empty($_FILES['img']['name'])){
				$Name = $_FILES['img']['name']; 
				$Temp  = $_FILES['img']['tmp_name']; 
				$img = rand(0,10).'-'. $Name;
				move_uploaded_file($Temp,"images\\".$img);
			}
			$stmt = $con->prepare("INSERT INTO `events` (`event_id`, `event_name`, `event_type`, `event_image`, `time_date`, `tickets_number`, `user_id`, `event_status`) VALUES (NULL, :event_name, :event_type, :event_image, :date, :tickets_number, :user_id, '0') ");
			$stmt->execute(array(
				'event_name' => $title,
				'event_type' => $type,
				'event_image' => $img,
				'date' => $date,
				'tickets_number' => $tickets,
				'user_id' => $_SESSION['organizer']
			));
			header("Location: organizer.php ");
		}
	}
?>