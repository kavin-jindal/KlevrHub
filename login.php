<?php
$login = false;
$showError = false;
$fields_error = "Please fill all the required fields";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  include "partials/_dbconnect.php";
  
  $username = $_POST["username"];
  $password = $_POST["password"];
  //$sql = "Select * from users where username='$username' AND password='$password'";
  $sql = "Select * from users where username='$username'";

  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1){
    while($row=mysqli_fetch_assoc($result)){

      if(password_verify($password, $row['password'])){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true; 
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $row['email'];
        $_SESSION['fname'] = $row['First Name'];
        $_SESSION['lname'] = $row['Last Name'];
        $_SESSION['date'] = $row['dt'];
        $_SESSION['biog'] = $row['bio'];
        header('location: index.php'); 
      }
      else{
        $showError = "Invalid Credentials ;-;-;";
        }
    }
    

  }
  
 
  else{
  $showError = "Invalid Credentials ;-;-;";
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

    <title>Login</title>
  </head>
  <body class="bg-dark text-white">
  <?php require "partials/_nav.php"; ?>
  <?php

  if ($login){
  echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> You are logged in now :)
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Success</strong> '.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
  
  
  
  
  ?>

  <br>  
  <div class="container">
   
    <img src="prug.gif" alt="">
    <br>
    <br>
    <h1 class="">Login ;-;</h1>
    <br>  
    <form action="login.php" method="post" class="w-75">
 
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
    
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
    <div id="passHel" class="form-text">Dont have an account? <a href="authentication/signup.php">Signup</a></div>

  </div>
  
  
  <button type="submit" class="btn btn-outline-primary">Login</button>

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