<?php
include '../classes/db.class.php';

class ProductController {
    private $db;
    private $error = [];
    private $success = '';

    public function __construct() {
        $this->db = new Db();
    }

    public function validateData() {
        if (isset($_POST['submit'])) {
            $sku = isset($_POST["sku"]) ? filter_var($_POST["sku"], FILTER_SANITIZE_SPECIAL_CHARS) : "";
            $name = isset($_POST["name"]) ? filter_var($_POST["name"], FILTER_SANITIZE_SPECIAL_CHARS) : "";
            $price = isset($_POST["price"]) ? filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : "";
            $productType = isset($_POST["productType"]) ? filter_var($_POST["productType"], FILTER_SANITIZE_SPECIAL_CHARS) : "";
            $size = ($productType == "dvd") ? (isset($_POST["size"]) ? filter_var($_POST["size"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : "") : "";
            $height = ($productType == "furniture") ? (isset($_POST["height"]) ? filter_var($_POST["height"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : "") : "";
            $width = ($productType == "furniture") ? (isset($_POST["width"]) ? filter_var($_POST["width"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : "") : "";
            $length = ($productType == "furniture") ? (isset($_POST["length"]) ? filter_var($_POST["length"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : "") : "";
            $weight = ($productType == "book") ? (isset($_POST["weight"]) ? filter_var($_POST["weight"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : "") : "";

            // Validate SKU
            if (empty($sku)) {
                $this->error[] = 'SKU is required';
            } elseif ($this->db->checkExistingSku($sku)) {
                $this->error[] = 'SKU already exists';
            }

            // Validate Name
            if (empty($name)) {
                $this->error[] = 'Name is required';
            }

            // Validate Price
            if (empty($price) || !is_numeric($price) || $price <= 0) {
                $this->error[] = 'Price is required and should be a positive number';
            }

            // Validate Product Type
            if (empty($productType)) {
                $this->error[] = 'Please choose a product type';
            }

            // Validate Book Weight
            if ($productType == 'book') {
                if (empty($weight) || !is_numeric($weight) || $weight <= 0) {
                    $this->error[] = 'Weight is required and should be a positive number';
                }
            }

            // Validate DVD Size
            if ($productType == 'dvd') {
                if (empty($size) || !is_numeric($size) || $size <= 0) {
                    $this->error[] = 'Size is required and should be a positive number';
                }
            }

            // Validate Furniture Dimensions
            if ($productType == 'furniture') {
                if (empty($height) || !is_numeric($height) || $height <= 0 ||
                    empty($width) || !is_numeric($width) || $width <= 0 ||
                    empty($length) || !is_numeric($length) || $length <= 0
                ) {
                    $this->error[] = 'Height, width, and length are required and should be positive numbers.';
                }
            }

            if (empty($this->error)) {
                $this->insertData($sku, $name, $price, $productType, $size, $height, $width, $length, $weight);
            } else {
                // Handle errors
                $errorMessage = implode(', ', $this->error);
                header("Location: ../addproduct.php?error=" . urlencode($this->error[0]));
                exit();
            }
        }
    }

    private function insertData($sku, $name, $price, $productType, $size, $height, $width, $length, $weight) {
        // Insert data into the database
        $query = "INSERT INTO products (sku, name, price, productType, size, height, width, length, weight)
                  VALUES (:sku, :name, :price, :productType, :size, :height, :width, :length, :weight)";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':productType', $productType);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':length', $length);
        $stmt->bindParam(':weight', $weight);
        $stmt->execute();

        $this->success = 'Data inserted successfully';
        header('location:../index.php');
    }
}

// Initialize the class and call the method to validate the data
$productController = new ProductController();
$productController->validateData();
?>
