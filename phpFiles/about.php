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
   <link rel="icon" type="image/png" href="..\images\car-logo.jpg"/>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

  <style>

.carosel_review {
  position: relative;
  width: 100%;
  display: flex;
  justify-content: center;
  overflow: hidden;
}
.swiper-container {
  width: 100%;
  padding-top: 50px;
  padding-bottom: 50px;
}

.swiper-slide {
  background-position: center;
  background-size: cover;
  width: 320px;

  text-align: center;
  font-size: 14px;
  background: #fff;
  box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
  filter: blur(4px);
  background: #e6f2f7;
  border-radius: 10px;
}
.swiper-slide-active {
  filter: blur(0px);
}

.testimonialBox {
  position: relative;
  width: 100%;
  padding: 40px;
  padding-top: 90px;
  color: #686868;
}
.testimonialBox .fa-quote-right {
  position: absolute;
  top: 100px;
  right: 30px;
}
.testimonialBox .fa-quote-left {
  position: absolute;
  top: 20px;
  left: 30px;
}

.content-p {
  position: absolute;
  top: 35px;
  justify-content: center;
  font-size: 1rem;
}
.testimonialBox .details {
  justify-content: center;
  display: flex;
  align-items: center;
  margin-top: 20px;
}
.testimonialBox .details .imgBx {
  position: relative;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  overflow: hidden;
  margin-right: 10px;
}
.testimonialBox .details .imgBx img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.testimonialBox .details h3 {
  font-size: 16px;
  font-weight: 400;
  letter-spacing: 1px;
  color: #2196f3;
  line-height: 1.1em;
}
.testimonialBox .details span {
  font-size: 12px;
  color: #999;
}

.swiper-container-3d .swiper-slide-shadow-left,
.swiper-container-3d .swiper-slide-shadow-right {
  background-image: none;
}


    </style>
</head>
<body>
   
<?php @include 'header.php';  //including header at the top of the website ?> 

<section class="heading">
    <h3>About Us</h3>
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
        </div>

    </div>

</section>

<section class="carosel_review">

      <div class="swiper-container">
        <div class="swiper-wrapper">

          <div class="swiper-slide">

            <div class="testimonialBox">          

              <div class="content">
                <i class="fa-solid fa-quote-left"></i>
                <p class="content-p">
                  I had an incredible experience at this car shop! The staff was friendly, knowledgeable, and went above and beyond to
                  find the perfect car for me. The buying process was smooth, and they provided excellent customer service throughout.
                   I highly recommend them for their professionalism and their top-quality vehicles.
                </p>
                  <i class="fa-solid fa-quote-right"></i>

                <div class="details">

                  <div class="imgBx">
                    <img src="./images/pic-1.jpg" alt="">
                  </div>
                  <h3>
                    Client X <br>
                    <span>
                      CEO
                    </span>
                  </h3>

                </div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
              </div>
              </div>
            </div>
          </div>



          <div class="swiper-slide">
            <div class="testimonialBox">

              <div class="content">
                <i class="fa-solid fa-quote-left"></i>
                <p class="content-p">
                  I recently purchased a car from this shop, and I couldn't be happier with my decision. The team was attentive and 
                  patient, understanding my specific requirements and helping me make an informed choice. I 
                  highly recommend them for their exceptional service and high-quality cars.
                </p>
                
                  <i class="fa-solid fa-quote-right"></i>
               
                <div class="details">

                  <div class="imgBx">
                    <img src="./images/pic-2.jpg" alt="">
                  </div>
                  <h3>
                    Client Y <br>
                    <span>
                      CFO
                    </span>
                  </h3>

                </div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
              </div>
              </div>
            </div>
          </div>



          <div class="swiper-slide">

            <div class="testimonialBox">          

              <div class="content">
                <i class="fa-solid fa-quote-left"></i>
                <p class="content-p">
                  From the moment I stepped in, I was greeted warmly and treated with utmost professionalism. 
                The entire transaction was transparent, and they even assisted me with financing options. I'm thrilled with
                 my new car and grateful for their outstanding service!
                </p>
                  <i class="fa-solid fa-quote-right"></i>

                <div class="details">

                  <div class="imgBx">
                    <img src="./images/pic-3.jpg" alt="">
                  </div>
                  <h3>
                    Client Z <br>
                    <span>
                      CTO
                    </span>
                  </h3>

                </div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
              </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">

            <div class="testimonialBox">          

              <div class="content">
                <i class="fa-solid fa-quote-left"></i>
                <p class="content-p">
                If you're looking for a reliable car shop, look no further! I had a fantastic experience at this place. 
                The staff was professional and attentive, providing excellent customer service. I'm extremely satisfied with my purchase 
                and the overall service provided.
                </p>
                  <i class="fa-solid fa-quote-right"></i>

                <div class="details">

                  <div class="imgBx">
                    <img src="./images/pic-4.webp" alt="">
                  </div>
                  <h3>
                    Client Y <br>
                    <span>
                      Product Manager
                    </span>
                  </h3>

                </div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
              </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">

            <div class="testimonialBox">          

              <div class="content">
                <i class="fa-solid fa-quote-left"></i>
                <p class="content-p">
                I had been searching for a trustworthy car shop, and I finally found one with this place. The staff was honest and transparent, 
                ensuring that I made an informed decision. They had a good range of pre-owned cars in excellent condition, and the prices were
                reasonable.The paperwork was handled efficiently.
                </p>
                  <i class="fa-solid fa-quote-right"></i>

                <div class="details">

                  <div class="imgBx">
                    <img src="./images/pic-5.jpg" alt="">
                  </div>
                  <h3>
                    Client H <br>
                    <span>
                      Software Engineer
                    </span>
                  </h3>

                </div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
              </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">

            <div class="testimonialBox">          

              <div class="content">
                <i class="fa-solid fa-quote-left"></i>
                <p class="content-p">
                This car shop exceeded my expectations. The staff was friendly, the car selection was impressive, and the
                 buying process was smooth. I found a great vehicle at a competitive price. The only minor drawback was the limited parking space.
                  Overall, a fantastic car shop worth visiting.
                </p>
                  <i class="fa-solid fa-quote-right"></i>

                <div class="details">

                  <div class="imgBx">
                    <img src="./images/pic-6.jpg" alt="">
                  </div>
                  <h3>
                    Client O <br>
                    <span>
                      Graphic Designer
                    </span>
                  </h3>

                </div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
              </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">

            <div class="testimonialBox">          

              <div class="content">
                <i class="fa-solid fa-quote-left"></i>
                <p class="content-p">
                I recently visited this car shop and was thoroughly impressed with their service. 
                The staff was knowledgeable, friendly, and eager to assist. They had a wide selection of 
                cars to choose from, and their prices were competitive. 
                </p>
                  <i class="fa-solid fa-quote-right"></i>

                <div class="details">

                  <div class="imgBx">
                    <img src="./images/pic-4.webp" alt="">
                  </div>
                  <h3>
                    Client G <br>
                    <span>
                      Lawyer
                    </span>
                  </h3>

                </div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
              </div>
              </div>
            </div>
          </div>
          
        </div>
    
      </div>
  </div>
 
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".swiper-container", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      autoplay: {
        delay: 1500,
        disableOnInteraction: false,
      },
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 100,
        modifier: 2,
        slideShadows: true,
      },
      loop:true,
    });
  </script>
  </section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html
