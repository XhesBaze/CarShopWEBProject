<?php

@include 'config.php';

session_start();

//retrieving the valuue associated with user id
$user_id = $_SESSION['user_id'];


//if user id is not set (means that user has not logged in then the function header
//redirect the user to login.php page
if(!isset($user_id)){
   header('location:login.php');
};

//checking if the form contating add to wishlist input field has been submitted and if so
if(isset($_POST['add_to_wishlist'])){
//retrieving data from superglobal variable post , retrieving product id, name, price and image
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

   //checking if a specific product with a specific product name and user id exists in the wishlist table 
    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   //checking if a specific product with a given name and user id exists in the cart table
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

 //determine if a product is found in the wishlist and if so a success message will be assigned.
   if(mysqli_num_rows($check_wishlist_numbers) > 0){
        $message[] = 'already added to wishlist';
      //determine if a product is found in the cart table 
    }elseif(mysqli_num_rows($check_cart_numbers) > 0){
      //message already added to cart will be assigned to message array
        $message[] = 'already added to cart';
    }else{
      //if no product is available in the wishlist table we added it by using query with the specific user id,
      //product id, name, price and image
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
      //a success message product added to wishlist will be assigned to the message array  
      $message[] = 'product added to wishlist';
    }

}

//processing if the form add to cart input field has been submitted.
if(isset($_POST['add_to_cart'])){
//and if so we retrieve product id , name, price , image and quantity.
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

   //checking in the cart table for a specific product with a given name and given user id
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   //if there is any product in the cart , then the message will be added to message array
    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

       //retrieving rows from wishlist that match the conditions , match the name of the product and user id
        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       //if there is any product in the wishlist table 
        if(mysqli_num_rows($check_wishlist_numbers) > 0)
        {
           //then by using queries we delete the specific product with a given name and given user id 
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

       //else using a query we add an product into cart table with a given user id , pid, name,price quantity and image
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
   <title>quick view</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
   //php directive that is used to include the contents of header.php in the current php script
<?php @include 'header.php'; ?>

   
<section class="quick-view">

    <h1 class="title">product details</h1>

    <?php  
   //checking if the url contains the parameter named pid
        if(isset($_GET['pid']))
        {
           //retrieving the product id
            $pid = $_GET['pid'];
           //getting the product from product table with the specific given product id 
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$pid'") or die('query failed');
           
           //if there is any product 
         if(mysqli_num_rows($select_products) > 0)
         {
            //retrieving a row which we got by the query and which value is assigned to select products 
            while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
   //creating a form element that will be used to create a form on a web page
   <form action="" method="POST">
      //displaying an image on web page with a width set to 450 pixel and height set to 300 pixel
       <img style= "width:450px; height:300px; "src="uploaded_img/<?php>
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
       //using php part fetch_products to retrieve and display the value of the variable name 
       <div class="name"><?php echo $fetch_products['name']; ?></div>
       //using php part fetch_products to retrieve and display the value of the variable price
         <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
        //using php part fetch_products to retrieve and display the value of the variable details                  
         <div class="details"><?php echo $fetch_products['details']; ?></div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
           //retrieving the value of the variable image by fetch_products and attribute is set to hidden                                                                                        
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
      //creating a button that when clicked triggers the form submission and sends the form data to the server.                                                        
          <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                                                                                                                                                                                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
    <?php
            }
        }else{
        echo '<p class="empty">No Products Details Available!</p>';
        }
    }
    ?>

    <div class="more-btn">
         //link redirecting the user to home.php page 
        <a href="home.php" class="option-btn">go to home page</a>
    </div>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
