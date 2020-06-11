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
                    header('Access-Control-Allow-Origin: *');
                    header('Content-Type: application/json');
                    
                    include_once '../../model/product.php'; 
                
                    $prod = new Product($db);
                    $prod->id = isset($_GET['id']) ? $_GET['id'] : die();
                
                    $prod->read_single();
                
                    $product_array = array();
                    $product_array['data'] = array(
                        'id' => $prod->id,
                        'name' => $prod->name,
                        'price' => $prod->price,
                        'category' => $prod->category,
                        'createdAt' => $prod->createdAt,
                        'updatedAt' => $prod->updatedAt,
                    );
                    echo json_encode($product_array);
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
?>