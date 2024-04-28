<?php
include "sql_connection.php";
session_start();
$conn = connect_to_sql();
$user_id = $_SESSION['user_id'];
$get_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = '$user_id'");
$get_cart->execute();
if ($get_cart->rowCount() > 0) {
    while ($cart = $get_cart->fetch()) {
    ?>    
        <form method="post" class="box" action="">
            <img src="images/<?php echo $cart['image']; ?>" alt="">
            <div class="name"><?php echo $cart['product_name']; ?></div>
            <div class="price"><?php echo $cart['price']; ?> đồng</div>
            <div class="quantity">Số lượng:
            <input type="number" min="1" name="quantity" value="<?php echo $cart['quantity']; ?>">
            </div>
            <input type="hidden" name="image" value="<?php echo $cart['image']; ?>">
            <input type="hidden" name="name" value="<?php echo $cart['product_name']; ?>">
            <input type="hidden" name="price" value="<?php echo $cart['price']; ?>">
            <input type="submit" value="Xoá khỏi giỏ hàng" name="remove_from_cart" class="btn">
        </form>
    <?php
    }
    ;
}
;
if(isset($_POST['remove_from_cart']))
{
    $name = $_POST['name'];
    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE name = '$name' AND user_id = '$user_id' ");
    $select_cart->execute();
    if ($select_cart->rowCount() > 0) {
        $conn->exec("DELETE FROM `cart` WHERE name = '$name' AND user_id = '$user_id'");
        $message[] = 'Đã xoá sản phẩm khỏi giỏ hàng!';
    }
};  
?>