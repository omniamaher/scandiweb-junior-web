<?php 
include_once 'classes/productlist.class.php';
$productList = new ProductList();
$products = $productList->getProducts();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="header">
        <h1>Product list</h1>
        <div class="btns">
            <button onclick="window.location.href = 'addproduct.php';">ADD</button>
            <button class="delete-checkbox">MASS DELETE</button>
        </div>
    </div>
    <hr>

    <!-- Display products in boxes -->
    <?php foreach ($products as $product): ?>
        <div class="product-box">
            <input type="checkbox" class="product-checkbox" data-sku="<?php echo $product['sku']; ?>">
            <p>SKU: <?php echo $product['sku']; ?></p>
            <p>Name: <?php echo $product['name']; ?></p>
            <p>Price: <?php echo $product['price']." $ " ; ?></p>
            <?php if ($product['productType'] == 'book'): ?>
                <p>Weight: <?php echo $product['weight'] . " KG "; ?></p>
            <?php elseif ($product['productType'] == 'dvd'): ?>
                <p>Size: <?php echo $product['size']." MB "; ?></p>
            <?php elseif ($product['productType'] == 'furniture'): ?>
                <p><?php
                $dimensions = $product['height'] . ' x ' . $product['width'] . ' x ' . $product['length'];
                 echo 'Dimensions: ' . $dimensions;
                ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    
     <!-- Mass Delete button disappears -->
    <script>
        setTimeout(() => {
        document.querySelector('.delete-checkbox').style.display = 'none';
    }, 1000);
    </script>

    <script src="js/index.js"></script>
    <footer>
        <hr>
        <h4>Scandiweb Test Assignment</h4>
    </footer>
</body>
</html>
