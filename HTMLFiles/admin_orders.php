<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin-orders</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">


      <div class="box">
         <p> User id :  </p>
         <p> Placed on :  </p>
         <p> Name : </p>
         <p> Number :  </p>
         <p> Email :  </p>
         <p> Address : </p>
         <p> Total products : </p>
         <p> Total price : </p>
         <p> Payment method : </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="">
            <select name="update_payment">
               <option disabled selected></option>
               <option value="pending">Pending</option>
               <option value="completed">Completed</option>
            </select>
            <input type="submit" name="update_order" value="update" class="option-btn">
            <a href="admin_orders.php" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
         </form>
      </div>

   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
