<?php

@include 'config.php'; // include connection to database

session_start(); //starting a session

$user_id = $_SESSION['user_id']; //retrieving user id and saving it in the session

if (!isset($user_id)) // if it's not set, redirect to login
 {
    header('location:login.php');
}

if (isset($_POST['order']))  //if we retrieve this action from the form
{

    $name = $_POST['name']; //get name and save it
    $number = $_POST['number']; //get number and save it
    $email = $_POST['email']; //get email and save it
    $method = $_POST['method']; //get payment method and save it
    $address = 'Apartament number: ' . $_POST['ap_num'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['zip_code'];  // get address details and save them
    $placed_on = date('D-M-Y'); // set date that it is placed on

    $cart_total = 0;
    $cart_products = array(); // array of products in the cart

    $stmt1 = mysqli_prepare($conn, "SELECT * FROM `cart` WHERE user_id = ?"); // select all the information for the products in cart for a given id
    mysqli_stmt_bind_param($stmt1, "i", $user_id); //an integer will be binded (user id)
    mysqli_stmt_execute($stmt1); // execute the query
    $cart_query = mysqli_stmt_get_result($stmt1); //save the result

    if (mysqli_num_rows($cart_query) > 0) // if there is a result returned (at least one row)
    {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) //fetching each row and saving it
        {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ')'; //adding the name and price of the product to the array
            $sub_total = ($cart_item['price'] * $cart_item['quantity']); // calculating total for an item and saving it
            $cart_total += $sub_total; // calculating total for the whole cart
        }
    }

    $total_products = implode(', ', $cart_products); // converting the $cart_products into a string , each element will be separated with a ','



    //the same logic to retrieve order data based on a user's information
    $stmt2 = mysqli_prepare($conn, "SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
    mysqli_stmt_bind_param($stmt2, "ssssssd", $name, $number, $email, $method, $address, $total_products, $cart_total);
    mysqli_stmt_execute($stmt2);
    $order_query = mysqli_stmt_get_result($stmt2);

    if ($cart_total == 0) {
        $message[] = 'Your cart is empty!';
    } elseif (mysqli_num_rows($order_query) > 0) {
        $message[] = 'Order already placed!';
    } else {
        //inserting an order
        $stmt3 = mysqli_prepare($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt3, "issssssis", $user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on);
        mysqli_stmt_execute($stmt3);

        //clearing the cart for a specific user
        $stmt4 = mysqli_prepare($conn, "DELETE FROM `cart` WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt4, "i", $user_id);
        mysqli_stmt_execute($stmt4);

        $message[] = 'Order placed successfully!';

        mysqli_stmt_close($stmt4);
        mysqli_stmt_close($stmt3);
    }

    mysqli_stmt_close($stmt2);
    mysqli_stmt_close($stmt1);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Checkout </h3>
    <p> <a href="home.php">Home</a> / Checkout </p>
</section>

<section class="display-order">
    <?php
        $grand_total = 0;
        //displaying order data
        $stmt5 = mysqli_prepare($conn, "SELECT * FROM `cart` WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt5, "i", $user_id);
        mysqli_stmt_execute($stmt5);
        $select_cart = mysqli_stmt_get_result($stmt5);
        
        //calculating cart price
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
    ?>    
    <p> 
        <!-- displaying name,price and quantity -->
        <?php echo $fetch_cart['name'] ?> <span>(<?php echo '$' . $fetch_cart['price'] . $fetch_cart['quantity']  ?>)</span> </p> 
    <?php
            }
        } else {
            echo '<p class="empty">Your cart is empty</p>';
        }

        mysqli_stmt_close($stmt5);
    ?>
    <div class="grand-total">Total: <span>$<?php echo $grand_total; ?></span></div>
</section>

<section class="checkout">

    <form action="" method="POST">

        <h3>Placing order</h3>

        <div class="flex">
            <div class="inputBox">
                <span>Your name :</span>
                <input type="text" name="name" required placeholder="Enter your name">
            </div>
            <div class="inputBox">
                <span>Your number :</span>
                <input type="number" name="number" required min="0" placeholder="Enter your number">
            </div>
            <div class="inputBox">
                <span>Your email :</span>
                <input type="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="inputBox">
                <span>Payment method :</span>
                <select name="method">
                    <option value="cash ">Cash </option>
                    <option value="credit card">Credit card</option>
                    <option value="paypal">Paypal</option>
                    <option value="paytm">Paytm</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Apartament number :</span>
                <input type="text" name="ap_num" required placeholder="Apartament number">
            </div>
            <div class="inputBox">
                <span>Street :</span>
                <input type="text" name="street" required placeholder="Street name">
            </div>
            <div class="inputBox">
                <span>City :</span>
                <input type="text" name="city" required placeholder="City">
            </div>
            <div class="inputBox">
                <span>State :</span>
                <input type="text" name="state" required placeholder="State">
            </div>
            <div class="inputBox">
                <span>Country :</span>
                <input type="text" name="country" required placeholder="Country">
            </div>
            <div class="inputBox">
                <span>ZIP code :</span>
                <input type="number" min="0" required name="zip_code" placeholder="">
            </div>
        </div>

        <input type="submit" name="order" value="order now" class="btn">

    </form>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
