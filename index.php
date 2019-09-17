<?php
    session_start();
    if(!isset($_SESSION['user'])){
        if(isset($_SESSION['admin'])){header("Location: admin.php");}
        else if(isset($_SESSION['organizer'])){header("Location: organizer.php");}
    }
    include 'config.php';
    $title = "Events System";
    include "navbar.php";
?>
        <img src="home.jpg" style="height:98vh" width="100%"/>
        <div class="col-sm-12">
            <div class="container text-center">
                <div class="row">
                    <?php
                    if(!isset($_SESSION['user'])){
                        echo '
                            <div style="margin-top:3%" class="col-sm-2">
                                <a class="btn btn-success btn-block" href="signin.php">Sign In</a>
                                <a class="btn btn-warning btn-block" href="signup.php">Sign Up</a>
                            </div>
                            <div class="col-sm-8">
                        '; 
                    }else{
                        echo '
                            <div style="margin-top:3%" class="col-sm-2">
                                <a style="margin:20px" class="btn btn-danger btn-block" href="signout.php">Sign Out</a>
                            </div>
                            <div class="col-sm-12">
                        ';
                    }
                    
                    ?>
                        
                        <div id="Events">
                        <div class="container">
							<?php
							if(isset($_SESSION['user'])){
							echo'
							<div class="col-sm-12">
								<form style="margin-bottom:12px;" action="index.php" method="post">
									<input class="form-control" name="search" />
									<select class="form-control" name="key">
										<option value="event_name">Name</option>
										<option value="event_type">Type</option>
									</select>
									<button type="submit" class="btn btn-success btn-block">Search</button>
								</form>';
							}
									if ($_SERVER['REQUEST_METHOD'] == 'POST') {
										$key = $_POST['key'];
										$search = $_POST['search'];
										$stmt = $con->prepare("SELECT * FROM events WHERE $key LIKE '%$search%' ORDER BY event_id DESC");
										$stmt->execute();
										$rows = $stmt->fetchAll();
										if (! empty($rows)) {
											foreach($rows as $row) {
												echo '
															<tr>
																<td><img src="images/'.$row['event_image'].'" width="100px"/></td>
																<td>'.$row['event_name'].'</td>
																<td>'.$row['event_type'].'</td>
																<td>'.$row['time_date'].'</td>
																<td><a href="join.php?ID='.$row['event_id'].'" class="btn btn-sm btn-primary">Join</a></td>
															</tr>
															<hr>
														';
											}
										}
									}
								
							echo '</div>';
							?>
							<h2 style="margin-top:2%;">Available Events</h2>
							<hr>
							<div class="col-sm-12">
								<table class="table">
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
											$stmt = $con->prepare("SELECT * FROM events ORDER BY event_id DESC");
											$stmt->execute();
											$rows = $stmt->fetchAll();
											if (! empty($rows)) {
												foreach($rows as $row) {
													$stmt1 = $con->prepare("SELECT * FROM reservation WHERE event_id=? AND user_id=?");
													$stmt1->execute(array($row['event_id'],$_SESSION['user']));
													$rows1 = $stmt1->fetchAll();
													if (empty($rows1)) {
														echo '
															<tr>
																<td><img src="images/'.$row['event_image'].'" width="100px"/></td>
																<td>'.$row['event_name'].'</td>
																<td>'.$row['event_type'].'</td>
																<td>'.$row['time_date'].'</td>
																<td><a href="join.php?ID='.$row['event_id'].'" class="btn btn-sm btn-primary">Join</a></td>
															</tr>
														';
													}
												}
											}
										?>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                    </div>
                    <?php
                    if(isset($_SESSION['user'])){
                    echo '
                        <div class="col-sm-12">
                            <h2 style="margin-top:2%;">Reserved Events</h2>
                            <div id="Events">
                            <div class="container">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Event </td>
                                            <td>Type</td>
                                            <td>Date</td>
                                            <td>Control</td>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                            $stmt = $con->prepare("SELECT * FROM events ORDER BY event_id DESC");
                                            $stmt->execute();
                                            $rows = $stmt->fetchAll();
                                            if (! empty($rows)) {
                                                foreach($rows as $row) {
                                                    $stmt1 = $con->prepare("SELECT * FROM reservation WHERE event_id=? AND user_id=?");
                                                    $stmt1->execute(array($row['event_id'],$_SESSION['user']));
                                                    $rows1 = $stmt1->fetchAll();
                                                    if (!empty($rows1)) {
                                                        echo '
                                                            <tr>
                                                                <td><img src="images/'.$row['event_image'].'" width="100px"/></td>
                                                                <td>'.$row['event_name'].'</td>
                                                                <td>'.$row['event_type'].'</td>
                                                                <td>'.$row['time_date'].'</td>
                                                                <td><a href="cancel.php?ID='.$row['event_id'].'" class="btn btn-sm btn-danger">Cancel</a></td>
                                                            </tr>';   
                                                    }
                                                }
                                            }
                                echo'
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div> 
                    ';
                    }
                    ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>