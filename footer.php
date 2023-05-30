
//section allows us to target this section in css or js 
<section class="footer">
    

    <div class="box-container">//box container acts as container for several small boxes 
//each box will have different links and help us get to diff parts of our website

//first box will have sections of our website that you can see
        <div class="box">
            <h3>Navigate to:/h3>
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="shop.php">Shop</a>
        </div>

//secod box will have linksthat are specified more for the user
        <div class="box">
            <h3>Extra links:</h3>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="orders.php">My Orders</a>
            <a href="cart.php">My Cart</a>
        </div>

//third  box has  our contacts 
        <div class="box">
            <h3>Contact us!</h3>
            //"fab-fa" css classes in the <i> tag from font awsome that provide us with different icons
            <p> <i class="fas fa-phone"></i> 0691213134 </p>
            <p> <i class="fas fa-phone"></i> 0691314145 </p>
            <p> <i class="fas fa-envelope"></i> onthego@gmail.com </p>
            <p> <i class="fas fa-map-marker-alt"></i> Tirana, Albania </p>
        </div>

//and lastly links to our socials
        <div class="box">
            <h3>Follow us!</h3>
            
            <a href="#"><i class="fab fa-facebook-f"></i>Facebook</a>
            <a href="#"><i class="fab fa-instagram"></i>Instagram</a>
            <a href="#"><i class="fab fa-linkedin"></i>Linkedin</a>
        </div>

    </div>

</section>