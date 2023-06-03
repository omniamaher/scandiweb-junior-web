<?php
class DVD extends Products
{
    protected $size;
    
    public function __construct($sku, $name, $price, $size) {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }
    
    public function saveToDatabase() {
        $sql = "INSERT INTO products (sku, name, price, productType, size)
                VALUES (?, ?, ?, 'dvd', ?)";
        $stmt = $this->connect()->prepare($sql);
        
        // Bind the values to the prepared statement
        $stmt->bindParam(1, $this->sku);
        $stmt->bindParam(2, $this->name);
        $stmt->bindParam(3, $this->price);
        $stmt->bindParam(4, $this->size);
        
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }


}