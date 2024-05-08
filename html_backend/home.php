<?php
include "database/sql_connection.php";
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop bán giày đẹp nhất Việt Nam</title>
</head>

<body>

    <nav>
        <label ><a href="index.php">Trang chủ</a></label>
        <ul>
            <li><a href="user.php">Tài khoản</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
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

    <div class="container">

        <div class="user-profile">
            <div class="flex">
                <div class="flex">
                    <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Bạn muốn đăng xuất?');"
                        class="delete-btn">Đăng xuất</a>
                </div>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="products">
            <?php
            $db = new SQLConnect();
            $conn = $db->connect();
            $get_product = $conn->prepare("SELECT * FROM `product` LIMIT 4");
            $get_product->execute();
            if ($get_product->rowCount() > 0) {
                while ($product = $get_product->fetch()) {
                    ?>
                    <form method="post" class="box" action="">
                        <img src="images/<?php echo $product['image']; ?>" alt="" width="200" height="200">
                        <div class="name"><?php echo $product['name']; ?></div>
                        <div class="price"><?php echo $product['price']; ?></div>
                    </form>
                    <?php
                }
                ;
            }
            ;
            ?>
        </div>
    </div>
</body>

</html>