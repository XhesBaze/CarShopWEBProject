<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
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
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        <div class="account-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>

</header>