<?php
//include "index.php";
    function add_to_cart() {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $image = $_POST['image'];
        $conn = connect_to_sql();
        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE name = '$name' AND user_id = '' ");
        $select_cart->execute();
    }
    function remove_from_cart() {

    }
?>