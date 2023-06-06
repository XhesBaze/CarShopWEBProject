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
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('Query failed');
   //the user is redirected at the admin contacts page 
   header('location:admin_contacts.php');
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

<section class="messages">

   <h1 class="title">Messages</h1>

   <div class="box-container">
      <!-- sql query to fetch all the messages from the tabe-->
      <?php
       $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('Query failed');
       if(mysqli_num_rows($select_message) > 0){
          while($fetch_message = mysqli_fetch_assoc($select_message)){
      ?>
      <!-- for each message it create a div to display its information-->
      <div class="box">
         <p>User id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
         <p>Name : <span><?php echo $fetch_message['name']; ?></span> </p>
         <p>Number : <span><?php echo $fetch_message['number']; ?></span> </p>
         <p>Email : <span><?php echo $fetch_message['email']; ?></span> </p>
         <p>Message : <span><?php echo $fetch_message['message']; ?></span> </p>
         <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete</a>
      </div>
      <!-- if there are no rows there are no messages to display-->
      <?php
         }
      }else{
         echo '<p class="empty">No new messages.</p>';
      }
      ?>
   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
