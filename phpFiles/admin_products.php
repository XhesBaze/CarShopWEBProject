<?php

//database connection details 
@include 'config.php';

session_start();

//retrieve the admin id 
$admin_id = $_SESSION['admin_id'];

//if the admin id is not set we go to the log in page
if(!isset($admin_id)){
   header('location:login.php');
};

//The code checks if the form for adding a product has been submitted
// $_POST superglobal array and assigns them to variables
if(isset($_POST['add_product'])){

   //mysqli_real_escape_string function is used to escape any special characters in the input values to prevent SQL injection attacks. 
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   //the name of the updated image
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   //the temporary location of updated image file
   $image_tmp_name = $_FILES['image']['tmp_name'];
   //the destination of the uploaded image
   $image_folter = 'uploaded_img/'.$image;

   //ceck if the name exists in the products table 
   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('Query failed');

   //if any are returns it means it already exists
   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'Product already exists!';
   }else{
      //insert a new product 
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, details, price, image) VALUES('$name', '$details', '$price', '$image')") or die('Query failed');
//If the insert query is successful, the code checks the size of the uploaded image file.
      if($insert_product){
         if($image_size > 2000000){
            $message[] = 'Image too large!';
         }else{
            //script moves the uploaded image file from its temporary location $image_tmp_name to the designated folder $image_folter
            move_uploaded_file($image_tmp_name, $image_folter);
            $message[] = 'Added product!';
         }
      }
   }

}

if(isset($_GET['delete'])){

   //deletion of a product based on the id passed through get parameter delete 
   $delete_id = $_GET['delete'];
   //selects the image column that matches the delete id 
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('Query failed');
   //fetches the row and the name of the image is accessed 
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   //delete the image file from teh server 
   unlink('uploaded_img/'.$fetch_delete_image['image']);
//remove the product and its information if any of the dete queries fail the script will terminate 
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('Query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('Query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('Query failed');
   //redirect to the admin products
   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; //we include the header?>

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Add a new product</h3>
      <input type="text" class="box" required placeholder="enter product name" name="name">
      <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
      <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>

<section class="show-products">

   <div class="box-container">

      <?php
      //select all the rows from product 
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed');
         //checks if there are products available 
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <!--The product's price, image, name, and details are displayed by echoing the corresponding values from the $fetch_products array.-->
         <div class="price">$<?php echo $fetch_products['price']; ?></div>
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" >
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="details"><?php echo $fetch_products['details']; ?></div>
         <!--provide options for updating and deleting the product-->
         <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
      </div>
      <?php
         }
         //no products available 
      }else{
         echo '<p class="empty">No products added!</p>';
      }
      ?>
   </div>
   

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
