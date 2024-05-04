<?php
    include "database/sql_connection.php";
    $db = new SQLConnect();
    $conn = $db->connect();
    $query = $conn->prepare("SELECT name, email FROM `account_guest`"); 
    $query->execute();
    if ($query->rowCount() > 0) {
        $user = $query->fetch();
    };
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản</title>
</head>

<body>
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