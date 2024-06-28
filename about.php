<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web bán thức ăn </title>
    <link rel="stylesheet" href="css/about.css">
</head>

<body>


    <div id="wrapper">
        <div id="header">
            <a href="" class="logo">
                <img src="anh/logo.png" alt="">
            </a>
            <div id="menu">
                <div class="item">
                    <a href="home.php">Trang chủ</a>
                </div>
                <div class="item">
                    <a href="shop.php">Sản phẩm</a>
                </div>
                <div class="item">
                    <a href="">Liên hệ</a>
                </div>
            </div>

        </div>
        <div id="banner">
				<div class="anh">
					<img src="anhdoan/about.jpg" alt="">
				</div>
                <div class="box-left">
				<h2>
                    <span>THỨC ĂN</span>
                    <br>
                    <span>THƯỢNG HẠNG</span>
                </h2>
                <p>Chuyên cung cấp các món ăn đảm bảo dinh dưỡng
                    hợp vệ sinh đến người dùng,phục vụ người dùng 1 cái
                    hoàn hảo nhất</p>
                <a href="shop.php"><button>Mua ngay</button></a>
				</div>
        </div>
        <div id="wp-products">
            <h2>NHÀ SÁNG LẬP</h2>
            <ul id="list-products">
                <div class="item">
                    <img style="width: 200px;" src="anhdoan/minhvan.jpg" alt="">
                    <div class="stars">
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                    </div>

                    <div class="name">Nguyễn Minh Văn</div>

                </div>


                <div class="item">
                    <img style="width: 200px;" src="anhdoan/vuhongquan.jpg" alt="">
                    <div class="stars">
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                    </div>

                    <div class="name">Vũ Hồng Quân</div>

                </div>


                <div class="item">
                    <img style="width: 200px;" src="anhdoan/tienthanh.jpg" alt="">
                    <div class="stars">
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                        <span>
                            <img src="anhdoan/star.png" alt="">
                        </span>
                    </div>

                    <div class="name">Đặng Tiến Thành</div>

                </div>

            </ul>
        </div>

        <div id="saleoff">
            <div class="box-left">
                <h1>
                    <span>GIẢM GIÁ LÊN ĐẾN</span>
                    <span>45%</span>
                </h1>
            </div>
            <div class="box-right"></div>
        </div>

        <div id="comment">
            <h2>MỤC TIÊU</h2>
            <div id="comment-body">
                <ul id="list-comment">
                    <li class="item">
                        <div class="avatar">
                            <img src="anh/avatar_1.png" alt="">

                        </div>
                        <div class="stars">
                            <span>
                                <img src="anhdoan/star.png" alt="">
                            </span>
                            <span>
                                <img src="anhdoan/star.png" alt="">
                            </span>
                            <span>
                                <img src="anhdoan/star.png" alt="">
                            </span>
                            <span>
                                <img src="anhdoan/star.png" alt="">
                            </span>
                            <span>
                                <img src="anhdoan/star.png" alt="">
                            </span>
                        </div>
                        <div class="name">QVT-fastfood</div>

                        <div class="text">
                            <p><center>Mang đến cho khách hàng những sản phẩm đảm bảo an toàn vệ sinh thực phẩm <br>
						               Mang đến cho khách hàng những sản phẩm tốt nhất với giá cả tốt nhất <br><br>
									   Hãy đến với chúng tôi để nhận nhưng ưu đãi tốt nhất</center></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

	<!-- cuối trang -->
	<?php @include 'footer.php'; ?>
	<script src="jv/about.js"></script>
</body>

</html>