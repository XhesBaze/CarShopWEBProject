<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

//checking if the user id is set in the session and if not the user will be directed to login.php page
if(!isset($user_id)){
   header('location:login.php');
}

//checking if the form add to cart is submitted and if so 
if(isset($_POST['add_to_cart'])){
//retrieving product details.
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

   //selecting a product from the cart table with a given name and user id
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   //checking if a product exists in the cart table and if so 
   //, it adds a message indicating that it is already added to the cart.
    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{
      //getting a specific product with specific name and user id by quering the database
        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
    
       //checking if the specific product exists in the wishlist table and if so 
        if(mysqli_num_rows($check_wishlist_numbers) > 0){
           //deleting the product from wishlist table 
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }
//inserting a product with specific details and a message will be assigned to message array
        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }

}

//checking if the url contains a parameter named delete
if(isset($_GET['delete'])){
   //assigning the value of parameter delete to delete id variable
    $delete_id = $_GET['delete'];
   //deleting the product from the wishlist table 
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
   //redirecting the user to wishlist.php page.
    header('location:wishlist.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
    header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>wishlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Your wishlist</h3>
    <p> <a href="Home.php">home</a> / Wishlist </p>
</section>

<section class="wishlist">

    <h1 class="title">Products added</h1>

    <div class="box-container">

    <?php
       //assigning the total to 0 firstly 
        $grand_total = 0;
       //retrieving the rows from the wishlist table ind the database 
        $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
       //checking if there any rows returned from the select query and if so 
        if(mysqli_num_rows($select_wishlist) > 0){
           //fetching the wishlist item from the database for a specific user and iterates over each item. 
            while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
    ?>
    <form action="" method="POST" class="box">
       //generating a link and when clicked prompts the user for confirmation and then navigates to the
       //"wishlist.php" page with the "delete" parameter containing the appropriate value for deleting a specific wishlist item.
        <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from wishlist?');"></a>
        <a href="view_page.php?pid=<?php echo $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
        <img src="uploaded_img/<?php echo $fetch_wishlist['image']; ?>" alt="" class="image">
        <div class="name"><?php echo $fetch_wishlist['name']; ?></div>
        <div class="price">$<?php echo $fetch_wishlist['price']; ?>/-</div>
        <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['pid']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">
        <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
        
    </form>
    <?php
       //calculating the overall total  by accumulating the prices of wishlist items.
    $grand_total += $fetch_wishlist['price'];
        }
    }else{
        echo '<p class="empty">your wishlist is empty</p>';
    }
    ?>
    </div>

    <div class="wishlist-total">
       //display a paragraph that shows the label total followed by the
       //total value
       <p>Total : <span>$<?php echo $grand_total; ?>/-</span></p>
        <a href="shop.php" class="option-btn">Continue shopping</a>
       //generating a link that will prompt the user for confirmation to delete all wishlist item
       //actual deletion action is handled by the wishlist.php page
        <a href="wishlist.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('Delete all from wishlist?');">Delete all</a>
    </div>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
