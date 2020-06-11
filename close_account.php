<!DOCTYPE html>
<html lang="en">
<?php include("partials/header.html"); ?>
<body class="login"> 
    <?php include("partials/navbar.php");
        if(!isset($_SESSION['loggedin'])){
            header('Location: index.php?error=user');
        }
    ?>
    <div class="container-fluid p-5 m-0">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card py-5 px-4 w-50 form-style">
                <h2 class="error text-center">BE CAUTIOUS!</h2>
                <h4 class="error text-center">The action of deleting the account is permanent!</h4>
                <div class="d-flex justify-content-center align-items-center pt-5">
                    <a href="controllers/delete_account.php" class="btn btn-danger btn-block btn-lg w-50" role="button">DELETE ACCOUNT</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>