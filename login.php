
<!DOCTYPE html>
<html lang="en">
<?php include("partials/header.html"); ?>
<body class="login">
    <?php include("partials/navbar.php");
        if(isset($_SESSION['loggedin'])){
            header('Location: index.php');
        }
    ?>
    <div class="container-fluid p-5 m-0">
        <div class="d-flex justify-content-center align-items-center">
            <form class="card py-5 px-4 w-50 form-style" method="POST" action="controllers/authenticate.php">
                <h2 class="text-center pb-4">LOGIN FORM</h2>
                <hr>
                <?php
                    include_once('errors/login_errors.php');
                ?>
                <div class="form-group">
                    <label for="email" class="label-form"><i class="fas fa-envelope"></i> Email</label>
                    <?php
                        if(isset($_GET['email']) && $_GET['error'] === 'pass'){
                            $email = $_GET['email'];
                            echo '<input type="text" id="name" name="name" class="form-control" value="'.$email.'" required/>';
                        }else{
                            echo '<input type="email" id="email" name="email" class="form-control" required/>';
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label for="password" class="label-form"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" class="form-control" required/>
                </div>
                <hr>
                <h4 class="text-center">Forgot password? Click <a href='recover_password.php' class="link">here</a>!</h4>
                <hr>
                <button class="btn btn-block btn-lg btn-success mt-4" type="submit" name="submit">LOGIN!</button>
            </form>
        </div>
    </div>
</body>
</html>