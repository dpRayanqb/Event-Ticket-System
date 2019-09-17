<?php
    session_start();
    include 'config.php';
    if (!isset($_SESSION['organizer'])) {header('Location: signin.php');}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Organizer</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="organizerstyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
			<?php
			if(isset($_GET['ID'])){
				$stmt1 = $con->prepare("SELECT * FROM events WHERE event_id=? LIMIT 1");
				$stmt1->execute(array($_GET['ID']));
				$rows1 = $stmt1->fetchAll();
				if (! empty($rows1)) {
					foreach($rows1 as $row1) {
						echo '
							<div style="margin-top:7%" class="col-sm-12" >
								<div class="row" >
									<div class="col-sm-6">
										<img width="300px" src="images/'.$row1['event_image'].'" />
									</div>
									<div class="col-sm-6">
										<div>
										   <b>Title: </b>'.$row1['event_name'].'  
										   <b>Type: </b>'.$row1['event_type'].'<br>  
										   <b>Time: </b>'.$row1['time_date'].' 
										   <b>Tickets: </b>'.$row1['tickets_number'].'  
										   <hr>
										</div>
									</div>
								</div>
							</div>
							<a href="organizer.php" class="btn btn-danger btn-sm" >Back</a>
						';
					}
				}
			}
		?>
		</div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>