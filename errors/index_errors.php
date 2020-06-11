<?php
if(isset($_SESSION['loggedin'])){
    if(isset($_GET['error'])){
        $error = $_GET['error'];
        switch ($error){
            case 'user': echo "<h5 class='error text-center'>No such user registered! Please go first to <a class='here' href='../register.php'>registration page</a>!</h5><hr>";
                        break;
            case 'db': echo "<h5 class='error text-center'>Database error! Please fill again the form below!</h5><hr>";
                        break;
            case 'forbidden': echo "<h5 class='error text-center'>Access forbidden!</h5><hr>";
                        break;
            default: header('Location: error_page.php');
        }
    }else{
        echo '<h1 class="text-center">Hello, '.$_SESSION['name'].'!</h1>';
    }
}else{
    if(isset($_GET['error'])){
        $error = $_GET['error'];
        switch ($error){
            case 'user': echo "<h5 class='error text-center'>No such user registered! Please go first to <a class='here' href='../register.php'>registration page</a>!</h5><hr>";
                        break;
            case 'login': echo "<h5 class='error text-center'>You are not logged in! Please go first to <a class='here' href='../login.php'>login page</a>!</h5><hr>";
                        break;
            case 'db': echo "<h5 class='error text-center'>Database error! Please fill again the form below!</h5><hr>";
                        break;
            case 'forbidden': echo "<h5 class='error text-center'>Access forbidden!</h5><hr>";
                        break;
            default: header('Location: error_page.php');
        }
    }else{
        echo '<h1 class="text-center">Seems to work!</h1>';
    }
}
    
?>