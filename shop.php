<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_POST['add_to_wishlist'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_wishlist_numbers) > 0) {
        $message[] = 'Đã thêm vào danh sách yêu thích';
    } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Đã thêm vào giỏ hàng';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'Sản phẩm được thêm vào danh sách mong muốn';
    }
}

if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Đã thêm vào giỏ hàng';
    } else {

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_wishlist_numbers) > 0) {
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Sản phẩm được thêm vào giỏ hàng';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/design.css">

</head>

<body>

    <?php @include 'header.php'; ?>
    <?php @include 'menuleft.php'; ?> 
	<section class="home" id="home" style="padding-top:100px;">
			<div class="content">
            <img src="anhdoan/quangcao.jpg" alt="">
			</div>
		</section>
	
			<!-- Blog section -->
			<section class="blog" id="blog">
				<h1 class="heading"><span>BIG - SALE</span></h1>
				<div class="container">
					<div style="margin-right: 10px;" class="post">
						<div class="blog-img">
							<img src="anhdoan/anh2.jpg" alt="">
							<span>Sale <br> 30%</span>
						</div>
						<div class="blog-content">
							<h3>120.000 VNĐ | <span>200.000VNĐ</span></h3>
							<h1>Combo 2 người</h1>
							<a href="#shop"><button class="btn">Buy Now</button></a>
						</div>
					</div>
                    <div style="margin-right: 10px;" class="post">
						<div class="blog-img">
							<img src="anhdoan/anh2.jpg" alt="">
							<span>Sale <br> 30%</span>
						</div>
						<div class="blog-content">
							<h3>220.000 VNĐ | <span>300.000VNĐ</span></h3>
							<h1>Combo gia đình</h1>
							<a href="#shop"><button class="btn">Buy Now</button></a>
						</div>
					</div>
                </section>
            </div>
            
            <section class="products" id="shop">                
                <section class="heading" style="padding-top:50px;">
                    <h1 class="title" style="font-size: 50px;color: red ;"><span>SHOP BÁN HÀNG</span></h1>
                </section>
        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <form action="" method="POST" class="box">
                        <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>"><img src="./anhdoan/<?php echo $fetch_products['image']; ?>" alt="" class="image"></a>

                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="pprice"><?php echo $fetch_products['price']; ?>.000VNĐ</div>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <input type="submit" value="Thêm yêu thích" name="add_to_wishlist" class="btn" style="padding:2px 10px; background:red;color:white; height: 40px ;width: 200px;   border-radius: 5px; ">
						<br>
                        <input type="submit" value="Thêm giỏ hàng" name="add_to_cart" class="btn" style="padding:2px 10px; background:red;color:white;  height: 40px ;width: 200px;   border-radius: 5px; ">
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>

        </div>

    </section>
	<?php @include 'footer.php'; ?>
	<script src="script.js"></script>
	<script src="jvscript.js"></script>
    </body>

</html>