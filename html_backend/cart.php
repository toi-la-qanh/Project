<?php
include "database/sql_connection.php";
session_start();
$db = new SQLConnect();
$conn = $db->connect();
$user_id = $_SESSION['user_id'];
$get_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = '$user_id'");
$get_cart->execute();
$cost = 0;
if ($get_cart->rowCount() > 0) {
    while ($cart = $get_cart->fetch()) {
        $cost += $cart['price']*$cart['quantity'];
?>
        <form method="post" class="box" action="">
            <img src="images/<?php echo $cart['image']; ?>" alt="">
            <div class="name"><?php echo $cart['product_name']; ?></div>
            <div class="price"><?php echo $cart['price']; ?> đồng</div>
            <div class="quantity">Số lượng:
            <input type="number" min="<?php echo $cart['quantity']; ?>" name="quantity" value="1" max="">
            </div>
            
            <input type="hidden" name="prod_id" value="<?php echo $cart['product_id']; ?>">
            <input type="hidden" name="image" value="<?php echo $cart['image']; ?>">
            <input type="hidden" name="name" value="<?php echo $cart['product_name']; ?>">
            <input type="hidden" name="price" value="<?php echo $cart['price']; ?>">
            <input type="submit" value="Xoá khỏi giỏ hàng" name="remove_from_cart" class="btn">
        </form>
<?php
    }
?>
    <div>Tổng tiền:
        <?php echo $cost;?>
    </div>
<?php
    ;
}
;
if (isset($_POST['remove_from_cart'])) {
    $prod_id = $_POST['prod_id'];
    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE product_id = '$prod_id' AND user_id = '$user_id'");
    $select_cart->execute();
    if ($select_cart->rowCount() > 0) {
        $conn->exec("DELETE FROM `cart` WHERE product_id = '$prod_id' AND user_id = '$user_id'");
        $message[] = 'Đã xoá sản phẩm khỏi giỏ hàng!';
    }
};
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
?>
