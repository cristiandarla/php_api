<?php
    if(!isset($_SERVER['PHP_AUTH_USER'])){
        header("WWW-Autehncticate: Basic realm=\"Authorization needed\"");
        header("HTTP/1.0 401 UNAUTHORIZED");
        echo "You need proper authentication!3";
        exit;
    }else{
        if(!empty($_SERVER['PHP_AUTH_USER']) && !empty($_SERVER['PHP_AUTH_PW'])){
            include_once '../../config/database.php';

            $database = new Database();
            $db = $database->connect();

            $query = "select * from users where email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email',$_SERVER['PHP_AUTH_USER']);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!empty($result)){
                if(password_verify($_SERVER['PHP_AUTH_PW'], $result['password'])){
                    if($result['is_admin']){
                        header('Access-Control-Allow-Origin: *');
                        header('Content-Type: application/json');
                        header('Access-Control-Allow-Methods: DELETE');
                        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');
                    
                        include_once '../../model/product.php';  

                        $prod = new Product($db);
                        $data = json_decode(file_get_contents("php://input"));

                        $prod->id = $data->id;
                        
                        if($prod->delete()){
                            echo json_encode(
                                array('message' => 'Product Deleted')
                            );
                        }else{
                            echo json_encode(
                                array('message' => 'Product NOT Deleted')
                            );
                        }
                    }else{
                        header("WWW-Autehncticate: Basic realm=\"Authorization needed\"");
                        header("HTTP/1.0 403 FORBIDDEN");
                        echo "You need proper authentication!";
                        exit;
                    }
                }else{
                    header("WWW-Autehncticate: Basic realm=\"Authorization needed\"");
                    header("HTTP/1.0 401 UNAUTHORIZED");
                    echo "You need proper authentication!2";
                    exit;
                    }
            }else{
                header("WWW-Autehncticate: Basic realm=\"Authorization needed\"");
                header("HTTP/1.0 401 UNAUTHORIZED");
                echo "You need proper authentication!1";
                exit;
            }
        }
    }

    