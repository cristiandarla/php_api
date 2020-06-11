
<!DOCTYPE html>
<html lang="en">
<?php include("partials/header.html"); ?>
<body class="login">
    <?php include("partials/navbar.php");
        if(isset($_SESSION['loggedin'])){
            $action = "controllers/change_password.php";
        }else{
            $action = "controllers/change_password.php?email=".$_GET['email'];
        }
    ?>
    <div class="container-fluid p-5 m-0">
        <div class="d-flex justify-content-center align-items-center">
            <form class="card py-5 px-4 w-50 form-style" method="POST" action=<?=$action?>>
                <h2 class="text-center pb-4">CHANGE PASSWORD</h2>
                <hr>
                <div class="form-group">
                    <label for="password" class="label-form"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="rpassword" class="label-form"><i class="fas fa-lock"></i> Repeat Password</label>
                    <input type="password" id="rpassword" name="rpassword" class="form-control" required/>
                </div>
                <hr>
                <button class="btn btn-block btn-lg btn-success mt-4" type="submit" name="submit"  onclick="return check('password');">Change Password!</button>
            </form>
        </div>
    </div>
</body>
</html>