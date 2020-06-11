<?php
    class Product {
        private $conn;
        private $table = 'products';
    
        public $id;
        public $name;
        public $price;
        public $category;
        public $createdAt;
        public $updatedAt;
    
        public function __construct($db) {
          $this->conn = $db;
        }

        public function read() {
            $query = 'select p.id, p.name, p.price, p.category, p.created_date, p.updated_date from '.$this->table.' p';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single(){
            $query_max = 'select max(id) as max from products';
            $stmt_max = $this->conn->prepare($query_max);
            $stmt_max->execute();
            $result = $stmt_max->fetch(PDO::FETCH_ASSOC);
            $max = $result['max'];

            $query = 'select p.id, p.name, p.price, p.category, p.created_date, p.updated_date from '.$this->table.' p
                    where p.id = ? limit 0,1';
    
            $stmt = $this->conn->prepare($query);
            if($this->id > $max){
                echo json_encode(
                    array('message' => 'No Such Product')
                );
                exit;
            }else{
                $stmt->bindParam(1, $this->id);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->name = $row['name'];
                $this->price = $row['price'];
                $this->category = $row['category'];
                $this->createdAt = $row['created_date'];
                $this->updatedAt = $row['updated_date'];
            }
        }

        public function create(){
            $query = "insert into ".$this->table."
                set
                    name = :name,
                    price = :price,
                    category = :category";
            
            $stmt = $this->conn->prepare($query);


            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->category = htmlspecialchars(strip_tags($this->category));

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':category', $this->category);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s. \n", $stmt->error);
            return false;
        }

        public function update(){
            $query = "update ".$this->table."
                set
                    name = :name,
                    price = :price,
                    category = :category
                where id = :id";
            
            $stmt = $this->conn->prepare($query);


            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':category', $this->category);
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s. \n", $stmt->error);
            return false;
        }

        public function delete(){
            $query = "delete from ".$this->table. " where id = :id";

            $stmt = $this->conn->prepare($query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(':id', $this->id);
            
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s. \n", $stmt->error);
            return false;
        }
    }
?>