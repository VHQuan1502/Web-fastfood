<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_POST['send'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if (mysqli_num_rows($select_message) > 0) {
        $message[] = 'message sent already!';
    } else {
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'message sent successfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/design.css">

</head>

<body>

    <?php @include 'header.php'; ?>
    <?php @include 'menuleft.php'; ?>
    <section class="heading" style="padding-top:50px; margin-top: 100px;">
        <p style="font-size:50px;"> <a href="home.php"><i class="fa-solid fa-house"></i></a>    |    <i class="fa-solid fa-phone"></i>  0399431525</p>
    </section>

    <section class="contact">

        <form action="" method="POST" style="margin-top:50px; margin-bottom:50px">
            <h3>Viết phản hồi</h3>
            <input type="text" name="name" placeholder="Tên Kháchh Hàng" class="box" required>
            <input type="email" name="email" placeholder="Email" class="box" required>
            <input type="text" name="number" placeholder="Số điện thoạt" class="box" required>
            <textarea name="message" class="box" placeholder="Nội dung Tin Nhắn" required cols="30" rows="10"></textarea>
            <input type="submit" value="Gửi phản hồi" name="send" class="btn">
        </form>

    </section>






    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>