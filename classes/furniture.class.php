<?php
class Furniture extends Products
{  protected $length;
    protected $height;
    protected $width;
    
    public function __construct($sku, $name, $price, $length, $height, $width) {
        parent::__construct($sku, $name, $price);
        $this->length = $length;
        $this->height = $height;
        $this->width = $width;
    }
    
    public function saveToDatabase() {
        $sql = "INSERT INTO products (sku, name, price, productType, length, height, width)
                VALUES (?, ?, ?, 'furniture', ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        
        // Bind the values to the prepared statement
        $stmt->bindParam(1, $this->sku);
        $stmt->bindParam(2, $this->name);
        $stmt->bindParam(3, $this->price);
        $stmt->bindParam(4, $this->length);
        $stmt->bindParam(5, $this->height);
        $stmt->bindParam(6, $this->width);
        
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    
}

