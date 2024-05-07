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
        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Trang chủ</label>
        <ul>
            <li><a class="active" href="user.php">Tài khoản</a></li>
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
                include "product.php";
            ?>
        </div>
    </div>
</body>

</html>