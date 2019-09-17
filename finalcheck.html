<link href="style.css" rel="stylesheet" type="text/css" />
<?php
    session_start();
    include 'config.php';
    if (isset($_SESSION['user'])){header('Location: index.php');}
    if($_POST['type'] == "zero"){$status=0;}else{$status=$_POST['type'];}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name  = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$type     = $_POST['type'];
        if(empty($name)||empty($email)||empty($password)||empty($type)){
            echo '<alert class="alert" >Sorry Data is empty</alert>';
        }else{
            $stmt = $con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
            $stmt->execute(array($email));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($count > 0) {
                header("Location: index.php");
            }else{
                $stmt = $con->prepare("INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `status`) VALUES (NULL, :name, :email, :password,:status) ");
                $stmt->execute(array(
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'status' => $type
                ));
                header("Location: index.php");
            }
        }
	}
?>