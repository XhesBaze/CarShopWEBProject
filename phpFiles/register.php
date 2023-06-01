<?php

@include 'config.php'; //include connection to database
session_start(); //starting a session


if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) // if a user id is set 
{
   header('location:home.php'); // redirect to home page
}

if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) // if an admin id is set 
{
   header('location:admin_page.php'); // redirect to admin page
}


if (isset($_POST['submit'])) // if the form is submitted
{
	
	$name1 = $_POST['name']; //store the name submitted in the name1 variable
	$email1 = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); //storing the sanitized email in the email1 variable
	$pass1 = md5($_POST['pass']); // storing the hashed password in the pass1 variable 
	$cpass1 = md5($_POST['cpass']); // storing the text for the confirmation password in the cpass1 variable


  $stmt1 = mysqli_prepare($conn, "SELECT * FROM `users` WHERE email = ?"); //query to select information from the user table, where the email matches the placeholder
    mysqli_stmt_bind_param($stmt1, "s", $email1); // binding the parameters, a type string will be bounded,email,to its placeholder
    mysqli_stmt_execute($stmt1); // executing the query 
    $res = mysqli_stmt_get_result($stmt1); //saving the result o
	
    if (mysqli_num_rows($res) > 0 ) // if there is a result that is returned (email has been saved already)
    {
        $message[] = 'User already exists!'; 
    } else {
        if ($pass1 != $cpass1) { //if passwords don't match
            $message[] = 'Passwords do not match!';
        }
		else {
            $stmt1 = mysqli_prepare($conn, "INSERT INTO `users` (name, email, password) VALUES (?, ?, ?)"); // preparing an INSERT query, three placeholders for name,email,password
            mysqli_stmt_bind_param($stmt1, "sss", $name1 , $email1, $pass1); // three strings will be binded
            mysqli_stmt_execute($stmt1);// executing the query(inserting the user)
            $message[] = 'Successful sign up!';
            header('location:login.php');//redirect to login if the sign up is successful
            exit();
        }
    }
	    mysqli_stmt_close($stmt1);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign up</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php
//showing error message
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
      <div class="message">
         <span>' . $msg . '</span>
      </div>
      ';
    }
}
?>

<section class="form-container">

   <form action="" method="post">
      <h3>Sign up now</h3>
      <input type="text" name="name" class="box" placeholder="Enter your username:" required>
      <input type="email" name="email" class="box" placeholder="Enter your email:" required>
      <input type="password" name="pass" class="box" placeholder="Enter your password:" required>
      <input type="password" name="cpass" class="box" placeholder="Confirm your password:" required>
      <input type="submit" class="btn" name="submit" value="Register now">
      <p>Already have an account? <a href="login.php">Login now!</a></p>
   </form>

</section>

</body>

</html>
