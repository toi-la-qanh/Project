<?php 
include "sql_connection.php";
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop bán giày đẹp nhất Việt Nam</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Trang chủ</label>
        <ul>
            <li><a class="active" href="">Tài khoản</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
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

            <?php
            $conn = connect_to_sql();
            $get_user = $conn->prepare("SELECT * FROM `account_guest` WHERE id = '$user_id'");
            $get_user->execute();
            if ($get_user->rowCount() > 0) {
                $user = $get_user->fetch();
            }
            ;
            ?>
            <p> username: <span>
                    <?php echo $user['name']; ?> 
                </span></p>
            <p> email: <span>
                    <?php echo $user['email']; ?> 
                </span>
            <div class="flex">
                <div class="flex">
                    <a href="login.php" class="btn">Đăng nhập</a>
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