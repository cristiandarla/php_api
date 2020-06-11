<?php
    if(isset($_GET['error'])){
        $error = $_GET['error'];
        switch ($error){
            case 'forbidden': echo "<h5 class='error text-center'>Access forbidden!</h5><hr>";
                        break;
            case 'db': echo "<h5 class='error text-center'>Database error! Please fill again the form below!</h5><hr>";
                        break;
            case 'empty': echo "<h5 class='error text-center'>Please fill the form below!</h5><hr>";
                        break;
            default: header('Location: error_page.php');
        }
    }
?>