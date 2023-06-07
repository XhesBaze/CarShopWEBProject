<?php

@include 'config.php';

session_start();

//saves user id in the session
$user_id = $_SESSION['user_id'];

//if user id is not set, it redirects to login page
if(!isset($user_id)){
   header('location:login.php');
};

//if delete option is retrieved from the form, do the following actions
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
 //redirects to cart page
    header('location:cart.php');
}

//if delete all is selected
if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

//if update quantity is selected
if(isset($_POST['update_quantity'])){
    //it saves the id for the cart it wants to update
    $cart_id = $_POST['cart_id'];
    //takes the quantity that it is being updated to 
    $cart_quantity = $_POST['cart_quantity'];
    //creates query and updates cart
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>shopping cart</h3>
    <p> <a href="home.php">home</a> / cart </p>
</section>

<section class="shopping-cart">

    <h1 class="title">products added</h1>

    <div class="box-container">

    <?php
    //calculates total price
        $grand_total = 0;
        //selects everything from cart and if there is anything, it returns them
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
    ?>
    <div  class="box">
        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
        <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
        <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="" class="image">
        <div class="name"><?php echo $fetch_cart['name']; ?></div>
        <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>
        <form action="" method="post">
            <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
            <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="qty">
            <input type="submit" value="update" class="option-btn" name="update_quantity">
        </form>
        <div class="sub-total"> sub-total : <span>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
    </div>
    <?php
    $grand_total += $sub_total;
        }
    }else{
        echo '<p class="empty">your cart is empty</p>';
    }
    ?>
    </div>

    <div class="more-btn">
        <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('delete all from cart?');">delete all</a>
    </div>

    <div class="cart-total">
        <p>grand total : <span>$<?php echo $grand_total; ?>/-</span></p>
        <!--continue shopping button-->
        <a href="shop.php" class="option-btn">continue shopping</a>
        <!--proceed to check out button-->
        <a href="checkout.php" class="btn  <?php echo ($grand_total > 1)?'':'disabled' ?>">proceed to checkout</a>
    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>