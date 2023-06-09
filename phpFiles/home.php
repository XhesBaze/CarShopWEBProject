<?php

//includes the config.php files , containing the database connection details 
@include 'config.php';

//starting a session to manage user session data
session_start();

//retrieves the user id from the session data
$user_id = $_SESSION['user_id'];

//checking if the user id is not in the set in the session and if not loged in  redirecting to the login.php page
if(!isset($user_id)){
   header('location:login.php');
}

//checking if the form with the name "add_to_wishlist" has been submitted.
if(isset($_POST['add_to_wishlist'])){

   //retrieving product id, name, price and image
   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   //query selecting records from the wishlist table with the specified product name and user id.
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   //query selecting records from cart table that mtaches the specific product name and the user id
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   
  //checking if there is at least one row in the result set (wishlist table)
   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'already added to wishlist';
      //checking if there is at least one row in the result set in cart table
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{
      //inseting products into wishlist table with specific user id , product id , name , price and image.
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
      //a success mesage will be assigned to message array 
      $message[] = 'product added to wishlist';
   }

}

//checking if the add to cart has been submitted via the HTTP post method
if(isset($_POST['add_to_cart'])){
//retrieving product details , id, name, price, image, quantity.
   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   //selecting from the cart table the product with the specific given name and user id.
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   
   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="home">
div class="content">
      <h3>Welcome to OnTheGo!</h3>
      <p>Discover your dream ride at our one-stop destination for all your automotive needs. Our dedicated team is committed to providing exceptional service, 
         ensuring that you find the perfect car that matches your style and exceeds your expectations. Start your journey with us today and experience the thrill 
         of driving in style and luxury!
      </p>
      <a href=" " class="btn">Discover more</a>
   </div>

</section>
   

<section class="products">What We Offer /h1>

   <div class="box-container">

      <?php
      //query that selecting the first 6 rows from the product table
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
      //checking if there are any rows returned by the query and if so then we can access the data by using the fetch _products
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

   </div>

   <div class="more-btn">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="home-contact">

<div class="content">
      <h3>Have any questions?</h3>
      <p>We're here to help! Our knowledgeable team is ready to assist you with any inquiries you may have. 
         Whether you need information about our vehicles, financing options, or anything else related to your car shopping experience, 
         feel free to reach out. We are committed to providing excellent customer service and ensuring your complete satisfaction. 
         Don't hesitate to contact us.</p>
      <a href=" " class="btn">Contact Us!</a>
   </div>

</section>



//including the content of footer.php file 
<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
