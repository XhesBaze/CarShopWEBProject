<?php
@include 'config.php'; // include connection to database
session_start(); //start session 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

   <style>
      .slide-container {
         padding: 5rem;
      }

      .slider-wrapper {
         position: relative;
         max-width: 1000px;
         height: 600px;
         margin: 0 auto;
      }

      .slider {
         display: flex;
         aspect-ratio: 16/9;
         overflow-x: auto;
         scroll-snap-type: x mandatory;
         scroll-behavior: smooth;
         box-shadow: 0 1.5rem 3rem -0.75rem hsla(0, 0%, 0%, 0.25);
         border-radius: 0.5rem;
         overflow: hidden;
      }

      .slider img {
         flex: 1 0 100%;
         scroll-snap-align: start;
         object-fit: cover;
      }

      .slider-nav {
         display: flex;
         column-gap: 1rem;
         position: absolute;
         bottom: 1.25rem;
         left: 50%;
         transform: translateX(-50%);
         z-index: 1;
      }

      .slider-nav a {
         width: 0.5rem;
         height: 0.5rem;
         border-radius: 50%;
         background-color: #fff;
         opacity: 0.75;
         transition: opacity ease 250ms;
         background-color: blue;
      }

      .slider-nav a:hover {
         opacity: 1;
      }

      .overlay {
         position: absolute;
         bottom:0;
         left:0;
         right:0;
         background-color: rgba(0, 0, 0, 0.75);
         overflow: hidden;
         width: 100%;
         height: 0%;
         transition: 0.5s ease;
         display: flex;
         align-items: center;
         justify-content: center;
         opacity: 0;
         transition: opacity 0.5s ease;
      }

      .slider:hover .overlay{
         height: 100%;
         opacity: 1;
      }

      .overlay.active {
    opacity: 1; 
  }

      h2{
         text-align:center;
         font-family:'Times New Roman', Times, serif;
         color: white;
         font-size: 1.2vw;
         margin: 60% 0 0 18%;
         width:70%;
         letter-spacing: 5px;
         line-height: 1.5em;
         margin: 0;

      }
   </style>

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Welcome to OnTheGo!</h3>
      <p>Discover your dream ride at our one-stop destination for all your automotive needs. Our dedicated team is committed to providing exceptional service, 
         ensuring that you find the perfect car that matches your style and exceeds your expectations. Start your journey with us today and experience the thrill 
         of driving in style and luxury!
      </p>
      <a href="about.php" class="btn">Discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">What We Offer</h1>

   <section class="slide-container">
      <div class="slider-wrapper">
         <div class="slider">
            <img id="slide-1" src="./images/href1.jpg" />
            <div class="overlay">
               <h2>At our car shop, we offer an extensive selection of top-notch vehicles to suit every taste and preference. 
                  From sleek sedans to spacious SUVs and powerful sports cars, our diverse inventory ensures that you'll find the perfect 
                  vehicle that matches your lifestyle and exceeds your expectations.
               </h2>
            </div>

            <img id="slide-2" src="./images/href2.jpg" />
            <div class="overlay">
               <h2>Financing your dream car has never been easier with our tailored financing solutions. Our experienced finance professionals will work closely with you to explore flexible and competitive financing options that fit your budget and financial circumstances. We strive to make the financing process transparent and hassle-free, so you can drive away in your dream car with confidence.</h2>
            </div>

            <img id="slide-3" src="./images/href3.jpg" />
            <div class="overlay">
               <h2>We prioritize your satisfaction even after the purchase. Our dedicated service team provides exceptional after-sales service, including routine maintenance, repairs, and access to genuine spare parts. Our skilled technicians ensure that your vehicle remains in optimal condition, and we're always available to address any inquiries or concerns you may have.</h2>
            </div>
         </div>

         <div class="slider-nav">
            <a href="#slide-1" onclick="showSlide(1)"></a>
            <a href="#slide-2" onclick="showSlide(2)"></a>
            <a href="#slide-3" onclick="showSlide(3)"></a>
         </div>
      </div>
   </section>

   <div class="more-btn">
      <a href="shop.php" class="option-btn">Shop now!</a>
   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Have any questions?</h3>
      <p>We're here to help! Our knowledgeable team is ready to assist you with any inquiries you may have. 
         Whether you need information about our vehicles, financing options, or anything else related to your car shopping experience, 
         feel free to reach out. We are committed to providing excellent customer service and ensuring your complete satisfaction. 
         Don't hesitate to contact us.</p>
      <a href="contact.php" class="btn">Contact Us!</a>
   </div>

</section>

<script>
   function showSlide(slideNumber) {
      const slides = document.querySelectorAll('.slider img');
      const overlays = document.querySelectorAll('.overlay');

      // Hide all slides and overlays
      slides.forEach((slide) => {
         slide.style.display = 'none';
      });

      overlays.forEach((overlay) => {
         overlay.style.height = '0%';
      });

      // Show selected slide and overlay
      const selectedSlide = document.getElementById(`slide-${slideNumber}`);
      const selectedOverlay = selectedSlide.nextElementSibling;
      
      selectedSlide.style.display = 'block';
      selectedOverlay.style.height = '100%';
   }
</script>

</body>
</html>
