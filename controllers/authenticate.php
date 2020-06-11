<?php
    session_start();
    if( isset( $_POST['submit'] ) ){
        include_once '../config/database.php';
        $database = new Database();
        $db_connection = $database->connect();
        if($db_connection){
            if(isset($_POST["email"], $_POST["password"])){
                if(empty($_POST['email']) || empty($_POST["password"])){
                    header('Location: ../login.php?error=empty');
                }else{
                    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $query_check = "select * from users where email = :email";
                        $stmt = $db_connection->prepare($query_check);
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();
                    
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        if(empty($result)){
                            header('Location: ../login.php?error=user');
                        }else{
                            if(password_verify($_POST['password'], $result['password'])){
                                session_regenerate_id();
                                $_SESSION['loggedin'] = TRUE;
                                $_SESSION['name'] = $result['name'];
                                $_SESSION['id'] = $result['id'];
                                header('Location: ../index.php');
                            }else{
                                header('Location: ../login.php?error=pass&email='.$email);
                            }
                        }
                    }else{
                        header('Location: ../login.php?error=email');
                    }               
                }
            }else{
                header('Location: ../login.php?error=forbidden');
            }
        }else{
            header('Location: ../login.php?error=db');
        }
    }else{
        header('Location: ../login.php?error=forbidden');
    }
?>