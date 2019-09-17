<?php
    session_start();
    include 'config.php';
    if (!isset($_SESSION['organizer'])){header('Location: signin.php');}
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
				if($_GET['manage'] == 'home' || $_GET['manage'] == '' || !isset($_GET['manage'])){?>
					<div id="home">
						<div class="col-sm-12 text-center">
							<div class="container">
								<table style="margin-top:5%" class="table text-center">
									<thead>
										<tr>
											<td>#</td>
											<td>Event</td>
											<td>Type</td>
											<td>Date</td>
											<td>Control</td>
										</tr>
									</thead>
									<tbody>
										<?php
											$stmt = $con->prepare("SELECT * FROM events WHERE user_id=? ORDER BY event_id DESC");
											$stmt->execute(array($_SESSION['organizer']));
											$rows = $stmt->fetchAll();
											if (! empty($rows)) {
												foreach($rows as $row) {
													echo '
														<tr>
															<td><img src="images/'.$row['event_image'].'" width="100px" /></td>
															<td>'.$row['event_name'].'</td>
															<td>'.$row['event_type'].'</td>
															<td>'.$row['time_date'].'</td>
															<td>
																<a href="show.php?ID='.$row['event_id'].'" class="btn btn-sm btn-warning">Show</a>
																<a href="?manage=delete&&ID='.$row['event_id'].'" class="btn btn-sm btn-warning">Delete</a>';

													if($row['event_status']==1){
														echo ' <a href="?manage=stats&&ID='.$row['event_id'].'" class="btn btn-sm btn-warning">stats</a>';
													}
													echo'
															</td>
														</tr>
													';
												}
											}
										?>
									</tbody>
								</table>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-6">
											<a class="btn btn-primary btn-block" href="?manage=add">Add New Event</a>
										</div>
										<div class="col-sm-6">
											<a href="signout.php" class="btn btn-danger btn-block">Sign Out</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }else if($_GET['manage'] == 'add'){?>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<h1 class="text-center">Add Event</h1>
							<hr>
							<form action="insert.php" method="post" enctype="multipart/form-data">
								<label>Title</label>
								<input class="form-control" name="title" type="text"/><br/>
								<label>Image</label>
								<input name="img" type="file"/><br/><br/>
								<label>Type</label>
								<input class="form-control" name="type" type="text"/><br/>
								<label>Date Start</label>
								<input class="form-control" name="date" type="date"/><br/>
								<label>Tickets Number </label>
								<input class="form-control" name="tickets" type="number"/><br/>
								<button type="submit" class="btn btn-primary btn-block">Add Event</button>
							</form>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>

				<?php }else if($_GET['manage'] == 'stats'){
						if(isset($_GET['ID'])){
							$stmt1 = $con->prepare("SELECT * FROM `reservation` WHERE event_id=? ");
							$stmt1->execute(array($_GET['ID']));
							$rows1 = $stmt1->fetchAll();
							if (! empty($rows1)) {
								foreach($rows1 as $row1) {
									$stmt11 = $con->prepare("SELECT * FROM `users` WHERE user_id=?");
									$stmt11->execute(array($row1['user_id']));
									$rows11 = $stmt11->fetchAll();
									if (! empty($rows11)) {
										foreach($rows11 as $row11) {
											echo $row11['name']." - ".$row11['email'].'<br><hr><br>';
										}
									}else{echo 'No joins';}
								}
							}
						}
				}else if($_GET['manage'] == 'delete'){
					$stmt = $con->prepare("DELETE FROM `events` WHERE `event_id` = ?");
					$stmt->execute(array($_GET['ID']));
					header("Location: organizer.php");
				}
			?> 
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>