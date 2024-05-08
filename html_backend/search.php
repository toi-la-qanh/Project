<?php
include "database/sql_connection.php";
session_start();
$db = new SQLConnect();
$conn = $db->connect();
$user_id = $_SESSION['user_id'];
if (isset($_POST['search'])) {
    $keyword = $_POST['key'];
    $get_product_from_key = $conn->prepare("SELECT * FROM `product` WHERE name LIKE '%" . $keyword . "%'");
    $get_product_from_key->execute();
}
;
if (isset($_POST['add_to_cart'])) {
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $product_id = $_POST['id'];
    $image = $_POST['image'];

    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE product_id = '$product_id'
    AND user_id = '$user_id' AND product_name = '$name'");
    $select_cart->execute();
    if ($select_cart->rowCount() > 0) {
        $message[] = 'Sản phẩm đã có trong giỏ hàng!';
    } else {
        $conn->exec("INSERT INTO `cart` (user_id,product_name,product_id,price,quantity,image) 
        VALUES ('$user_id','$name','$product_id','$price','$quantity','$image')");
        $message[] = 'Đã thêm sản phẩm vào giỏ !';
    }
}
;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars"></i>
        </label>
        <label href="index.php">Trang chủ</label>
        <ul>
            <li><a href="user.php">Tài khoản</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
            <li><a class="active" href="product.php">Sản phẩm</a></li>
        </ul>
    </nav>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message" onclick = "this.remove();">' . $msg . '</div>';
        }
    }
    ?>
    <div class="product">
        <?php
        if ($get_product_from_key->rowCount() > 0) {
            while ($product_from_key = $get_product_from_key->fetch()) {
                ?>
                <form method="post" class="box" action="">
                    <img src="images/<?php echo $product_from_key['image']; ?>" alt="" width="200" height="200">
                    <div class="name"><?php echo $product_from_key['name']; ?></div>
                    <div class="price"><?php echo $product_from_key['price']; ?></div>
                    <input type="number" min="1" name="quantity" value="1" max="<?php echo $product_from_key['quantity']; ?>">
                    <input type="hidden" name="image" value="<?php echo $product_from_key['image']; ?>">
                    <input type="hidden" name="name" value="<?php echo $product_from_key['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $product_from_key['price']; ?>">
                    <input type="hidden" name="id" value="<?php echo $product_from_key['id']; ?>">
                    <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
                </form>
                <?php
            }
            ;
        }
        ;
        ?>
    </div>
</body>

</html>