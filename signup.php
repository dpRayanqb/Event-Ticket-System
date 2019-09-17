<?php
    session_start();
    include 'config.php';
    if (isset($_SESSION['user'])) {header('Location: index.php'); }
    $title = "Sign up";
    include "navbar.php";
?>

        <div class="col-sm-12">
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 ">
                        <h1 class="text-center">Sign Up</h1>
                        <form action="check.php" method="post" >
                            <b>Name</b>
                            <input class="form-control" name="name" type="text" />
                            <b>Email</b>
                            <input class="form-control" name="email" type="email" />
                            <b>password</b>
                            <input class="form-control" name="password" type="password" />
                            <b>Type: </b>
                            <label><input type="radio" name="type" value="zero" /> User</label>
                            <label><input type="radio" name="type" value="1" /> Organizer</label>
                            <button class="btn btn-danger btn-block">Sign Up</button>
                        </form>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>