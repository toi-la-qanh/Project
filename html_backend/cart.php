<?php

//if(isset($_GET["function"]))

if (isset ($_POST["product_id"], $_POST["quantity"]) && is_string("product_id") && is_numeric("quantity")) {
    $product_id = (string) $_POST["product_id"];//get product id
    $quantity = (int) $_POST["quantity"];//get quantity

    //get data from sql (pdo -> support sql)
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');//unnamed placeholder
    $stmt->execute([$_POST['product_id']]);//place to id = product_id
    $product_id = $stmt->fetch(PDO::FETCH_ASSOC);//fetch product from sql and return as array

    if ($product_id && $quantity > 0) {
        if (isset ($_SESSION['cart']) && is_array(['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart']))//product exist in cart
            {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;//add product to cart
            }
        } else {
            $_SESSION['cart'] = array($product_id => $quantity);//list the cart
        }
    }
}


if (isset ($_GET['remove']) && is_string($_GET['remove']) && isset ($_SESSION['cart']) && isset ($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}


?>