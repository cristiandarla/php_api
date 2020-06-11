<?php
    if(isset($_GET['error'])){
        $error = $_GET['error'];
        switch ($error){
            case 'email': echo "<h5 class='error text-center'>The email does not respect email's format:</h5><h5 class='error text-center'>(user)@(domain).(com)</h5><hr>";
                        break;
            case 'user': echo "<h5 class='error text-center'>The email is already used! Click <a class='here' href='../login.php'>here</a> to login!</h5><hr>";
                        break;
            case 'forbidden': echo "<h5 class='error text-center'>Access forbidden!</h5><hr>";
                        break;
            case 'db': echo "<h5 class='error text-center'>Database error! Please fill again the form below!</h5><hr>";
                        break;
            case 'empty': echo "<h5 class='error text-center'>Please fill the whole form below!</h5><hr>";
                        break;
            default: header('Location: error_page.php');
        }
    }
?>