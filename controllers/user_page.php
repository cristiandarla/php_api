<?php    
    if(!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php?error=login');
    }else{
        include_once 'config/database.php';
        $database = new Database();
        $db_connection = $database->connect();
        if($db_connection){
            $query_check = "select * from users where id = :id";
            $stmt = $db_connection->prepare($query_check);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
           
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(empty($result)){
                header('Location: ../index.php?error=user');
            }else{
                return array(
                    'name' => $result['name'],
                    'email' => $result['email']
                );
            }
        }else{
            header('Location: ../index.php?error=db');
        }
    }
?>