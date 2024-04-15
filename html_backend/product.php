<?php 
include "sql_connection.php";
session_start();
if(isset($_GET['product_id']))
{
    $conn = connect_to_sql();
    $querry = $conn->prepare("SELECT * FROM product");
    $querry->execute([$_GET['product_id']]);
    $product = $querry->fetch();

    if(!$product)
    {
        exit("Sản phẩm không tồn tại!");
    }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
</head>
<body>
    <div class="product content-wrapper">
        <div>
            <h1 class = "name"><?=$product['name']?></h1>
            <span class = "price"><?=$product['price']?></span>
            <form action="index.php?page=cart" method = "post">
                <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>">
                <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
                <input type="submit" value="Thêm vào giỏ hàng">
            </form>
        </div>
    </div>
</body>
</html> 