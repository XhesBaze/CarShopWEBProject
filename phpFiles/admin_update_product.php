<?php

//database connection details 
@include 'config.php';

session_start();

//retrieve the admin id <?php

//database connection details 
@include 'config.php';

session_start();

//retrieve the admin id 
$admin_id = $_SESSION['admin_id'];

//if the admin id is not set we go to the log in page
if(!isset($admin_id)){
   header('location:login.php');
};

//checks if the form is submitted
if(isset($_POST['update_product'])){

   //the code retrieves the necessary form data using $_POST and assigns them to variables:
   $update_p_id = $_POST['update_p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);

   //database query is executed to update the product information in the products
   mysqli_query($conn, "UPDATE `products` SET name = '$name', details = '$details', price = '$price' WHERE id = '$update_p_id'") or die('Query failed');

   //The code retrieves the uploaded image file using $_FILES
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/'.$image;
   $old_image = $_POST['update_p_image'];
   
   //checks if a new image file is uploaded by checking if the $image 
   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'Image too large!';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$update_p_id'") or die('Query failed');
         //new image file is moved from the temporary location to the target folder using move_uploaded_file()
         move_uploaded_file($image_tmp_name, $image_folter);
         unlink('uploaded_img/'.$old_image);
         $message[] = 'Updated image!';
      }
   }

   $message[] = 'Updated product!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Update</title>
   <link rel="icon" type="image/png" href="..\images\admin-logo.png"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; //we include the header?>

<section class="update-product">

<?php
//retrieves the id of the product assigns it to the variable $update_id
   $update_id = $_GET['update'];
   //database query is executed to retrieve the product information
   $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('Query failed');
   if(mysqli_num_rows($select_products) > 0){
      while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<!--The enctype="multipart/form-data" attribute is included to support file uploads.-->
<form action="" method="post" enctype="multipart/form-data">
   <!--ode displays the current image of the product -->
   <img style="width:400px; height:250px;border:0cm;"src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="image"  alt="">
   <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
   <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
   <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="update product name" name="name">
   <input type="number" min="0" class="box" value="<?php echo $fetch_products['price']; ?>" required placeholder="update product price" name="price">
   <textarea name="details" class="box" required placeholder="update product details" cols="30" rows="10"><?php echo $fetch_products['details']; ?></textarea>
   <!--The accepted file formats are specified using the accept attribute-->
   <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
   <input type="submit" value="update product" name="update_product" class="btn">
   <a href="admin_products.php" class="option-btn">Go back</a>
</form>

<?php
      }
      //if there are no rows found
   }else{
      echo '<p class="empty">No product selected!</p>';
   }
?>

</section>


<script src="js/admin_script.js"></script>

</body>
</html>
$admin_id = $_SESSION['admin_id'];

//if the admin id is not set we go to the log in page
if(!isset($admin_id)){
   header('location:login.php');
};

//checks if the form is submitted
if(isset($_POST['update_product'])){

   //the code retrieves the necessary form data using $_POST and assigns them to variables:
   $update_p_id = $_POST['update_p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);

   //database query is executed to update the product information in the products
   mysqli_query($conn, "UPDATE `products` SET name = '$name', details = '$details', price = '$price' WHERE id = '$update_p_id'") or die('Query failed');

   //The code retrieves the uploaded image file using $_FILES
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/'.$image;
   $old_image = $_POST['update_p_image'];
   
   //checks if a new image file is uploaded by checking if the $image 
   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'Image too large!';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$update_p_id'") or die('Query failed');
         //new image file is moved from the temporary location to the target folder using move_uploaded_file()
         move_uploaded_file($image_tmp_name, $image_folter);
         unlink('uploaded_img/'.$old_image);
         $message[] = 'Updated image!';
      }
   }

   $message[] = 'Updated product!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update product</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; //we include the header?>

<section class="update-product">

<?php
//retrieves the id of the product assigns it to the variable $update_id
   $update_id = $_GET['update'];
   //database query is executed to retrieve the product information
   $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('Query failed');
   if(mysqli_num_rows($select_products) > 0){
      while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<!--The enctype="multipart/form-data" attribute is included to support file uploads.-->
<form action="" method="post" enctype="multipart/form-data">
   <!--ode displays the current image of the product -->
   <img style="width:400px; height:250px;border:0cm;"src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="image"  alt="">
   <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
   <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
   <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="update product name" name="name">
   <input type="number" min="0" class="box" value="<?php echo $fetch_products['price']; ?>" required placeholder="update product price" name="price">
   <textarea name="details" class="box" required placeholder="update product details" cols="30" rows="10"><?php echo $fetch_products['details']; ?></textarea>
   <!--The accepted file formats are specified using the accept attribute-->
   <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
   <input type="submit" value="update product" name="update_product" class="btn">
   <a href="admin_products.php" class="option-btn">Go back</a>
</form>

<?php
      }
      //if there are no rows found
   }else{
      echo '<p class="empty">No product selected!</p>';
   }
?>

</section>


<script src="js/admin_script.js"></script>

</body>
</html>
