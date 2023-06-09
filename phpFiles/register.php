<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
    header('Location: admin_page.php');
    exit();
}

if (isset($_POST['submit'])) {
    $name1 = $_POST['name'];
    $email1 = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass1 = md5($_POST['pass']);
    $pass2 = $_POST['pass'];
    $cpass1 = md5($_POST['cpass']);
    $pattern = '/^(?=(?:.*\d){2})(?=.*[!@#$%^&*()\-=_+])[^\';"]{8,16}$/';

    $stmt1 = mysqli_prepare($conn, "SELECT * FROM `users` WHERE email = ?");
    mysqli_stmt_bind_param($stmt1, "s", $email1);
    mysqli_stmt_execute($stmt1);
    $res = mysqli_stmt_get_result($stmt1);

    if (mysqli_num_rows($res) > 0) {
        $message[] = 'User already exists!';
    } else {
        if ($pass1 != $cpass1) {
            $message[] = 'Passwords do not match!';
        } else if (!preg_match($pattern, $pass2)) {
            $message[] = "Password must be 8-16 characters, including 2 numeric values, and 1 symbol (excluding ';' and '\")";
        } else {
            $stmt2 = mysqli_prepare($conn, "INSERT INTO `users` (name, email, password) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt2, "sss", $name1, $email1, $pass1);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
            $message[] = 'Successful sign up!';
            header('Location: login.php');
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
    <link rel="stylesheet" href="css/signin.css">

</head>

<body>

    <?php
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

    <img class="backg" src="images/backg.png">
    <div class="container">
        <div class="images">
            <img src="images/signin.svg">
        </div>

        <div class="form-container">
            <form action="" method="post">
                <img src="./images/hello.svg">
                <h2> Sign up now </h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input class="input" type="text" name="name" required>
                    </div>
                </div>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input class="input" type="email" name="email" required>
                    </div>
                </div>


                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input class="input" type="password" name="pass" required>
                    </div>
                </div>


                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="div">
                        <h5>Confirm password</h5>
                        <input class="input" type="password" name="cpass" required>
                    </div>
                </div>

                <input type="submit" class="btn" name="submit" value="Sign up">
                <p>Already have an account? <a href="login.php">Login now!</a></p>

            </form>
        </div>
    </div>

    <script type="text/javascript" src="js/signin.js"></script>
</body>

</html>
