<?php
include "sql_connection.php";
session_start();
$conn = connect_to_sql();
$user_id = $_SESSION['user_id'];
$get_user = $conn->prepare("SELECT * FROM `account_guest` WHERE id = '$user_id'");
$get_user->execute();
$get_product = $conn->prepare("SELECT * FROM `product`");
$get_product->execute();
if ($get_product->rowCount() > 0) {
    while ($product = $get_product->fetch()) {
    ?>    
        <form method="post" class="box" action="">
            <img src="images/<?php echo $product['image']; ?>" alt="">
            <div class="name"><?php echo $product['name']; ?></div>
            <div class="price"><?php echo $product['price']; ?></div>
            <input type="number" min="1" name="quantity" value="1">
            <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
            <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
            <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
        </form>
    <?php
    }
    ;
}
;
if(isset($_POST['add_to_cart']))
{
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE name = '$name' AND user_id = '$user_id' ");
    $select_cart->execute();
    if ($select_cart->rowCount() > 0) {
        $message[] = 'Sản phẩm đã có trong giỏ !';
    }
    else
    {
        //$add = connect_to_sql();
        $conn->exec("INSERT INTO `cart` (user_id,name,price,quantity) 
        VALUES ('$user_id','$name','$price','$quantity')");
        $message[] = 'Đã thêm sản phẩm vào giỏ !';
    }
};  
?>