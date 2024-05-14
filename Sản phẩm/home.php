<?php
include "database/sql_connection.php";
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop bán giày đẹp nhất VN</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
/>
</head>

<body>
    <section>
        <nav>
            <div class="logo">
                <h1>Gi<span>à</span>y</h1>
            </div>

            <ul>
                <li><a href="home.php">Trang chủ</a></li>
                <li><a href="product.php">Sản phẩm</a></li>
                <li><a href="user.php">Tài khoản</a></li>
                <li><a href="cart.php">Giỏ hàng</a></li>
            </ul>

            <div class="icons">
                <i class="fa-solid fa-heart"></i>
                <i class="fa-solid fa-cart-shopping"></i>
                <i class="fa-solid fa-user"></i>
            </div>

        </nav>
        <div class="main" id="Home">
            <div class="main_content">
                <div class="main_text">
                    <h1>NIKE<br><span>Collection</span></h1>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                        been the industry's standard dummy text ever since the 1500s, when an unknown printer took
                        a galley of type and scrambled it to make a type specimen book. It has survived not only
                        five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                </div>
                <div class="main_image">
                    <img src="images/shoes.png" width="300" height="500">
                </div>
            </div>
            <div class="social_icon">
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
            </div>
            <div class="button">
                <a href="product.php">MUA NGAY</a>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </div>
    </section>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message" onclick = "this.remove();">' . $msg . '</div>';
        }
    }
    ?>
    <div class="products" id="Products">
        <h1>Sản phẩm</h1>
        <div class="box">
            <?php
            $db = new SQLConnect();
            $conn = $db->connect();
            $get_product = $conn->prepare("SELECT * FROM `product` LIMIT 8");
            $get_product->execute();
            if ($get_product->rowCount() > 0) {
                while ($product = $get_product->fetch()) {
                    ?>
                    <form method="post" class="box" action="">
                        <div class="card">
                            <div class="image">
                                <img src="images/<?php echo $product['image']; ?>" alt="" width="300" height="170">
                            </div>
                            <div class="products_text">
                                <h2><?php echo $product['name']; ?></h2>
                                <h3><?php echo number_format($product['price']); ?> $</h3>
                                <a href="product.php" class="btn">MUA</a>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ;
            }
            ;
            ?>
        </div>

    </div>

</body>

</html>