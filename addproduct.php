<!DOCTYPE html>
<html>  
<Head>  
<title>Product Add</title>
<link rel="stylesheet" href="css/addproduct.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
</Head>  
<Body>  

<div class="header">
    <h1> Product Add </h1>
    <div class="btns">
        <button type="submit" name="submit" form="product_form"> Save </button>
        <button onclick="window.location.href = 'index.php';">Cancel</button>
    </div>
</div>
<hr/>

<!-- Main form -->
<form id="product_form" action="includes/ProductController.inc.php" method="POST">
    <label for="sku">SKU</label>
    <input type="text" id="sku" name="sku" placeholder="#sku" oninput="checkSku">
    <br>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="#name">
    <br>
    <label for="price">Price ($)</label>
    <input type="text" id="price" name="price" placeholder="#price">
    <br>
    <label for="productType">Product Type</label>

    <select id="productType" name="productType">
        <option value="" disabled selected>Type Switcher</option>
        <option value="dvd">DVD</option>
        <option value="furniture">Furniture</option>
        <option value="book">Book</option>
    </select>

    <br><br>

    <!-- Form for DVD -->
    <div class="form-container" id="DVD">
        <label for="size">Size</label>
        <input type="text" id="size" name="size" placeholder="#size">
        <p>Please provide disc space in MB</p>
    </div>

    <!-- Form for Furniture -->
    <div class="form-container" id="furniture">
        <label for="height">Height (CM)</label>
        <input type="text" id="height" name="height" placeholder="#height">
        <br>
        <label for="width">Width (CM)</label>
        <input type="text" id="width" name="width" placeholder="#width">
        <br>
        <label for="length">Length (CM)</label>
        <input type="text" id="length" name="length" placeholder="#length">
        <p>Please provide dimensions in HxWxL format</p>
    </div>

    <!-- Form for Book -->
    <div class="form-container" id="book">
        <label for="weight">Weight (KG)</label>
        <input type="text" id="weight" name="weight" placeholder="#weight">
        <p>Please provide book weight in KG</p>
    </div>
 <!-- Display error message -->
    <?php if (isset($_GET['error']) && !empty($_GET['error'])): ?>
        <div class="error"><?php echo $_GET['error']; ?></div>
    <?php endif; ?>
</form>



<script src="js/index.js"></script>
<script src="index.js"></script>

<footer>
    <hr>
    <h4> Scandiweb Test Assignment </h4>
</footer>

</Body>  
</html> 
