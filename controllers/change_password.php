<?php
    session_start();
    if(isset($_POST['submit'])){
        if(!isset($_POST['password']) || !isset($_POST['rpassword'])){
            header('Location: ../change_password.php?error=forbidden');
        }else{
            if(empty($_POST['password']) || empty($_POST['rpassword'])){
                header('Location: ../change_password.php?error=empty');
            }else{
                include_once '../config/database.php';
                $database = new Database();
                $db_connection = $database->connect();
                if($db_connection){
                    $pass = password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost" => rand(5, 20)]);
                    if(isset($_SESSION['loggedin'])) {
                        $query = 'update users set password = :pass where id = :id';
                        
                        $stmt = $db_connection->prepare($query);
                        $stmt->bindParam(':pass', $pass);
                        $stmt->bindParam(':id', $_SESSION['id']);
                        $stmt->execute();
                        header('Location: logout.php');
                    }else{
                        if(isset($_GET['email'])){
                            if(!empty($_GET['email'])){
                                $email = filter_var($_GET["email"], FILTER_SANITIZE_EMAIL);
                                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                                    $query = 'update users set password = :pass where email = :email';
                                    
                                    $stmt = $db_connection->prepare($query);
                                    $stmt->bindParam(':pass', $pass);
                                    $stmt->bindParam(':email', $email);
                                    $stmt->execute() ? header('Location: ../login.php') : header('Location: ../recover_password.php?error=user') ;
                                }else{
                                    header('Location: ../recover_password.php?error=email'); //not gonna get here
                                }
                            }else{
                                header('Location: ../recover_password.php?error=empty');    //not gonna get here
                            }
                        }else{
                            header('Location: ../change_password.php?error=forbidden');     //not gonna get here
                        }
                    }
                    pg_close($db_connection);
                }else{
                    header('Location: ../change_password.php?error=db');
                }
            }
        }
    }else{
        if(isset($_SESSION['loggedin'])) {
            header('Location: ../change_password.php');
        }else{
            header('Location: ../index.php?error=forbidden');
        }
    }
    
?>