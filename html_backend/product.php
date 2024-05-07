<?php
$db = new SQLConnect();
$conn = $db->connect();
$user_id = $_SESSION['user_id'];
$get_product = $conn->prepare("SELECT * FROM `product`");
$get_product->execute();
if ($get_product->rowCount() > 0) {
    while ($product = $get_product->fetch()) {
       
?>    
        <form method="post" class="box" action="">
            <img src="images/<?php echo $product['image']; ?>" alt="">
            <div class="name"><?php echo $product['name']; ?></div>
            <div class="price"><?php echo $product['price']; ?></div>
            <input type="number" min="1" name="quantity" value="1" 
            max="<?php echo $product['quantity']; ?>">
            <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
            <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
        </form>
<?php
     $max_quantity = $product['quantity'];
    };
};
if(isset($_POST['add_to_cart']))
{
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $product_id = $_POST['id'];
    $image = $_POST['image'];

    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE product_id = '$product_id'
    AND user_id = '$user_id'");
    if($select_cart->rowCount() > 0)
    {
        $message[]='Sản phẩm đã có trong giỏ hàng!';
    }
    else 
    {
        $conn->exec("INSERT INTO `cart` (user_id,product_name,product_id,price,quantity,image) 
        VALUES ('$user_id','$name','$product_id','$price','$quantity','$image')");
        $message[] = 'Đã thêm sản phẩm vào giỏ !';
    }
};  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
<?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message" onclick = "this.remove();">' . $msg . '</div>';
        }
    }

?>
</body>
</html>