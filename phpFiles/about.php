<?php

@include 'config.php';//database connection

session_start();

$user_id = $_SESSION['user_id'];// takes the user id and saves it in session 

if(!isset($user_id)){
   header('location:login.php');// if user id is not submitted we are redirected to log in page
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php';  //including header at the top of the website ?> 

<section class="heading">
    <h3>About Us</h3>
    <p> <a href="home.php">Home</a> / About us </p>  <!--reference link to home -->
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/about-img-1.jpeg" alt="">
        </div>

        <div class="content">
            <h3>Why choose us?</h3>
            <p>
             When it comes to buying a vehicle, choosing our car shop is the smartest decision you can make. 
             Our commitment to unparalleled customer service sets us apart from the competition. Our team of car enthusiasts 
             is here to guide you every step of the way, ensuring that you find the perfect vehicle that aligns with your desires 
             and budget. With an extensive selection of top-quality vehicles, you'll have no trouble finding the ride of your dreams.
              Experience a seamless and transparent buying process that puts your satisfaction first. Choose us and elevate your 
              car-buying experience to new heights.</p>
            <a href="shop.php" class="btn">Shop now!</a><!-- reference link to shop-->
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>What do we provide?</h3>
            <p>
              At our car shop, we provide a comprehensive range of services to cater to all your automotive needs. 
              From a diverse selection of top-quality vehicles to expert guidance from our knowledgeable team, we ensure you 
              find the perfect match. Our commitment to customer satisfaction means a hassle-free and transparent buying process,
               so you can have peace of mind with your purchase. Additionally, our car shop offers reliable maintenance and repair 
               services, ensuring your vehicle stays in optimal condition for years to come. Trust us to provide a one-stop solution 
               for all your automotive requirements.</p>
            <a href="contact.php" class="btn">Contact us!</a><!-- reference link to contact-->
        </div>

        <div class="image">
            <img src="images/about-img-2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/about-img-3.jpeg" alt="">
        </div>

        <div class="content">
            <h3>Who are we?</h3>
            <p>We are more than just a car shop; we are your trusted automotive partner. With a wealth of experience and a 
                passion for automobiles, we have established ourselves as industry experts. Our dedicated team of professionals 
                is committed to delivering exceptional service and exceeding your expectations. We take pride in our reputation 
                for reliability, transparency, and customer satisfaction. Whether you're buying a vehicle, seeking maintenance or 
                repair services, or simply looking for expert advice, we are here to provide you with the highest level of expertise
                 and personalized attention. Choose us and experience the difference of working with a team that truly cares about 
                 your automotive needs.</p>
            <a href="#reviews" class="btn">Reviews</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">Clients' reviews</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.jpg" alt="">
            <p>I had an incredible experience at this car shop! The staff was friendly, knowledgeable, and went above and beyond to
                 find the perfect car for me. The buying process was smooth, and they provided excellent customer service throughout.
                  I highly recommend them for their professionalism and their top-quality vehicles.</p>
            <div class="stars"><!-- icons taken from font awsome -->
                <i class="fas fa-star"></i><!-- full stars-->
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i><!-- half of a star-->
            </div>
            <h3>Client X</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.jpg" alt="">
            <p>I recently purchased a car from this shop, and I couldn't be happier with my decision. The team was attentive and 
                patient, understanding my specific requirements and helping me make an informed choice. The selection of vehicles 
                was impressive, and the pricing was fair. The entire process was seamless, making it a stress-free experience. I 
                highly recommend them for their exceptional service and high-quality cars.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Client Y</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.jpg" alt="">
            <p>From the moment I stepped in, I was greeted warmly and treated with utmost professionalism. The 
                team listened to my preferences and guided me to the perfect vehicle that matched my needs and budget. 
                The entire transaction was transparent, and they even assisted me with financing options. I'm thrilled with
                 my new car and grateful for their outstanding service!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Client Z</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.webp" alt="">
            <p>I had an excellent experience at this car shop. The team was knowledgeable and took the time to understand 
                my preferences. They provided me with several options that were within my budget, and I found the perfect car. 
                The buying process was smooth, and they even assisted me with the paperwork. Overall, it was a great experience, 
                and I highly recommend them for their exceptional service.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Client D</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.jpg" alt="">
            <p>I recently visited this car shop and was thoroughly impressed by their commitment to customer satisfaction. 
                The staff was incredibly helpful and friendly, providing me with all the information I needed to make an informed 
                decision. The selection of vehicles was extensive, and the prices were competitive. They made the entire process 
                easy and enjoyable. I highly recommend this place for anyone looking to purchase a high-quality vehicle.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Client E</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.jpg" alt="">
            <p>I had a fantastic experience purchasing my new car from this car shop. The team was attentive and genuinely cared 
                about finding the right vehicle for me. They provided expert guidance and made the entire process stress-free. 
                The quality of their cars is exceptional, and the prices are competitive. I appreciate their commitment to customer 
                satisfaction and highly recommend them for their outstanding service and top-notch inventory.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Client S</h3>
        </div>

    </div>

</section>


<?php @include 'footer.php'; //including footer at the end of the website page?>

<script src="js/script.js"></script>

</body>
</html>