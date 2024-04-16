<?php 
include "sql_connection.php";
session_start();
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    $query = connect_to_sql();
    $Execquery = $query->prepare("SELECT * FROM `account_guest` WHERE email = '$email'");
    $Execquery->execute();

    if($Execquery->rowCount() > 0)
    {
        $row = $Execquery->fetch();
        $_SESSION['user_id'] = $row['id'];
        header('location:product.php');
    }
    else
    {
        $message[] = "Sai tài khoản hoặc mật khẩu!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php 

if(isset($message))
{
    foreach($message as $msg)
    {
        echo '<div class="message" onclick = "this.remove();">'.$msg.'</div>';
    }
}

?>

    <div class="form-container">

        <form action ="" method ="post">

            <input type = "email" name = "email" required placeholder="Nhập tài khoản hoặc email" class="box">
            <input type = "password" name = "password" required placeholder="Nhập mật khẩu" class="box">
            <input type = "submit" name = "submit" class = "btn" value = "Đăng nhập">
            <p>Bạn chưa có tài khoản? <a href = "register.php">Đăng ký ngay !</a></p>

        </form>

    </div>

</body>
</html>