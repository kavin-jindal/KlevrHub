<?php
session_start();
include "partials/_vars.php";
include "partials/_dbconnect.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}
$users = mysqli_query($conn, "SELECT * FROM users");
$row = mysqli_fetch_assoc($users);
$name = htmlspecialchars($_SESSION['username']);
$email = htmlspecialchars($_SESSION['email']);
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$dat = $_SESSION['date'];
$bio = $_SESSION['biog'];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Account - <?php echo $name?></title>
  </head>
  <body class="bg-dark">
  <?php require "partials/_nav.php"; ?>
  <br>  
  <h1 class='text-center text-white'>Your Account</h1>
  <br>  
  
  <br>  
  <div class="containter">
<center>
  <div class="card text-center" style="width: 20rem;">
  <div class="card-body">
    <?php
      $prof = array("neo.jpg", "pika.png", "unnamed.png", "jry.jpeg");
      $pics = $prof[array_rand($prof)];
    ?>
    <img src="<?php echo $pics ?>" width=50% height=50% class="rounded-circle" >
    <hr>
    <h5 class="card-title"><b>Username: </b>@<?php echo $name ?></h5>
    <h5 class="card-title"><b>Name: </b><?php echo $fname." ".$lname ?></h5>
    <h5 class="card-title"><b>Email: </b><?php echo $email ?></h5>
    <hr>
    <h5 class="card-title"><b>Bio: </b><?php echo $bio ?></h5>
    <hr>
    <h5 class="card-title"><b>Date joined: </b><?php echo $dat ?></h5>
  <hr>
    <br>
    <a href="post.php?username=<?php echo $name ?>" class="btn btn-primary">Visit Profile</a>
    <a href="logout.php" class="btn btn-primary">Logout</a>
  </div>
</div>
</center>
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