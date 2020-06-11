<!DOCTYPE html>
<html lang="en">
<?php include("partials/header.html"); ?>
<body class="register">
<?php include("partials/navbar.php"); ?>
    <div class="container-fluid p-5 m-0">
        <div class="d-flex justify-content-center align-items-center">
            <form class="card py-5 px-4 w-50 form-style" method="post" action="controllers/registration.php">
                <h1 class="text-center pb-4">REGISTRATION FORM</h1>
                <hr>
                <?php
                    include_once('errors/register_errors.php');
                ?>
                <div class="form-group">
                    <label for="name" class="label-form"><i class="fas fa-user"></i> Full Name</label>
                    <?php
                        if(isset($_GET['name'])){
                            $name_user = $_GET['name'];
                            echo '<input type="text" id="name" name="name" class="form-control" value="'.$name_user.'" required/>';
                        }else{
                            echo '<input type="text" id="name" name="name" class="form-control" required/>';
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label for="email" class="label-form"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" class="form-control"  required/>
                </div>
                <div class="form-group">
                    <label for="password" class="label-form"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="rpassword" class="label-form"><i class="fas fa-lock"></i> Repeat Password</label>
                    <input type="password" id="rpassword" name="rpassword" class="form-control" required/>
                </div>
                <input class="btn btn-block btn-lg btn-success mt-4" type="submit" name="submit" value="Register" onclick="return check('password');">
            </form>
        </div>
    </div>
</body>
</html>