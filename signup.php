<?php
$showAlert = false;
$showError = false;
$fields_error = "Please fill all the required fields";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  include "partials/_dbconnect.php";
  include "partials/_vars.php";
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $bio = $_POST["bio"];
  //$exists=false;

  $emailexistSql = "SELECT * FROM `users` WHERE email = '$email'";
  $emresult = mysqli_query($conn, $emailexistSql);  
  $emRows = mysqli_num_rows($emresult);

  
  
  $existSql = "SELECT * FROM `users` WHERE username = '$username'";
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  
  if($numExistRows > 0){
    $exists = true;
    $showError = "Username already taken";
  }
  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $showError = "Invalid email";
  }

  elseif(empty(trim($username))){
    $showError = "Please enter a username";
  }
  elseif($emRows > 0){
    $exists = true;
    $showError = "Email already taken";
  }
 
  else{
    $exists = false;
    if (($password == $cpassword) && $exists==false){
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `users` (`username`, `First Name`, `Last Name`, `password`, `email`, `bio`, `dt`) VALUES ('$username', '$fname', '$lname', '$hash', '$email', '$bio', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if ($result){
        $showAlert = true;
      }
      
    }
    else{
      $showError = "Passwords do not match";
    }
  }
}



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body class="bg-dark">
  <?php require "partials/_nav.php"; ?>
  <?php

  if ($showAlert){
  echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> Your account was created and you can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error</strong> '.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
  
  
  
  
  ?>

  <br>  
  <div class="container text-white">
      <img src="ded.gif" alt="">
    <br>
    <h1 class="">Signup :)</h1>
    <br>  
    
    <form action="signup.php" method="post" class="w-75">
 
  <div class="mb-3">
    <label for="username" class="form-label">Username*</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
    
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">First Name*</label>
    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" required>
    
  </div>
  <div class="mb-3">Last Name*</label>
    <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp" required>
    
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password*</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password*</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword" required>
    <div id="passHel" class="form-text">Make sure to enter the correct password</div>
  </div>
  <div class="mb-3">
        <label for="bio" class="form-label">Bio</label>
        <textarea class="form-control" id="bio" name="bio" rows="20" placeholder="Enter your profile bio"></textarea>
        
        <br>

    <div id="passHel" class="form-text">* required fields</div>
    <div id="passHel" class="form-text">Already have an account? <a href="login.php">Login</a></div>



  </div>
  
  <button type="submit" class="btn btn-outline-primary">Signup</button>
</form>
  </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <?php 
    include "partials/_footer.php"
    ?>
  </body>
</html>