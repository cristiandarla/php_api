<?php
    session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: ../index.php?error=forbidden');
    }else{
        include_once '../config/database.php';
        $database = new Database();
        $db_connection = $database->connect();
        if($db_connection){
            $query = "delete from users where id = :id";
            $stmt = $db_connection->prepare($query);
            $stmt->bindParam(":id", $_SESSION['id'] );
            $stmt->execute() ? include_once('logout.php') : header('Location: ../index.php?error=user') ;
        }else{
            header('Location: ../index.php?error=db');
        }
    }
?>