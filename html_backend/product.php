<?php
include "database/sql_connection.php";
session_start();
$user_id = $_SESSION['user_id'];
$db = new SQLConnect();
$conn = $db->connect();
$get_product = $conn->prepare("SELECT * FROM `product`");
$get_product->execute();
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
    <link rel="stylesheet" href="product.css">
    <link rel="shortcut icon" href="image/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
        <nav>
            <div class="logo">
                <h1>Gi<span>à</span>y</h1>
            </div>
            <div class="search">
                <form action="search.php" method="post">
                    <input class="box" type="text" name="key" required placeholder="Tìm kiếm gì đó....">
                    <button type="submit" name="search">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
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
            if ($get_product->rowCount() > 0) {
                while ($product = $get_product->fetch()) {
                    ?>
                    <form method="post" class="box" action="">
                    <div class="card">
                        
                            <div class="image">
                                <img src="images/<?php echo $product['image']; ?>" alt="">
                            </div>
                            <div class="products_text">
                                <h2><?php echo $product['name']; ?></h2>
                                <h3><?php echo $product['price']; ?></h3>
                                Số lượng:
                                <input type="number" min="1" name="quantity" value="1"
                                    max="<?php echo $product['quantity']; ?>">
                                <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                                <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
                            </div>
                        
                    </div>
                    </form>
                    <?php
                }
                ;
            }
            ; ?>
        </div>
    </div>
</body>

</html>