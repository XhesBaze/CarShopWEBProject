<?php
@include 'config.php'; //including database connection

if ($_SERVER['REQUEST_METHOD'] === 'PATCH' && isset($_GET['id'])) //check if the request method is of type patch and the id has ben set
{
   $userId = $_GET['id'];

   $json = file_get_contents('php://input'); //reads the HTTP request's content and saves it 
   $data = json_decode($json, true); // decodes the json info and saves it as an array

   if (isset($data['role'])) //if the role exists in the array
   {
      $role = $data['role']; //sasves the role

      $stmt1 = mysqli_prepare($conn, "UPDATE `users` SET user_type = ? WHERE id = ?");// query to update the role
      mysqli_stmt_bind_param($stmt1, "si", $role, $userId);
      mysqli_stmt_execute($stmt1);

      if (mysqli_stmt_affected_rows($stmt1) > 0) // checks if any row is affected(edited)
      {
         echo json_encode(array("status" => "success", "message" => "User role updated successfully!"));
      } else {
         echo json_encode(array("status" => "error", "message" => "User already has this role."));
      }

      mysqli_stmt_close($stmt1);
   } else {
      echo json_encode(array("status" => "error", "message" => "Role is missing."));
   }

   exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Role</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

   <?php @include 'admin_header.php'; ?>

  <div class="change-role">
   <h1 class="change-role-heading">Change user role</h1>
   <form id="userrole-form">
      <div class="form-group">
         <label for="role">Select role:</label>
         <select name="role" id="role" class="role-select">
            <option value="Admin">Admin</option>
            <option value="user">User</option>
         </select>
      </div>
      <button type="submit" class="submit-button">Submit</button>
   </form>
</div>

   <script>
      document.getElementById('userrole-form').addEventListener('submit', function(event) 
      {
         event.preventDefault();
         var form = this;
         var role = document.getElementById('role').value;
         var userId = <?php echo $_GET['id']; ?>;
		 console.log(userId);
         var xhr = new XMLHttpRequest();
         xhr.open('PATCH', 'user_role.php?id=' + userId);
        xhr.setRequestHeader('Content-Type', 'application/json');
         xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
               if (xhr.status === 200) {
				   console.log(xhr);
                  var response = JSON.parse(xhr.responseText);
                  alert(response.message);
                  if (response.status === 'success') {
                     window.location.href = 'admin_users.php';
                  }
               } else {
                  alert('An error occurred.');
               }
            }
         };
         var data = JSON.stringify({ role: role }); // Convert the data to JSON format
         xhr.send(data);
      });
   </script>
</body>

</html>
