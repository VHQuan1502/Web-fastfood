<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$name' AND password = '$pass'") or die('query failed');


   if (mysqli_num_rows($select_users) > 0) {

      $row = mysqli_fetch_assoc($select_users);

      if ($row['user_type'] == 'admin') {

         $_SESSION['admin_name'] = $row['name'];
         // $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
      } elseif ($row['user_type'] == 'user') {

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
      } else {
         $message[] = 'no user found!';
      }
   } else {
      $message[] = 'incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/login.css">

</head>

<body>

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
      <section class="form-container">
         <form action="" method="post">
            <h3 class="dn-btn" id="dn-dn-btn">Đăng nhập</h3>
            <h4 class="td-btn">Tài khoản </h4>
            <input class="formnhap" type="text" name="name" class="box" placeholder="Nhập name" required> <br><br><br><br>
            <h4 class="td-btn">Mật khẩu</h4>
            <input class="formnhap" type="password" name="pass" class="box" placeholder="Nhập password" required><br><br><br><br>
            <input class="sub-btn"  type="submit" class="btn" name="submit" value="Đăng nhập"> <br>
            <p class="qmk-btn">Quên mật khẩu</p>
            <p>Bạn đã có tài khoản QVT chưa? <a href="register.php">Đăng ký ngay</a></p>
         </form>
   
      </section>

</body>

</html>