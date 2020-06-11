<?php
    if( isset( $_POST['submit'] ) ){
        $DB_HOST = 'localhost';
        $DB_NAME = 'example';
        $DB_USER = 'postgres';
        $DB_PASS = 'root';
        $db_connection = pg_connect("host=$DB_HOST dbname=$DB_NAME user=$DB_USER password=$DB_PASS");
        if($db_connection){
            if(isset($_POST["name"], $_POST["email"], $_POST["password"])){
                $name = pg_escape_string($_POST["name"]);
                $email = pg_escape_string(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
                $pass = pg_escape_string(password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost" => rand(5, 20)]));
                if(filter_var(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)){
                    $query_check = "select * from users where email = $1";
                    pg_prepare($db_connection, "check", $query_check);
                    $result = pg_execute($db_connection, "check", array($email));
                    $result = pg_fetch_row($result);

                    if(!empty($result)){
                        header('Location: register.php?error=user');
                    }else{
                        $query_insertion = "insert into users(name, email, password) values($1, $2, $3)";
                        pg_prepare($db_connection, "insertion", $query_insertion);
                        pg_send_execute($db_connection, "insertion", array($name, $email, $pass));
                        header('Location: login.php');
                    }
                }else{
                    header('Location: register.php?error=email');
                }
                

                pg_close($db_connection);
            }else{
                header('Location: register.php');
            }
        }
    }else{
        header('Location: register.php');
    }
?>