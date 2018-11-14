<?php

include("connect.php");
include("functions.php");

$error = "";

if(isset($_POST['savepass'])){
  $password = $_POST['password'];
  $confirmPassword = $_POST['passwordConfirm'];

  if(strlen($password) <8 ){
    $error = "Password must be than 8 characters";  }

  else if ($password !== $confirmPassword) {
    $error = "Password does not match";  }

  else {
    $password = password_hash($password,PASSWORD_DEFAULT);
    $email = $_SESSION['email'];
    if(mysqli_query($con,"UPDATE users SET password='$password' WHERE email='$email'")){
      $error = "Password changed successfully, <a href='profile.php'>click here</a> to go to profile";  }
  }}
if(logged_in()){
?>

  <link rel="stylesheet" href="../css/css.css">
  <form id="change" method="POST" action="changePassword.php">
    <lable>New Password:</label><br/>
    <input type="password" name="password"/><br/><br/>

    <lable>Confirm New Password:</label><br/>
    <input type="password" name="passwordConfirm"/><br/><br/>

    <input type="submit" name="savepass" value="save"/><br/><br/>
    <div id="error" style="<?php if($error !=""){  ?> display:block; margin-top:0px; margin-left: 0px; <?php } ?> "><?php echo $error; ?></div>

</form>
<?php

}else {
  header("location: profile.php");
}

?>
