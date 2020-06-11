<?php
    session_start();
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php?error=login');
    }else{
        if(!isset($_POST['email']) || !isset($_POST['remail'])){
            header('Location: ../change_email.php?error=forbidden');
        }else{
            if(empty($_POST['email']) || empty($_POST['remail'])){
                header('Location: ../change_email.php?error=empty');
            }else{
                include_once '../config/database.php';
                $database = new Database();
                $db_connection = $database->connect();
                if($db_connection){
                    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $query = 'update users set email = :email where id = :id';
                        
                        $stmt = $db_connection->prepare($query);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':id', $_SESSION['id']);
                        $stmt->execute() ? header('Location: ../user.php') : header('Location: ../index.php?error=login');
                    }else{
                        header('Location: ../change_email.php?error=email');
                    }
                }else{
                    header('Location: ../change_email.php?error=db');
                }
            }
        }
    }
?>