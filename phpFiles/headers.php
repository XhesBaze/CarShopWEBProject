<?php
if(isset($message)){
   foreach($message as $message){
	   //each message within a <div> element with the class "message will be printed
      echo '
      <div class="message">
         <span>'.$message.'</span>
	 //when the icon i is clicked the associated message will be removed from the page by removing its parent <div> element (effectively
	 //removing the whole message
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>


<header class="header">

    <div class="flex">

        <a href=" " class="logo">OnTheGo</a>

        <nav class="navbar">
            <ul>
                <li><a href=" ">Home</a></li>
                <li><a href="#">Pages ↓</a>
                    <ul>
                        <li><a href=" ">About</a></li>
                        <li><a href=" ">Contact</a></li>
                    </ul>
                </li>
                <li><a href=" ">Shop</a></li>
                <li><a href=" ">Orders</a></li>
				                <li><a href="#">Account ↓</a>
                    <ul>
                        <li><a href=" ">Login</a></li>
                        <li><a href=" ">Register</a></li>
                    </ul>
                </li>
								
            </ul>
        </nav>

        <?php
	    // Retrieving the count of items in the "wishlist" table associated with the current user by getting their id's
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                // counting the number of rows returned by the query
	    $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
	    //a link with the heart icon followed by the items of wishlist will be displayed, and this link will navigate to wishlist.php
	    //page
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
	    // retrieving the count of items in the "cart" table associated with the current user by getting user id.
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
	         // Counting the number of rows returned by the query
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
	    //a link that displays a shopping cart icon followed by the number of items in the cart will be created
	    //Clicking on this link will navigate to the "cart.php" page.
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        <div class="account-box">
		//the username of the current logged in user will be displayed (with the label username).
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
		//the email of the current logged in user will be displayed (with the label user email
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
		//a link with the text logout will be created, and when clicked will navigate to logout.php page
            <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>

</header>
