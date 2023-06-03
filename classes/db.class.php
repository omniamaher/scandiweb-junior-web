<?php 
class Db{
    public $host="127.0.0.1";
    public $user="root";
    public $pwd="";
    public $dbName="scandiweb";

    //connect to the database

    public  function connect(){
        $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $pdo ;
    }

    // Check if SKU already exists in the database
    public function checkExistingSku($sku) {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE sku = :sku");
        $stmt->bindParam(":sku", $sku);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
 
    }

        // Get all products from the database
    public function getProducts() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
        }
        
        // Delete multiple products by SKU
    public function deleteProducts($skus) {
        $pdo = $this->connect();
        // Create a placeholder string for the SKUs
        $placeholders = rtrim(str_repeat('?,', count($skus)), ','); 
        // Prepare the delete query with the IN clause
        $stmt = $pdo->prepare("DELETE FROM products WHERE sku IN ($placeholders)");  
        // Bind the SKUs as parameters
        foreach ($skus as $index => $sku) {
            $stmt->bindValue($index + 1, $sku);
        }    
        // Execute the query
        $stmt->execute();
        // Return the number of affected rows
        return $stmt->rowCount();
    }
    

}