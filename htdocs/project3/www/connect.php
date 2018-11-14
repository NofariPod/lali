<?php

$con = mysqli_connect("localhost","root","","registration");

if(mysqli_connect_errno()) {
  echo "error occured while connecting with database".mysqli_connect_errno();
}

session_start();

?>
