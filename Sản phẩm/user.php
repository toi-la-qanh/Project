<?php
include "database/sql_connection.php";
session_start();
$db = new SQLConnect();
$conn = $db->connect();
$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT * FROM `account_guest` WHERE id = '$user_id'");
$query->execute();
if ($query->rowCount() > 0) {
    $user = $query->fetch();
}
;
if (isset($_POST['edit_name'])) {
    $name = $_POST['user_name'];
    $conn->exec("UPDATE `account_guest` SET name ='$name' WHERE id = '$user_id'");
    header("location:user.php");
}
;
if (isset($_POST['edit_address'])) {
    $address = $_POST['user_address'];
    $conn->exec("UPDATE `account_guest` SET address ='$address' WHERE id = '$user_id'");
    header("location:user.php");
}
;
if (isset($_POST['edit_phone'])) {
    $phone = $_POST['user_phone'];
    $conn->exec("UPDATE `account_guest` SET phone ='$phone' WHERE id = '$user_id'");
    header("location:user.php");
}
;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản</title>
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <nav>
        <div class="logo">
            <h1>Gi<span>à</span>y</h1>
        </div>
        <form action="search.php" method="post">
            <div class="search">
                <input class="box" type="text" name="key" required placeholder="Tìm kiếm gì đó....">
                <button type="submit" name="search"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul>
            <li><a href="home.php">Trang chủ</a></li>
            <li><a href="product.php">Sản phẩm</a></li>
            <li><a href="user.php">Tài khoản</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
        </ul>
    </nav>
    <form action="" method="post" class="box">
        <div class="user-profile">
            <table>
                <tr>
                    <p>Tên:
                        <span>
                            <input type="text" name="user_name" class="box" value="<?php echo $user['name']; ?>">
                        </span>
                        <button type="submit" name="edit_name" class="edit-button">✎</button>
                    </p>
                </tr>
                <tr>
                    <p>Email:
                        <span><?php echo $user['email']; ?></span>
                    </p>
                </tr>
                <tr>
                    <p>Địa chỉ:
                        <span>
                            <input type="text" name="user_address" class="box" value="<?php echo $user['address']; ?>">
                        </span>
                        <button type="submit" name="edit_address" class="edit-button">✎</button>
                    </p>
                </tr>
                <tr>
                    <p>Số điện thoại:
                        <span>
                            <input type="text" name="user_phone" class="box" value="<?php echo $user['phone']; ?>">
                            <button type="submit" name="edit_phone" class="edit-button">✎</button>
                        </span>
                    </p>
                </tr>
            </table>

            <div class="flex">
                <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Bạn muốn đăng xuất?');"
                    class="delete-btn">Đăng xuất</a>
            </div>
        </div>
    </form>
</body>

</html>