<?php

@include 'config.php'; //including connection to database

session_start(); // starting a session

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){ //if user id is submitted
   header('location:home.php'); // head to home page (part of user authorization)
}
if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])){ //if admin id is submitted
   header('location:admin_page.php');// head to admin page (part of user authorization)
}
if (isset($_POST['submit'])) { //if the form has been submitted
    $email1 = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); //filtering the email input, performs basic email validation
     $pass1 = md5($_POST['pass']); // hashing the password for SECURITY reasons (EDITED)

    $stmt1 = mysqli_prepare($conn, "SELECT * FROM `users` WHERE email = ? AND password = ?");// retrieve user data from the entity "users"
   
    mysqli_stmt_bind_param($stmt1, "ss", $email1, $pass1); //binding the sanitized email and hashed password , "ss" indicates that two parameters of type string
    //need binding, needed for inserting them in their placeholders from the query
    mysqli_stmt_execute($stmt1); // running the query to find a matching email and password combination
    $res = mysqli_stmt_get_result($stmt1); // retrieving the result and saving it in $res

    if (mysqli_num_rows($res) > 0) { //check if there is something that is returned from the query(at least one row), meaning that a user with a specific email and password combination exists
        $data = mysqli_fetch_assoc($res);// fetching the row and saving its data in $data variable

        if ($data['user_type'] == 'Admin') {  //part of user authorization, if the user type is admin 
            $_SESSION['admin_name'] = $data['name']; // storing admin name in the session 
            $_SESSION['admin_email'] = $data['email']; // storing admin email in the session 
            $_SESSION['admin_id'] = $data['id']; // storing admin id in the session
            header('location:admin_page.php'); // redirecting to admin page
            exit();// terminating 
        } elseif ($data['user_type'] == 'user') { //the same logic behind the user
            $_SESSION['user_name'] = $data['name'];
            $_SESSION['user_email'] = $data['email'];
            $_SESSION['user_id'] = $data['id'];
            header('location:home.php'); // redirecting to home page
            exit();
        } else {
            $message[] = 'User not found!'; // if the type is not admin/user, save this message in the $message array
        }
    } else {
        $message[] = 'Incorrect data!'; // if no data is returned from the query , save this message in the $message array
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
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php //showing errors in the page
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
            <div class="message">
                <span>'.$msg.'</span>
            </div>
            ';
        }
    }
    ?>

    <section class="form-container">

        <form action="" method="post">
            <h3>Login now</h3>
            <input type="email" name="email" class="box" placeholder="Enter your email:" required>
            <input type="password" name="pass" class="box" placeholder="Enter your password:" required>
            <input type="submit" class="btn" name="submit" value="login now">
            <p>Don't have an account yet? <a href="register.php">Register now!</a></p>
        </form>

    </section>

</body>

</html>
