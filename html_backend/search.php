<?php 
if(isset($_POST['search'])){
    $key = $_POST['word'];
}
$db = new SQLConnect();
$conn = $db->connect();
$get_product = $conn->prepare("SELECT * FROM `product` WHERE name LIKE '%".$key."%'");
$get_product->execute();
while ($product = $get_product->fetch()) {
       
    ?>    
            <form method="post" class="box" action="">
                <img src="images/<?php echo $product['image']; ?>" alt="" width="200" height="200">
                <div class="name"><?php echo $product['name']; ?></div>
                <div class="price"><?php echo $product['price']; ?></div>
                <input type="number" min="1" name="quantity" value="1" 
                max="<?php echo $product['quantity']; ?>">
                <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
            </form>
    <?php
};
?>