<?php include("classes/productsDatabase-class.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmai</title>
</head>
<body>
    <h1>Products pagrindinis</h1>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category ID</th>
            <th>Image URL</th>
        </tr>
        <?php $products = new ProductsDatabase(); ?>
    </table>
</body>
</html>