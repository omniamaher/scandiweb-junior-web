<?php
class Book extends Products {
    protected $weight;
    
    public function __construct($sku, $name, $price, $weight) {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }
    
    public function saveToDatabase() {

        $sql = "INSERT INTO products (sku, name, price, productType, weight)
                VALUES (?, ?, ?, 'book', ?)";
        $stmt = $this->connect()->prepare($sql);
        
        // Bind the values to the prepared statement
        $stmt->bindParam(1, $this->sku);
        $stmt->bindParam(2, $this->name);
        $stmt->bindParam(3, $this->price);
        $stmt->bindParam(4, $this->weight);
        
        // Execute the statement
        if ($stmt->execute()) {
            return true; 
        } else {
            return false;
        }
    }

}