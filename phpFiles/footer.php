<?php
@include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $select_subscription= mysqli_query($conn, "SELECT * FROM `subscribe` WHERE name = '$name' AND email = '$email' ") or die('Query failed');

    if(mysqli_num_rows($select_subscription) > 0){
        $subscriber[] = 'Subscriber saved already!';
    }else{
        mysqli_query($conn, "INSERT INTO `subscribe`(user_id, name, email) VALUES('$user_id', '$name', '$email')") or die('Query failed');
        $subscriber[] = 'Thanks for subscribing to our newsletter!:)';
    }

}

?>

<section class="footer">

    <div class="box-container">
        <div class="box">
            <h3>Visit these:  </h3>
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="shop.php">Shop</a>
        </div>
        <div class="box">
            <h3>Your links:</h3>
            <a href="login.php">Login here</a>
            <a href="logout.php">Logout here</a>
            <a href="orders.php">My Orders</a>
            <a href="cart.php">My Cart</a>
        </div>
        <div class="box">
            <h3>Contact us!</h3>
            <p> <i class="fas fa-phone"></i> 0691213134 </p>
             <a href="#"><i class="fab fa-instagram"></i>Instagram</a>
            <a href="#"> <i class="fas fa-envelope"></i> onthego@gmail.com </a>
            <p> <i class="fas fa-map-marker-alt"></i> Tirana, Albania </p>
        </div>
        <div class="box"><p> <form action="" method="POST">
        <h3 class="newsletter">Subscribe to our newsletter:</h3>
        <input class="newsletter" type="text" name="name" placeholder="Enter your name" class="box" required> 
        <input class="newsletter" type="email" name="email" placeholder="Enter your email" class="box" required><br>
        <input type="submit" value="subscribed" name="send" class="btn">
</form>
    </div>
    <div>
    <h3 class="rights">
All rights reserved @OnMyWay
</h3></div>
</section>
