<?php
    session_start();
    include 'config.php';
    if (isset($_SESSION['id'])){header('Location: index.php');}
    $title = "Sign in";
    include "navbar.php";
?>
<style>

    h1{
        font-weight: bold;
        color: #007bff;
    }

</style>
        <div class="col-sm-12">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <h1 class="text-center">Log In</h1>
                        <hr />
                        <form action="enter.php" method="post">
                            <div class="col-sm-12 row">
                                <div class="col-sm-6">
                                    <b>name</b>
                                    <input class="form-control" name="name" />
                                </div>
                                <div class="col-sm-6">
                                    <b>Password</b>
                                    <input class="form-control" type="password" name="password"/>
                                </div>
                            </div>
                            <b>Type </b>
                            <label><input type="radio" value="2" name="type" checked /> Admin.</label>
                            <label><input type="radio" value="1" name="type"/> Organizer.</label>
                            <label><input type="radio" value="zero" name="type"/> User.</label>
                            <button type="submit" class="btn btn-primary btn-block">Log In </button>
                        </form>
                    </div>
                    <div class="col-sm-2">
                        <a href="index.php" class="btn btn-danger btn-block">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>