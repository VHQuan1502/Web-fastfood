<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>
<header class="header">

<div><i class="fa-solid fa-bars" id="menu-bar"></i></div>

<a href="home.php" class="logo"><span>QVT</span>fastfood</a>

<nav class="navbar">
	<a href="home.php">Trang chủ</a>
	<a href="shop.php">Shop</a>
	<a href="#blog">BIG_SALE</a>
	<a href="about.php">ABOUT</a>
	<a href="order.php">Đơn Hàng</a>
</nav>
<div class="flex">
<div class="icons">
	<a href="search_page.php"><i class="fa-solid fa-magnifying-glass" id="search-btn"></i></a>
	<div id="user-btn" class="fas fa-user"></div>
	<?php
            $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
            $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span><?php echo $wishlist_num_rows; ?></span></a>
            <?php
            $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span><?php echo $cart_num_rows; ?></span></a>
    </div>
        <div class="account-box">
            <p>tên người dùng : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn"><button style="background-color: red ;width: 200px ;height: 50px;">Đăng xuất</button></a>
        </div>
</div>
</div>
	<nav class="navbar">
		<a href="login.php">Tài Khoản</a>
        <p style = "color :red;">tên người dùng : <span><?php echo $_SESSION['user_name']; ?></span></p>
	</nav>
</div>

</header>