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

//if delete is set we retrieve the delete id and executes the sql query
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   //this makes sure we delete the corresponding message 
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('Query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; //we include the header?>

<section class="users">

   <h1 class="title">User account</h1>

   <div class="box-container">
      <?php
      //retrieve all users' information from the users 
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('Query failed');
         if(mysqli_num_rows($select_users) > 0){
            //f there is at least one row, a loop is started 
            while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <!--users information from the database using fetch users-->
         <p>ID : <span><?php echo $fetch_users['id']; ?></span></p>
         <p>Username : <span><?php echo $fetch_users['name']; ?></span></p>
         <p>Email : <span><?php echo $fetch_users['email']; ?></span></p>
         <!--The user_type value is used to set the color of the displayed text dynamically.-->
         <p>Type: <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; }; ?>"><?php echo $fetch_users['user_type']; ?></span></p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
         <a href="user_role.php?id=<?php echo $fetch_users['id']; ?>" class="change-role-btn">Change role</a>

	  </div>
      <?php
         }
      }
      ?>
   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
