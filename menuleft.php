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
<div class="menu-left">		
			<a href="home.php">Trang chủ</a>
			<a href="shop.php">Shop</a>
			<a href="about.php">ABOUT</a>
			<a href="cart.php">Giỏ Hàng</a>
			<a href="search_page.php">Tìm kiếm</a>
			<a href="contact.php">Liên hệ</a>
</div>