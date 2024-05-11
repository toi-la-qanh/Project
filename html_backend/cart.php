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
if (isset($_POST['update_cart'])) {
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="product.css">
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav>
        <div class="logo">
            <h1>Gi<span>à</span>y</h1>
        </div>
        <div class="search">
            <form action="search.php" method="post">
                <input class="box" type="text" name="key" required placeholder="Tìm kiếm gì đó....">
                <button type="submit" name="search">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <ul>
            <li><a href="home.php">Trang chủ</a></li>
            <li><a href="product.php">Sản phẩm</a></li>
            <li><a href="user.php">Tài khoản</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
        </ul>
    </nav>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
        }
    }
    ?>
    <div class="cart">
        <table>
        <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Giá tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $get_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = '$user_id'");
                $get_cart->execute();
                $cost = 0;
                if ($get_cart->rowCount() > 0) {
                    while ($cart = $get_cart->fetch()) {
                        $cost += $cart['price'] * $cart['quantity'];
                        ?>
                        <form action="" method="post" class="box">
                            <tr>

                                <td>
                                    <img src="images/<?php echo $cart['image']; ?>" alt="<?php echo $cart['product_name']; ?>"
                                        width="100" height="100">
                                    <br>
                                    <?php echo $cart['product_name']; ?>
                                </td>
                                <td><?php echo $cart['price']; ?> đồng</td>
                                <td>
                                    <div class="quantity-control">
                                        <input type="number" value="<?php echo $cart['quantity']; ?>" name="quantity">
                                        <input type="submit" name="update_cart" value="Cập nhật" class="option-btn">
                                    </div>
                                    <input type="hidden" name="prod_id" value="<?php echo $cart['product_id']; ?>">
                                    <input type="hidden" name="image" value="<?php echo $cart['image']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $cart['product_name']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $cart['price']; ?>">
                                </td>

                                <td><?php echo $sub_total = number_format($cart['price'] * $cart['quantity']); ?> đồng
                                    
                                </td>
                                <td><input type="submit" value="Xoá khỏi giỏ hàng" name="remove_from_cart" class="btn"></td>
                            </tr>
                        </form>
                        <?php
                    }
                    ?>
                    <?php
                    ?>

                    <?php
                } else {
                    $message[] = "Chưa có sản phẩm nào trong giỏ!";
                }
                ?>
            </tbody>
        </table>
        </form>

        <div class="total-price">
            <table>
                <td><strong>Tổng tiền: </strong></td>
                <td><?php echo $cost; ?> đồng</td>
            </table>
        </div>
</body>


</html>