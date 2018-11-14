<?php

include("connect.php");
include("functions.php");

if(logged_in()){
  header("location: profile.php");
  exit();
}

$error = "";

if(isset($_POST['submit'])) {
  $firstName = mysqli_real_escape_string($con,$_POST['fname']);
  $lastName = mysqli_real_escape_string($con,$_POST['lname']);
  $email = mysqli_real_escape_string($con,$_POST['email']);
  $password = $_POST['password'];
  $passwordConfirm = $_POST['passwordConfirm'];

  $image = $_FILES['image']['name'];
  $tmp_image = $_FILES['image']['tmp_name'];
  $imageSize = $_FILES['image']['size'];

  $conditions = isset($_POST['conditions']);

  $date = date("F,d Y");

  if(strlen($firstName) <3) {
    $error = "First Name is too short";
  }
  else if (strlen($lastName) <3) {
    $error = "Last Name is too short";
  }
  else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter valid email address";
  }
  else if (email_exists($email,$con)) {
    $error = "Someone is already registered with this email";
  }
  else if (strlen($password) < 8) {
    $error = "Password must be greater than 8 characters";
  }
  else if ($password !== $passwordConfirm) {
    $error = "Password does not match!";
  }
  else if ($image == "") {
    $error = "Please upload your image";
  }
  else if ($imageSize >1048576) {
    $error = "Image size must be less than 1 mb";
  }
  else if (!$conditions) {
    $error = "You must be agree with terms and conditions";
  }
  else {

    $password = password_hash($password, PASSWORD_DEFAULT);

    $imageExt = explode(".", $image);
    $imageExtension = $imageExt[1];

    if($imageExtension == 'PNG' || $imageExtension == 'png' || $imageExtension == 'JPG' || $imageExtension == 'jpg') {

      $image = rand(0,100000).rand(0,100000).rand(0,100000).time().".".$imageExtension;

      $insertQuery = "INSERT INTO users(firstName, lastName, email, password, image, date) VALUES('$firstName','$lastName','$email','$password','$image','$date')";
      if(mysqli_query($con, $insertQuery)){
        if(move_uploaded_file($tmp_image,"images/$image")) {
          $error = "You are successfully registered";    }
        else {
          $error = "Image is not uploaded"; }    }  }
    else {
      $error = "File nust be an image";
    }
  }
}
 ?>

<!doctype html>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Registration Form</title>
    <link href="https://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/css.css">
   </head>

  <body>

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
      aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" id="home" href="home_page.html">Home</a>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" id="laliWiki" href="https://he.wikipedia.org/wiki/%D7%9E%D7%A8%D7%99%D7%90%D7%A0%D7%94_%D7%90%D7%A1%D7%A4%D7%95%D7%A1%D7%99%D7%98%D7%95">Wiki Lali <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="laliIns" href="https://www.instagram.com/laliespositoo/?hl=es">Insta Lali</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="test" href="Test.html">Bootstrap Page</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="https://www.facebook.com/%D7%9C%D7%90%D7%9C%D7%99-%D7%90%D7%A1%D7%A4%D7%95%D7%A1%D7%99%D7%98%D7%95-%D7%A2%D7%9E%D7%95%D7%93-%D7%9E%D7%A2%D7%A8%D7%99%D7%A6%D7%99%D7%9D-1683803155235704/">Fans Page</a>
              <a class="dropdown-item" href="lali_photos.html">photos page</a>
              <a class="dropdown-item" href="index.php">form page</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <link rel="stylesheet" href="../css/form.css">
    <div id="error" style="<?php if($error !=""){  ?> display:block; <?php } ?> "><?php echo $error; ?></div>

    <div id="wrapper">
      <div id="menu">
        <a href="index.php">Register</a>
        <a href="login.php">Login</a>
      </div>

      <div id="formDiv">

      <form method="POST" action="index.php" enctype="multipart/form-data">
        <lable>First Name:</label><br>
        <input type="text" name="fname" class="inputFields" required/><br><br>

        <lable>Last Name:</label><br>
        <input type="text" name="lname" class="inputFields" required/><br><br>

        <lable>Email:</label><br>
        <input type="text" name="email" class="inputFields" required/><br><br>

        <lable>Password:</label><br>
        <input type="password" name="password" class="inputFields" required/><br><br>

        <lable>Confirm Password:</label><br>
        <input type="password" name="passwordConfirm" class="inputFields" required/><br><br>

        <lable>Image:</label><br>
        <input type="file" name="image" id="imageupload"/><br><br>

        <input type="checkbox" name="conditions" class="checkbo"/>
        <lable>I'm agree with terms and conditions</label><br><br>

        <input type="submit" class="theButtons" name="submit" value="register"/>
      </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://v4-alpha.getbootstrap.com/dist/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="https://v4-alpha.getbootstrap.com/assets/js/vendor/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

  </body>
  </html>
