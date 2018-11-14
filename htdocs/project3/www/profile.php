<?php

include("connect.php");
include("functions.php");

if(logged_in()){

  mysqli_select_db($con,'users');
  $sql = "SELECT * FROM users";

  $records = mysqli_query($con,$sql);

  ?>

  <link rel="stylesheet" href="../css/form.css">

  <a href="changePassword.php">Change Password</a>
  <a href="logout.php" style="float:right; padding:10px; margin-left:40px; background-color:#eee; color:#333; text-decoration:none">Logout</a>

  <table id="userim" width="600" border="1" cellpadding="1" cellspacing="1">
    <tr>
      <th>first name</th>
      <th>last name</th>
      <th>E-mail</th>
    </tr>

    <?php
    while ($user=mysqli_fetch_assoc($records)) {
      echo "<tr>";
      echo "<td>".$user['firstName']."</td>";
      echo "<td>".$user['lastName']."</td>";
      echo "<td>".$user['email']."</td>";
      echo "</tr>";
      }

      ?>

  </table>
  <?php
}
else {
  header("location: login.php");
  exit();
}

 ?>
