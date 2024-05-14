<?php
include "database/sql_connection.php";
session_start();
$db = new SQLConnect();
$conn = $db->connect();
$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $product_id = $_POST['id'];
    $image = $_POST['image'];

    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE product_id = '$product_id'
    AND user_id = '$user_id' AND product_name = '$name'");
    $select_cart->execute();
    if ($select_cart->rowCount() > 0) {
        $message[] = 'Sản phẩm đã có trong giỏ hàng!';

    } else {
        $conn->exec("INSERT INTO `cart` (user_id,product_name,product_id,price,quantity,image) 
        VALUES ('$user_id','$name','$product_id','$price','$quantity','$image')");
        $message[] = 'Đã thêm sản phẩm vào giỏ !';
    }
    header("location:product.php");
}
;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <nav>
        <div class="logo">
            <h1>Gi<span>à</span>y</h1>
        </div>
        <form action="search.php" method="post">
            <div class="search">
                <input class="box" type="text" name="key" required placeholder="Tìm kiếm gì đó....">
                <button type="submit" name="search"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul>
            <li><a href="home.php">Trang chủ</a></li>
            <li><a href="product.php">Sản phẩm</a></li>
            <li><a href="user.php">Tài khoản</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
        </ul>
    </nav>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message" onclick = "this.remove();">' . $msg . '</div>';
        }
    }
    ?>
    <div class="products">
        <h1>Sản phẩm</h1>
        <div class="box">
            <?php
            if (isset($_POST['search'])) {
                $keyword = $_POST['key'];
                $get_product_from_key = $conn->prepare("SELECT * FROM `product` WHERE name LIKE '%" . $keyword . "%'");
                $get_product_from_key->execute();
                if ($get_product_from_key->rowCount() > 0) {
                    while ($product_from_key = $get_product_from_key->fetch()) {
                        ?>
                        <form method="post" class="box" action="">
                            <div class="card">

                                <div class="image">
                                    <img src="images/<?php echo $product_from_key['image']; ?>" alt="" width="200" height="170">
                                </div>
                                <div class="products_text">
                                    <h2><?php echo $product_from_key['name']; ?></h2>
                                    <h3><?php echo number_format($product_from_key['price']); ?> $</h3>
                                    Số lượng:
                                    <input type="number" min="1" name="quantity" value="1"
                                        max="<?php echo $product_from_key['quantity']; ?>">
                                    <input type="hidden" name="image" value="<?php echo $product_from_key['image']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $product_from_key['name']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $product_from_key['price']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $product_from_key['id']; ?>">
                                    <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
                                </div>

                            </div>
                        </form>
                        <?php
                    }
                    ;
                }
                ;
            }
            ;
            ?>
        </div>
    </div>
</body>

</html>