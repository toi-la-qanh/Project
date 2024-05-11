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
    <div class="user-profile">
        <form action="" method="post" class="box">
            <table>
                <tr>
                    <td class="user_name">Tên:</td>
                    <td>
                        <span>
                            <input type="text" name="user_name" class="box" value="<?php echo $user['name']; ?>">
                        </span>
                        <button type="submit" name="edit_name" class="edit-button">✎</button>
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><span><?php echo $user['email']; ?></span></td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td>
                        <span>
                            <input type="text" name="user_address" class="box" value="<?php echo $user['address']; ?>">
                        </span>
                        <button type="submit" name="edit_address" class="edit-button">✎</button>
                    </td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td>
                        <span>
                            <input type="text" name="user_phone" class="box" value="<?php echo $user['phone']; ?>">
                            <button type="submit" name="edit_phone" class="edit-button">✎</button>
                        </span>

                    </td>
                </tr>
            </table>
        </form>
        <div class="flex">
            <div class="flex">
                <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Bạn muốn đăng xuất?');"
                    class="delete-btn">Đăng xuất</a>
            </div>
        </div>
    </div>

</body>

</html>