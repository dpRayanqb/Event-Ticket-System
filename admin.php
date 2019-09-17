<?php
    session_start();
    include 'config.php';
    if (!isset($_SESSION['admin'])) {header('Location: signin.php');}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="adminstyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <?php if($_GET['manage'] == 'home' || $_GET['manage'] == '' || !isset($_GET['manage'])){?>
                <div class="col-sm-12">
                <div class="row">
                <div class="col-sm-6">
					<div id="Events">
						<h1 class="text-center">Events</h1>
						<hr>
						<div class="container">
							<table class="table text-center">
								<thead>
									<tr>
										<td class="col-sm-4">Event</td>
										<td class="col-sm-3">Organizer</td>
										<td class="col-sm-1">Date</td>
										<td class="col-sm-3">Manage</td>
									</tr>
								</thead>
								<tbody>
									<?php
										$stmt = $con->prepare("SELECT * FROM events ORDER BY event_id DESC");
										$stmt->execute();
										$rows = $stmt->fetchAll();
										if (! empty($rows)) {
											foreach($rows as $row) {
												$stmt1 = $con->prepare("SELECT * FROM users WHERE user_id = ? LIMIT 1");
												$stmt1->execute(array($row['user_id']));
												$rows1 = $stmt1->fetchAll();
												if (! empty($rows1)) {
													foreach($rows1 as $row1) {
														$name = $row1['name'] ;
													}
												}
												echo '
													<tr>
														<td>'.$row['event_name'].'</td>
														<td>'.$name.'</td>
														<td>'.$row['time_date'].'</td>
														<td>';
												if($row['event_status'] == 0){
													echo '<a href="?manage=accept&&ID='.$row['event_id'].'&&type=event" class="btn btn-sm btn-block btn-success">Approve</a>';
												}else{
													echo '<a href="?manage=accept&&ID='.$row['event_id'].'&&type=Refuse" class="btn btn-sm btn-block btn-warning">Refuse</a>';
												}
														echo '
															<a href="?manage=delete&&ID='.$row['event_id'].'&&type=event" class="btn btn-sm btn-block btn-danger">Delete</a>
														</td>
													</tr>
												';
											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
                </div>
				<div class="col-sm-6">
					 <div id="Organizer">
                    <h1 class="text-center">Organizers</h1>
                    <hr>
                    <div class="container">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <td class="col-sm-1">#ID</td>
                                    <td class="col-sm-4">Name</td>
                                    <td class="col-sm-3">Email</td>
                                    <td class="col-sm-4">Control</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $stmt1 = $con->prepare("SELECT * FROM users WHERE status=1 ORDER BY user_id DESC");
                                    $stmt1->execute();
                                    $rows1 = $stmt1->fetchAll();
                                    if (! empty($rows1)) {
                                        foreach($rows1 as $row1) {
                                           echo '
                                               <tr>
                                                    <td>#'.$row1['user_id'].'</td>
                                                    <td>'.$row1['name'].'</td>
                                                    <td>'.$row1['email'].'</td>
                                                    <td>
                                                        <a href="?manage=delete&&ID='.$row1['user_id'].'&&type=organizer" class="btn btn-sm btn-danger btn-block">Delete</a>
                                                    </td>
                                                </tr>
                                           ';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
             	</div>
             	</div>
					<a href="signout.php" class="btn btn-block btn-primary">Sign out</a>
             	</div>
            <?php }else if($_GET['manage'] == 'accept'){
                if($_GET['type'] == 'event'){
                    $stmt = $con->prepare("UPDATE `events` SET `event_status` = 1 WHERE `event_id` = ? ");
                    $stmt->execute(array($_GET['ID']));
                    header("Location: admin.php");
                }else{
                    $stmt = $con->prepare("UPDATE `events` SET `event_status` = 0 WHERE `event_id` = ? ");
                    $stmt->execute(array($_GET['ID'])); 
                    header("Location: admin.php");
                }
            }else if($_GET['manage'] == 'delete'){
                if($_GET['type'] == 'event'){
                    $stmt = $con->prepare("DELETE FROM `events` WHERE `event_id` = ?");
                    $stmt->execute(array($_GET['ID']));
                    header("Location: admin.php");
                }else{
                    $stmt = $con->prepare("DELETE FROM `users` WHERE `user_id` = ?");
                    $stmt->execute(array($_GET['ID']));
                    header("Location: admin.php");
                }
            }?> 
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>