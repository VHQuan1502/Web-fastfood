<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['add_to_wishlist'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];

   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_wishlist_numbers) > 0) {
      $message[] = 'Đã thêm vào danh sách mong muốn';
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
	<title>BÁN ĐỒ ĂN NHANH</title>
	<link rel="stylesheet" href="css/design.css">
	<!-- <link rel="stylesheet" href="style.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <?php @include 'header.php'; ?>
    
    <div class="content grid_row app_content">      
       <!-- SECTION ONE -->
       <section class="home" id="home">
          <div class="content">
             <h3>QVT - fastfood</h3>
             <p>Nhóm hello everyone</p>
             <a href="shop.php" class="btn">BUY NOW</a>
            </div>
            <div class="video-container">
               <video src="anhdoan/Clip intro đồ ăn tại quán.webm" id="video-slider" loop autoplay muted></video>
            </div>
            
         </section>
         <section class="blog" id="blog">
            <h1 class="heading"><span>SHOP</span></h1>
            <?php @include 'menuleft.php'; ?>            
            <section>
               
	<section class="products">
<div class="box-container">
   <?php
   $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 8") or die('query failed');
   if (mysqli_num_rows($select_products) > 0) {
	  while ($fetch_products = mysqli_fetch_assoc($select_products)) {
   ?>
		 <form action="" method="POST" class="box">
			<a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>"><img src="./anhdoan/<?php echo $fetch_products['image']; ?>" alt="" class="image"></a>			
			<div class="name"><?php echo $fetch_products['name']; ?></div>
			<div class="pprice"><?php echo $fetch_products['price']; ?>.000VNĐ</div>
			<input type="number" name="product_quantity" value="1" min="0" class="qty">
			<input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
			<input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
			<input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
			<input type="submit" value="Thêm yêu thích" name="add_to_wishlist" style="padding:2px 10px; background:red;color:white; height: 40px ;width: 200px;   border-radius: 5px; margin-bottom: 10px">
			<input type="submit" value="Thêm giỏ hàng" name="add_to_cart" style="padding:2px 10px; background:red;color:white; height: 40px ;width: 200px;   border-radius: 5px; ">
		 </form>
   <?php
	  }
   } else {
	  echo '<p class="empty">no products added yet!</p>';
   }
   ?>

</div>

<div class="more-btn" style ="margin-bottom:50px">
     <a style =" margin-left: 700px ;" href="shop.php" class="btn"><button style="padding:2px 10px; background:red;color:white; height: 40px ;width: 200px;   border-radius: 5px;">XEM THÊM</button></a>
</div>

</section>

	<!-- cuối trang -->
	<?php @include 'footer.php'; ?>
	<script src="jv/script.js"></script>
	<script src="jv/jvscript.js"></script>
</body>

</html>