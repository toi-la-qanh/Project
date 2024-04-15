<?php 
include "sql_connection.php";
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $name = $_POST['name'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];
    
    $query = connect_to_sql();
    $Execquery = $query->prepare("SELECT * FROM `account_guest` WHERE name = '$name' 
    AND password = '$pass' AND email = '$email'");
    $Execquery->execute();

    if($Execquery->rowCount() > 0)
    {
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
    <title>Register</title>
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

            <input type="text" name = "name" required placeholder="Nhập tài khoản" class="box">
            <input type="password" name = "password" required placeholder="Nhập mật khẩu" class="box">
            <input type="password" name = "confirm_password" required placeholder="Xác nhận mật khẩu" class="box">
            <input type="email" name = "email" required placeholder="Nhập email" class="box">
            <input type = "submit" name = "submit" class = "btn" value = "Đăng ký">
            <p>Bạn đã có tài khoản rồi? <a href = "index.php">Đăng nhập ngay !</a></p>

        </form>

    </div>

</body>
</html>