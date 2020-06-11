
<!DOCTYPE html>
<html lang="en">
<?php include("partials/header.html"); ?>
<body class="login">
    <?php include("partials/navbar.php");?>
    <div class="container-fluid p-5 m-0">
        <div class="d-flex justify-content-center align-items-center">
            <form class="card py-5 px-4 w-50 form-style" method="POST" action="controllers/recover_password.php">
                <h2 class="text-center pb-4">RECOVER PASSWORD</h2>
                <hr>
                <?php
                    include_once('errors/recover_password_errors.php');
                ?>
                <h4 class="text-center pb-2">Write down the email so we can send a link to recover your password.</h4>
                <hr>
                <div class="form-group">
                    <label for="email" class="label-form"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" class="form-control" required/>
                </div>
                <hr>
                <button class="btn btn-block btn-lg btn-success mt-4" type="submit" name="submit">Send Email!</button>
            </form>
        </div>
    </div>
</body>
</html>