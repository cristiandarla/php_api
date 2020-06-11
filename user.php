
<!DOCTYPE html>
<html lang="en">
<?php include("partials/header.html"); ?>
<body>
    <?php 
        include("partials/navbar.php");
        if(!isset($_SESSION['loggedin'])){
            header('Location: index.php');
        }else{
            $data = include('controllers/user_page.php');
        }
    ?>
    <div class="container-fluid p-5 m-0">
        <div class="row">
            <div class="col-6 col-md-12 col-lg-6">
                <div class="row">
                    <div class="col-6">
                        <h4>NAME: <?=$data['name']?></h4>
                    </div>
                    <div class="col-6">
                        <a href="change_name.php" class="btn btn-block btn-lg btn-primary" role="button"><i class="fas fa-user"></i> Change name</a>
                    </div>
                </div>
                <hr>
                <div class="row pb-4">
                    <div class="col-6">
                        <h4>EMAIL: <?=$data['email']?></h4>
                    </div>
                    <div class="col-6">
                        <a href="change_email.php" class="btn btn-block btn-lg btn-primary" role="button"><i class="fas fa-envelope"></i> Change email</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-12 col-lg-6">
                <div class="row">
                    <div class="col-6">
                        <h4>PASSWORD</h4>
                    </div>
                    <div class="col-6">
                        <a href="controllers/change_password.php" class="btn btn-block btn-lg btn-primary" role="button"><i class="fas fa-lock"></i> Change password</a>
                    </div>
                </div>
                <hr>
                <div class="row pb-4">
                    <div class="col-6">
                        <h4>CLOSE ACCOUNT</h4>
                    </div>
                    <div class="col-6">
                        <a href="close_account.php" class="btn btn-block btn-lg btn-danger" role="button"><i class="fas fa-user-slash"></i> Close Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>