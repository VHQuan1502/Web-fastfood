-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 11, 2023 lúc 07:53 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(129, 14, 16, 'Xúc xích', 13, 1, 'lavendor rose.jpg'),
(130, 14, 18, 'Bánh mì ', 11, 1, 'red tulipa.jpg'),
(131, 14, 15, 'Pizza', 15, 1, 'cottage rose.jpg'),
(132, 15, 13, 'Hamberger', 10, 1, 'pink roses.jpg'),
(145, 16, 13, 'Xúc xích', 15, 1, 'buger.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(13, 14, 'shaikh anas', 'shaikh@gmail.com', '0987654321', 'hi, how are you?');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(17, 14, 'shaikh anas', '0987654321', 'shaikh@gmail.com', 'credit card', 'flat no. 321, jogeshwari, mumbai, india - 654321', ', cottage rose (3) , pink bouquet (1) , yellow queen rose (1) ', 80, '11-Mar-2022', 'pending'),
(18, 14, 'shaikh anas', '1234567899', 'shaikh@gmail.com', 'paypal', 'flat no. 321, jogeshwari, mumbai, india - 654321', ', yellow queen rose (1) , pink rose (2) ', 40, '11-Mar-2022', 'completed');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image`) VALUES
(2, 'Thịt nướng ', 'Thịt nướng được làm từ thịt lợn tươi sống ', 30, 'thitnuong.jpg'),
(3, 'Thịt bò khô', 'Được làm 100% từ bò tự nhiên ', 100, 'bokho.jpg'),
(5, 'Xúc xích bò ', 'Xúc xích bò được làm từ thự bò tự nhiên , không có chất phẩm màu ', 12, 'Xúc-xích.jpg'),
(13, 'Xúc xích heo', 'Xúc xích thơm ngon bổ dưỡng ', 15, 'Xúc-xích.jpg'),
(15, 'Trứng muối', 'Trứng muối thơm ngon bổ dưỡng ', 10, 'product_2.png'),
(16, 'Bánh Bao', 'Thơm ngon bỗ dưỡng ', 13, 'banhbao.jpg'),
(17, 'Pizza\r\n', 'Giá cả ưu đãi , chất lượng cao ', 40, 'banhmi.jpg'),
(18, 'Hamberger', 'Bánh Burger ngon tuyệt vời ', 30, 'buger.jpg'),
(19, 'Trà sửa', 'Trả sửa có nhiều vị ngon , ngọt , hấp dẫn và đang có ưu đãi cáo', 45, 'trà sửa.jpg'),
(20, 'Trà chanh', 'Mát lạnh sảng khoái', 10, 'product_1.png'),
(30, 'Thịt chiên', 'Được làm từ thịt lợn nguyên chất ', 55, 'thitchien.jpg'),
(31, 'Bim Bim oshi', 'Bim bim đến từ nhà sản xuất uy tín', 5, 'Bimbimoshi.jpg'),
(32, 'Cocacola', 'Coca đến từ nhà sản xuất uy tín', 10, 'coca.jpg'),
(35, 'Nước ngọt c2', 'C2 đến từ nhà sản xuất uy tín', 10, 'c2.jpg'),
(38, 'Combo 2 người', 'Tiết kiệm hơn ', 120, 'anh2.jpg'),
(39, 'Combo gia đình ', 'Gắn kết yêu thương , tiết kiệm thật nhiều ', 300, 'anh1.jpg'),
(40, 'Bánh tráng trộn', 'Được đảm bảo an toàn vệ sinh thực thẩm ', 25, 'banhtrangtron.jpg'),
(41, 'Bánh trôi nước', 'Được đảm bảo an toàn vệ sinh thực phẩm ', 30, 'banhtroi.jpg'),
(42, 'Bánh trôi ngủ sắc', 'Đảm bảo an toàn vệ sinh thực phẩm ', 50, 'banhtroingumau.jpg'),
(43, 'Bánh tráng nướng', 'Đảm bảo an toàn vệ sinh thực phẩm ', 25, 'banhtrangnuong.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(10, 'admin A', 'admin01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'admin'),
(14, 'user A', 'user01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(15, 'user B', 'user02@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(16, 'vuhongquan1502', 'hongquanhero@gmail.com', 'e4dc7effd3b596f0e0749c7a7a69b3a5', 'user'),
(17, 'Nguyễn Minh Văn', 'vanhero@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
