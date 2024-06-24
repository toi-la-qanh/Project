<?php
include "database/sql_connection.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $database = new SQLConnect();
    $query = $database->connect();
    $Execquery = $query->prepare("SELECT * FROM `account_guest` WHERE email = '$email'");
    $Execquery->execute();
    $user = $Execquery->fetch();
    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            sleep(2);
            header('location:home.php');
        }
    }
    $message[] = "Sai tài khoản hoặc mật khẩu!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>" type="text/css" />
    <title>Login</title>
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
        <div class="form-container sign-in">
            <form action="" method="post">
                <h1>Đăng nhập</h1>
                <input type="email" name="email" required placeholder="Nhập email" class="box">
                <input type="password" name="password" required placeholder="Nhập mật khẩu" class="box">
                <button type="submit" name="submit" class="btn" value="">Đăng nhập</button>
            </form>
        </div>
        <div class="toggle">
            <div class="toggle-container-right">
                <div class="toggle-panel toggle-right">
                    <h1>Hoặc đăng ký</h1>
                    <p>Đăng ký tài khoản để trải nghiệm tất cả tính năng mua sắm</p>
                    <button class="hidden" id="register">
                        <a href="register.php">Đăng ký</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>