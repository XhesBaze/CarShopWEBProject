<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>
<?php @include 'chatbox.php';?>

<section class="heading">
    <h3>Your orders</h3>
</section>

<section class="placed-orders">

    <h1 class="title">Placed orders</h1>

    <div class="box-container">

    <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('Query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
    <div class="box">
        <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
        <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
        <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
        <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
        <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
        <p> Total price : <span>$<?php echo $fetch_orders['total_price']; ?></span> </p>

    </div>
    <?php
        }
    }else{
        echo '<p class="empty">No orders placed yet!</p>';
    }
    ?>
    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
