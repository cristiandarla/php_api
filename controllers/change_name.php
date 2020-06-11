<?php
    session_start();
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php?error=login');
    }else{
        if(!isset($_POST['name']) || !isset($_POST['rname'])){
            header('Location: ../change_name.php?error=forbidden');
        }else{
            if(empty($_POST['name']) || empty($_POST['rname'])){
                header('Location: ../change_name.php?error=empty');
            }else{
                include_once '../config/database.php';
                $database = new Database();
                $db_connection = $database->connect();
                if($db_connection){
                    $name = $_POST['name'];
                    $query = 'update users set name = :name where id = :id';
                        
                    $stmt = $db_connection->prepare($query);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':id', $_SESSION['id']);
                    if($stmt->execute()){
                        $_SESSION['name'] =  $name;
                        header('Location: ../index.php');
                    }else{
                        header('Location: ../index.php?error=login');
                    }
                }else{
                    header('Location: ../change_name.php?error=db');
                }
            }
        }
    }
?> 