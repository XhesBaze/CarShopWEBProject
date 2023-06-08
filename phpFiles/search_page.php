<?php
// includes the "config.php" file
@include 'config.php';

//start a new session
session_start();

//retrieves the user id from the session
$user_id = $_SESSION['user_id'];

//if the user id is not set then the user will be directed to the login.php page
if(!isset($user_id)){
   header('location:login.php');
}

// processes the "add_to_wishlist" form submission
if(isset($_POST['add_to_wishlist'])){
//retrieves the product details from the form data such as id , price,name and image
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

   
  //checking if the product is already in the wishlist.
    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
//checking if the product is already selected in the cart
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   // adding the product to the wishlist, cart, or displays a message based on the conditions.
    if(mysqli_num_rows($check_wishlist_numbers) > 0){
        $message[] = 'already added to wishlist';
    }elseif(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{
       //by this query we insert a new row in the wishlist table with the provided value , user id , product id , product name and price
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       //a success message will be stored.
       $message[] = 'product added to wishlist';
    }

}

//processes the "add_to_cart" form submission
if(isset($_POST['add_to_cart'])){
//Retrieves the product details from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

   //check if the product is already in the cart.
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   //check if the product is already in the cart.
    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

       //by this query we can retrieve rows from the wishlist table that matches the specified product name and user id
        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       //check if nr of rows in wishlist table is greater than 0 and if so there are items in the table that matches the specified 
       //conditions
        if(mysqli_num_rows($check_wishlist_numbers) > 0)
        {
           // if so then rows will be deleted from the wishlist table with the specific product name and user id
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }
//by this query a new row in the cart table with the provided valye user id product id, name , price, quantity and image 
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
   <title>Search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
  //includes the content of header.php file in the current search page file
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>search page</h3>
    <p> <a href="home.php">home</a> / search </p>
</section>

<section class="search-form">
    <form action="" method="POST">
        <input type="text" class="box" placeholder="search products..." name="search_box">
        <input type="submit" class="btn" value="search" name="search_btn">
    </form>
</section>

<section class="products" style="padding-top: 0;">

   <div class="box-container">

      <?php
      // retrieve  the search box input
        if(isset($_POST['search_btn'])){
           //using escape function to escape special characters in the search box string.
         //takes the value of the search box input field from the $ post superglobal array which contains data 
          //submitted through a form using the HTTP POST method. 
         $search_box = mysqli_real_escape_string($conn, $_POST['search_box']);
           
           //query to select all rows from the products table where the name column matches 
           //the search criteria specified by the $search_box variable
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'") or die('query failed');
           
           //check if the number of rows returned by the $select_products query is greater than 0. 
         if(mysqli_num_rows($select_products) > 0){
            //loop that iterates through each row of the result set returned by the query ($select_products), by using  the mysqli_fetch_assoc() 
            //function to fetch the current row as an associative array and assigns it to the $fetch_products variable.
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         //a link with eye icon will be created that directs the user to view page with a query parameter pid containing
         //the specific product id
         <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
         //a div element with the class price is created, and so the product price will be displayed
         <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
         //img element that will display an image , url is used as source for the img tag
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         //the value of the name is retrieved using echo $fetch_products['name']. 
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         /initial value of the input field is 1 , min=0 specifies that the minimum allowed value
         //for the input is 0 and the qty for style purposes.
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         //hidden input field is storing product id which can be accessed and 
         //processed on the server-side when the form is submitted.
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
                echo '<p class="empty">no result found!</p>';
            }
        }else{
            echo '<p class="empty">search something!</p>';
        }
      ?>

   </div>

</section>




//includes the content of footer.php file in the current file
<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
