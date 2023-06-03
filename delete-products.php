<?php
include 'includes/autoloader.inc.php';

class ProductDeletion extends Db
{
    public function deleteProducts($skusToDelete)
    {
        $placeholders = rtrim(str_repeat('?,', count($skusToDelete)), ',');
        $sql = "DELETE FROM products WHERE sku IN ($placeholders)";
        $stmt = $this->connect()->prepare($sql);
        
        // Bind the SKUs to the prepared statement
        foreach ($skusToDelete as $index => $sku) {
            $stmt->bindValue($index + 1, $sku);
        }
        
        // Execute the statement
        $stmt->execute();
        
        // Return the number of deleted rows
        return $stmt->rowCount();
    }
}

// Check if the 'delete' parameter exists
if (isset($_POST['delete'])) {
    $skusToDelete = explode(',', $_POST['delete']);

    // Delete the products using the Db class
    $productDeletion = new Db();
    $deletedRows = $productDeletion->deleteProducts($skusToDelete);

    if ($deletedRows > 0) {
        $response = array('success' => true, 'skus' => $skusToDelete);
    } else {
        $response = array('success' => false, 'error' => 'Failed to delete products.');
    }
} else {
    $response = array('success' => false, 'error' => 'Invalid request.');
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);


