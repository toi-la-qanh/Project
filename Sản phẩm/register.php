<?php
include "database/sql_connection.php";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $pass = $_POST['password'];

    $db = new SQLConnect();
    $query = $db->connect();
    $Execquery = $query->prepare("SELECT * FROM `account_guest` WHERE name = '$name' 
    AND password = '$pass' AND email = '$email'");
    $Execquery->execute();

    if ($Execquery->rowCount() > 0) {
        $message[] = "Tài khoản đã tồn tại!";
    } 
    else//add account of user into database
    {
        $query->exec("INSERT INTO `account_guest`(id, name, password, email) 
        VALUES(NULL, '$name', '$pass', '$email')");
        $message[] = "Đăng ký thành công!";
        header('location:index.php');
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>"  type="text/css" />
    <title>Register</title>
</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message" onclick = "this.remove();">' . $msg . '</div>';
        }
    }

    ?>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="" method="post">
                <h1>Tạo tài khoản</h1>
                <input type="text" name="name" required placeholder="Nhập tài khoản" class="box">
                <input type="password" name="password" required placeholder="Nhập mật khẩu" class="box">
                <input type="email" name="email" required placeholder="Nhập email" class="box">
                <button type="submit" name="submit" class="btn" value="">Đăng ký</button>   
            </form>
        </div>
        <div class="toggle">
            <div class="toggle-container-left">
                <div class="toggle-panel toggle-left">
                    <h1>Chào mừng bạn!</h1>
                    <p>Đăng nhập để bắt đầu trải nghiệm mua sắm</p>
                    <button class="hidden" id="login">
                        <a href="index.php">Đăng nhập</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>