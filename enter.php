<link href="style.css" rel="stylesheet" type="text/css" />
<?php
session_start();
include 'config.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name     = $_POST['name'];
		$password = $_POST['password'];
		$type  = $_POST['type'];
        
        if($_POST['type'] == "zero"){$status=0;}else{$status=$_POST['type'];}
        if(empty($name) || empty($password) || empty($type)){
            echo '<alert class="alert" >Sorry Data is empty</alert>';
        }else{
            $stmt = $con->prepare("SELECT * FROM users WHERE name='$name' AND password='$password' AND status='$type' ");
            $stmt->execute();
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($count > 0) {
                if($type == 0){
                    $_SESSION['user'] = $row['user_id'];
                    header('Location: index.php');
                }else if($type == 1){
                    $_SESSION['organizer'] = $row['user_id'];
                    header('Location: organizer.php');
                }else{
                    $_SESSION['admin'] = $row['user_id'];
                    header('Location: admin.php');
                }
            }else{
                echo '<alert class="alert" >No Users</alert>';
            }
        }
    }
?>