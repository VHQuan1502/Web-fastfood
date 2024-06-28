<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_POST['order'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if ($cart_total == 0) {
        $message[] = 'your cart is empty!';
    } elseif (mysqli_num_rows($order_query) > 0) {
        $message[] = 'order placed already!';
    } else {
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'order placed successfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/design.css">

</head>

<body>

    <?php @include 'header.php'; ?>
	<?php @include 'menuleft.php'; ?> 
    <section class="heading" style="padding-top:50px; margin-top: 100px">
        <h3>Đặt hàng</h3>
    </section>

    <section class="display-order">
        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
        ?>
		        
                <p><img style="width: 110px;margin-right:30px" src="anhdoan/<?php echo $fetch_cart['image']; ?>" alt="" class="image"><?php echo $fetch_cart['name'] ?> <br> <span><?php echo 'Đơn giá :' . $fetch_cart['price'] . '.000VNĐ' .'<br>'. ' Số lượng : ' . $fetch_cart['quantity']  ?></span> </p>
        <?php
            }
        } else {
            echo '<p class="empty">your cart is empty</p>';
        }
        ?>
        
    </section>
	
    <section class="checkout">
		
		<form action="" method="POST">
			
			<h3>Đơn hàng của bạn</h3>
			<h3 style="background-color:pink; color : black;"><div class="grand-total">Tổng tiền : <span><?php echo $grand_total; ?>.000VNĐ</span></div></h3>
            <div class="flex">
                <div class="inputBox">
                    <span>Tên của bạn :</span>
                    <input type="text" name="name" placeholder="Thông tin tên">
                </div>
                <div class="inputBox">
                    <span>Số của bạn :</span>
                    <input type="number" name="number" min="0" placeholder="Thông tin số điện thoại">
                </div>
                <div class="inputBox">
                    <span>Email của bạn :</span>
                    <input type="email" name="email" placeholder="Thông tin email">
                </div>
                <div class="inputBox">
                    <span>Phương thức thanh toán:</span>
                    <select name="method">
                        <option value="cash on delivery">Thanh toán giao hàng</option>
                        <option value="credit card">Thẻ tín dụng</option>
                        <option value="paypal">paypal</option>
                        <option value="paytm">Thanh toán</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Địa chỉ 01 :</span>
                    <input type="text" name="flat" placeholder="Ví dụ tên căn hộ">
                </div>
                <div class="inputBox">
                    <span>Địa chỉ 02 :</span>
                    <input type="text" name="street" placeholder="Ví dụ tên đường">
                </div>
                <div class="inputBox">
                    <span>Thành phố :</span>
                    <input type="text" name="city" placeholder="ví dụ như Hà Nội">
                </div>
                <div class="inputBox">
                    <span>Quốc gia :</span>
                    <input type="text" name="country" placeholder="Ví dụ như Việt Nam">
                </div>
            </div>
			
			<input type="submit" name="order" value="Đặt hàng ngay" class="btn">
        </form>

    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>