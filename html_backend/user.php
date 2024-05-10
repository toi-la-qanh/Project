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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
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

        .user-profile {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 400px;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .user-profile p {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-profile span {
            font-weight: bold;
        }

        .edit-button {
            background-color: #C0C0C0;
            border: none;
            color: black;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            font-size: 9px;
            cursor: pointer;
            border-radius: 5px;
        }

        .edit-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <header>
        <h1>Tài Khoản Của Tôi</h1>
        <nav>

            <label><a href="index.php">Trang chủ</a></label>
            <ul>
                <li><a href="cart.php">Giỏ hàng</a></li>
                <li><a href="product.php">Sản phẩm</a></li>
            </ul>

        </nav>
    </header>
    <div class="user-profile">
        <form action="" method="post" class="box">
            <p> Tên:<span>
                    <input type="text" name="user_name" class="box" value="<?php echo $user['name']; ?>">
                </span>
                <button type="submit" name="edit_name" class="edit-button">✎</button>
            </p>
            <p> Email:
                <span>
                    <?php echo $user['email']; ?>
                </span>
            </p>
            <p> Địa chỉ:<span>
                    <input type="text" name="user_address" class="box" value="<?php echo $user['address']; ?>">
                </span>
                <button type="submit" name="edit_address" class="edit-button">✎</button>
            </p>
            <p> Số điện thoại:<span>
                    <input type="text" name="user_phone" class="box" value="<?php echo $user['phone']; ?>">
                </span>
                <button type="submit" name="edit_phone" class="edit-button">✎</button>
            </p>
        </form>
    </div>
</body>
<footer>
    <div class="footer-item">
        <div class="img-footer">
        </div>
        <div class="social-footer">
            <li><a target="_blank" href="https://www.facebook.com/">
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </a></li>
            <li><a target="_blank" href="https://github.com/">
                    <i class="fa fa-github-square" aria-hidden="true"></i>
                </a></li>

        </div>
    </div>
</footer>

</html> <img src="img/logo.png" alt="" />