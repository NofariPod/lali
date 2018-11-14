<?php

include("connect.php");
include("functions.php");

if(logged_in()){
  header("location: profile.php");
  exit();
}

$error = "";

if(isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($con,$_POST['email']);
  $password = mysqli_real_escape_string($con,$_POST['password']);
  $checkBox = isset($_POST['keep']);

  if(email_exists($email,$con)){
    $result = mysqli_query($con,"SELECT password FROM users WHERE email='$email'");
    $retrievepassword = mysqli_fetch_assoc($result);
    if(!password_verify($password,$retrievepassword['password'])){
      $error = "Password is incorrect";  }
    else {
      $_SESSION['email'] = $email;

      if($checkBox == "on"){
        setcookie("email",$email,time()+3600);  }
      header("location: profile.php");
    }
   }
  else {
    $error = "Email does not exists";
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
  <body>
    <div id="error" style="<?php if($error !=""){  ?> display:block; <?php } ?> "><?php echo $error; ?></div>

    <div id="wrapper">

      <div id="menu">
        <a href="index.php">Register</a>
        <a href="login.php">Login</a>
      </div>

      <div id="formDiv">

      <form method="POST" action="login.php">
        <lable>Email:</label><br>
        <input type="text" class="inputFields" name="email" required/><br><br>

        <lable>Password:</label><br>
        <input type="password" class="inputFields" name="password" required/><br><br>

        <input type="checkbox" name="keep" class="checkbo"/>
        <lable>Keep me logged in</label><br/><br/>

        <input type="submit" name="submit" class="theButtons" value="login"/>

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
