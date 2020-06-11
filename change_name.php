
<!DOCTYPE html>
<html lang="en">
<?php include("partials/header.html"); ?>
<body class="login">
    <?php include("partials/navbar.php");
        if(!isset($_SESSION['loggedin'])){
            header('Location: index.php');
        }
    ?>
    <div class="container-fluid p-5 m-0">
        <div class="d-flex justify-content-center align-items-center">
            <form class="card py-5 px-4 w-50 form-style" method="POST" action="controllers/change_name.php">
                <h2 class="text-center pb-4">CHANGE NAME</h2>
                <hr>
                <?php
                    include_once('errors/change_name_errors.php');
                ?>
                <div class="form-group">
                    <label for="name" class="label-form"><i class="fas fa-user"></i> New Name</label>
                    <input type="text" id="name" name="name" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="name" class="label-form"><i class="fas fa-user"></i> Repeat New Name</label>
                    <input type="text" id="rname" name="rname" class="form-control" required/>
                </div>
                <hr>
                <button class="btn btn-block btn-lg btn-success mt-4" type="submit" name="submit" onclick="return check('name');">Change Name!</button>
            </form>
        </div>
    </div>
</body>
</html>