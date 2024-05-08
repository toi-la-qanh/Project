<?php
include "database/sql_connection.php";
session_start();
$db = new SQLConnect();
$conn = $db->connect();
$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT name, email FROM `account_guest` WHERE id = '$user_id'");
$query->execute();
if ($query->rowCount() > 0) {
    $user = $query->fetch();
}
;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <label ><a href="index.php">Trang chủ</a></label>
        <ul>
            <li><a class="active" href="user.php">Tài khoản</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
            <li><a href="product.php">Sản phẩm</a></li>
        </ul>
    </nav>
    <div class="user-profile">
        <p> Tên:<span>
                <?php echo $user['name']; ?>
            </span></p>
        <p> Email:<span>
                <?php echo $user['email']; ?>
            </span></p>
    </div>
</body>

</html>