<?php
include "database/sql_connection.php";
session_start();
$db = new SQLConnect();
$conn = $db->connect();
$user_id = $_SESSION['user_id'];
if (isset($_POST['remove_from_cart'])) {
    $prod_id = $_POST['prod_id'];
    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE product_id = '$prod_id' AND user_id = '$user_id'");
    $select_cart->execute();
    if ($select_cart->rowCount() > 0) {
        $conn->exec("DELETE FROM `cart` WHERE product_id = '$prod_id' AND user_id = '$user_id'");
        $message[] = 'Đã xoá sản phẩm khỏi giỏ hàng!';
        header('location:cart.php');
    }
}
;
if(isset($_POST['update_cart']))
{
    $quantity = $_POST['quantity'];
    $prod_id = $_POST['prod_id'];
    $conn->exec("UPDATE `cart` SET quantity = '$quantity' WHERE user_id = '$user_id' AND
    product_id = '$prod_id'");
    $message[] = 'Đã cập nhật giỏ hàng!';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>
                body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .cart {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .box {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .box img {
            width: 100px;
            height: auto;
            margin-right: 20px;
        }

        .name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .price {
            color: #007bff;
            margin-bottom: 10px;
        }

        .quantity input[type="number"] {
            width: 50px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav>
        <label ><a href="index.php">Trang chủ</a></label>
        <ul>
            <li><a href="user.php">Tài khoản</a></li>
            <li><a class="active" href="cart.php">Giỏ hàng</a></li>
            <li><a href="product.php">Sản phẩm</a></li>
        </ul>
    </nav>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message" onclick = "this.remove();">' . $msg . '</div>';
        }
    }
    ?>
    <div class="cart">
        <?php
        $get_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = '$user_id'");
        $get_cart->execute();
        $cost = 0;
        if ($get_cart->rowCount() > 0) {
            while ($cart = $get_cart->fetch()) {
                $cost += $cart['price'] * $cart['quantity'];
                ?>
                <form method="post" class="box" action="">
                    <img src="images/<?php echo $cart['image']; ?>" alt="" width="200" height="200">
                    <div class="name"><?php echo $cart['product_name']; ?></div>
                    <div class="price"><?php echo $cart['price']; ?> đồng</div>
                    <div class="quantity">Số lượng:
                        <input type="number" min="1" value="<?php echo $cart['quantity']; ?>" 
                        name="quantity">
                        <input type="submit" name="update_cart" value="Cập nhật" class="option-btn">
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
                <?php echo $cost; ?>
            </div>
        <?php
            ;
        }
        else {
            $message[]="Chưa có sản phẩm nào trong giỏ!";
        };
        ?>
    </div>
</body>

</html>