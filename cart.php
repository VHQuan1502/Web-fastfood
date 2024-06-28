<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/design.css">

</head>

<body>
<?php @include 'header.php'; ?>
<?php @include 'menuleft.php'; ?> 

<section class="heading" style="padding-top:50px;margin-top: 100px;margin-bottom: 50px;">
        <h3>Giỏ hàng</h3>
    </section>
    <section class="shopping-cart">

        <h1 class="title">Sản phẩm đã thêm</h1>

        <div class="box-container">

        <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
                    <div class="box">
                        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
                        <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>"><img src="anhdoan/<?php echo $fetch_cart['image']; ?>" alt="" class="image"></a>                       
                        <div class="name"><?php echo $fetch_cart['name']; ?></div>
                        <div class="pprice"><?php echo $fetch_cart['price']; ?>.000VNĐ</div>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                            <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="qty">
                            <input style="padding:2px 10px; background:red;color:white; height: ; padding:8px 5px; margin: 5px 2px ;width: 200px;   border-radius: 5px; " type="submit" value="Cập nhật" class="option-btn" name="update_quantity">
                        </form>
                        <div class="cart-total">
                            <div class="sub-total"> Tổng tiền : <span><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>.000VNĐ</span> </div>
                        </div>
                    </div>
            <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">Không có sản phẩm ở giỏ hàng</p>';
            }
            ?>
        </div>

        <div class="more-btn">
            
        </div>

        <div class="cart-total" style="margin-bottom:50px"> 
            <a style="padding:2px 10px; background:red;color:white; height: ; padding:8px 5px; margin: 5px 2px ;width: 200px;   border-radius: 5px; font-size:20px " href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled' ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?');">Xoá tất cả</a>
            <a style="padding:2px 10px; background:red;color:white; height: ; padding:8px 5px; margin: 5px 2px ;width: 200px;   border-radius: 5px; font-size:20px" href="shop.php" class="option-btn">Tiếp tục mua hàng</a>
            <a style="padding:2px 10px; background:red;color:white; height: ; padding:8px 5px; margin: 5px 2px ;width: 200px;   border-radius: 5px; font-size:20px" href="thanhtoan.php" class="btn  <?php echo ($grand_total > 1) ? '' : 'disabled' ?>">Thanh toán</a>
        </div>

    </section>
    <?php @include 'footer.php'; ?>
	<script src="js/jvscript.js"></script>
    <script src="js/script.js"></script>

</body>

</html>