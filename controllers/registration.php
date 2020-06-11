<?php
    if( isset( $_POST['submit'] ) ){
        include_once '../config/database.php';
        $database = new Database();
        $db_connection = $database->connect();
        if($db_connection){
            if(isset($_POST["name"], $_POST["email"], $_POST["password"])){
                if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])){
                    header('Location: ../register.php?error=email&name='.$name);
                }else{
                    $name = $_POST["name"];
                    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                    $pass = password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost" => rand(5, 20)]);
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $query_check = "select * from users where email = :email";
                        $stmt = $db_connection->prepare($query_check);
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();
                    
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        if(!empty($result)){
                            header('Location: ../register.php?error=user&name='.$name);
                        }else{
                            $query_insertion = "insert into users(name, email, password, is_admin) values(:name, :email, :pass, 'false')";
                            $stmt = $db_connection->prepare($query_insertion);
                            $stmt->bindParam(':name', $name);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':pass', $pass);
                            $stmt->execute();
                            header('Location: ../login.php');
                        }
                    }else{
                        header('Location: ../register.php?error=email&name='.$name);
                    }
                }
            }else{
                header('Location: ../register.php?error=forbidden');
            }
        }else{
            header('Location: ../register.php?error=db');
        }
    }else{
        header('Location: ../register.php?error=forbidden');
    }
?>