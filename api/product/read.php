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
                    header('Content-Type: application/json;charset=utf-8');
                
                    include_once '../../model/product.php';  
                    
                    $prod = new Product($db);
                    $result = $prod->read();
                    $num = $result->rowCount();
                    if($num > 0) {
                        $product_array = array();
                        $product_array['data'] = array();
                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);

                            $product_item = array(
                                'id' => $id,
                                'name' => $name,
                                'price' => $price,
                                'category' => $category,
                                'createdAt' => $created_date,
                                'updatedAt' => $updated_date,
                            );

                            array_push($product_array['data'], $product_item);
                        }
                        echo json_encode($product_array);
                    }else{
                        echo json_encode(
                            array('message' => 'No Product Found')
                        );
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
?>