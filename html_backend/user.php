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
     
            <label ><a href="index.php">Trang chủ</a></label>
         <ul>
            <li><a href="cart.php">Giỏ hàng</a></li>
            <li><a href="product.php">Sản phẩm</a></li>
        </ul>
  
        </nav>
    </header>
    <div class="user-profile">
        <p> Tên:<span>
                <?php echo htmlspecialchars($user['name']); ?>
            </span>
            <button class="edit-button">✎</button>
            </p>
        <p> Email:<span>
                <?php echo htmlspecialchars($user['email']); ?>
            </span>
            <button class="edit-button">✎</button>
            </p>
        <p> Địa chỉ:<span>
                <?php echo htmlspecialchars($user['address']); ?>
            </span>
            <button class="edit-button">✎</button>
        </p>
        <p> Số điện thoại:<span>
                <?php echo htmlspecialchars($user['phone']); ?>
            </span>
            <button class="edit-button">✎</button>
        </p>
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