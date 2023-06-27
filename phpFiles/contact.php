<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('Location: login.php');
    exit(); // Terminate the script after redirecting
}

$message = array(); // Initialize the $message array

if (isset($_POST['send'])) {
    // Check if the required form fields are filled
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['number']) || empty($_POST['message'])) {
        $message[] = 'Please fill in all the fields.';
    } else {
        // Sanitize user input to prevent SQL injection
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $msg = mysqli_real_escape_string($conn, $_POST['message']);

        // Check if the message has already been sent
        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('Query failed');

        if (mysqli_num_rows($select_message) > 0) {
            $message[] = 'Message already sent!';
        } else {
            // Insert the message into the database
            $insert_message = mysqli_query($conn, "INSERT INTO `message` (user_id, name, email, number, message) VALUES ('$user_id', '$name', '$email', '$number', '$msg')") or die('Query failed');

            if ($insert_message) {
                $message[] = 'Message sent successfully!';
            } else {
                $message[] = 'Failed to send the message. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact.css" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php @include'header.php'?>;

    <div class="container-1">
        <span class="big-circle"></span>
        <img src="images/shape.png" class="square" alt="" />
        <div class="form">
            <div class="contact-info">
                <h3 class="title">Get in touch with us!</h3>
                <p class="text">
                    We would love to hear more from you! Here are some other options for you to communicate with us.
                </p>

                <div class="info">
                    <div class="information">
                        <img src="images/location.png" class="icon" alt="" />
                        <p>92 Tirana, Albania</p>
                    </div>
                    <div class="information">
                        <img src="images/email.png" class="icon" alt="" />
                        <p>onthego@gmail.com</p>
                    </div>
                    <div class="information">
                        <img src="images/phone.png" class="icon" alt="" />
                        <p>+355691213134</p>
                    </div>
                </div>

                <div class="social-media">
                    <p>Connect with us </p>
                    <div class="social-icons">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                <form action="" method="POST" autocomplete="off">
                    <h3 class="title">Contact us</h3>
                    <div class="input-container">
                        <input type="text" name="name" class="input" required />
                        <label for="">Username</label>
                        <span>Username</span>
                    </div>
                    <div class="input-container">
                        <input type="email" name="email" class="input" required />
                        <label for="">Email</label>
                        <span>Email</span>
                    </div>
                    <div class="input-container">
                        <input type="tel" name="number" class="input" required />
                        <label for="">Phone</label>
                        <span>Phone</span>
                    </div>
                    <div class="input-container textarea">
                        <textarea name="message" class="input" required></textarea>
                        <label for="">Message</label>
                        <span>Message</span>
                    </div>
                    <input type="submit" name="send" value="Send" class="btn" />
                </form>
            </div>
        </div>
    </div>

    <script src="js/contact.js"></script>
</body>

</html>
