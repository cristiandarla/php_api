<?php
    if(isset($_POST['submit'])){
        include_once '../config/database.php';
        $database = new Database();
        $db_connection = $database->connect();
        if($db_connection){
            if(isset($_POST['email'])){
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $query_check = "select * from users where email = :email";
                    $stmt = $db_connection->prepare($query_check);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();
                
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    if(!empty($result)){
                        header('Location: ../change_password.php?email='.$email);
                    }else{
                        header('Location: ../recover_password.php?error=user');
                    }
                }else{
                    header('Location: ../recover_password.php?error=email');
                }
            }else{
                header('Location: ../recover_password.php?error=forbidden');
            }
        }else{
            header('Location: ../recover_password.php?error=db');
        }
    }else{
        header('Location: ../recover_password.php?error=forbidden');
    }
?>