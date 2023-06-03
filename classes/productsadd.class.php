<?php
include 'includes/autoloader.inc.php';

class ProductsAdd extends Db
{
    public function setProduct($sku, $name, $price, $productType, $size, $height, $width, $length, $weight)
    {
        $stmt = $this->connect()->prepare('INSERT INTO products (sku, name, price, productType, size, height, width, length, weight) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

        if (!$stmt->execute(array($sku, $name, $price, $productType, $size, $height, $width, $length, $weight))) {
            $stmt = null;
            header("location: ../addproduct.php?error=stmtfailed");
        }
        $stmt = null;
    }

    public function checkSku($sku)
    {
        $stmt = $this->connect()->prepare('SELECT sku FROM products WHERE sku = ?');
        if (!$stmt->execute(array($sku))) {
            $stmt = null;
            header("location: ../addproduct.php?error=smtmfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}


