<?php
include "sql_connection.php";
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id))
{
    header("location:login.php");
}
if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header("location:login.php");
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop bán giày</title>
</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message" onclick = "this.remove();">' . $msg . '</div>';
        }
    }

    ?>

    <div class="container">

        <div class="user-profile">

            <?php
            $conn = connect_to_sql();
            $get_user = $conn->prepare("SELECT * FROM `account_guest` WHERE id = '$user_id'");
            $get_user->execute();
            if ($get_user->rowCount() > 0) {
                $user = $get_user->fetch();
            }
            ;
            ?>
            <p> username: <span>
                    <?php echo $user['name']; ?> 
                </span></p>
            <p> email: <span>
                    <?php echo $user['email']; ?> 
                </span>
            <div class="flex">
                <div class="flex">
                    <a href="login.php" class="btn">Đăng nhập</a>
                    <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Bạn muốn đăng xuất?');"
                        class="delete-btn">Đăng xuất</a>
                </div>
            </div>
        </div>

    </div>

</body>

</html>