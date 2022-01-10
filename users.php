<?php
session_start();
include "partials/_vars.php";
include "partials/_dbconnect.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}
$name = htmlspecialchars($_SESSION['username']);
$email = htmlspecialchars($_SESSION['email']);
$result = mysqli_query($conn, "SELECT * FROM users");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>User List</title>
  </head>
  <body class="bg-dark">
  <?php require "partials/_nav.php"; ?>
  <br>  
  <div class="container text-white">
        <center>
        <img src="ghost.gif" alt="">
<hr>
        <h1>KlevrHub User List</h1>
        <br>
        <br>
        <?php
        include "partials/_dbconnect.php";

          $users = mysqli_query($conn, "SELECT * FROM users");
          while ($row = mysqli_fetch_assoc($users)) {
            $card_colors = array("bg-secondary", "bg-success", "bg-danger", "bg-warning", "bg-info");
            $colors = $card_colors[array_rand($card_colors)];
            
            echo '<div class="card text-white '.$colors.' mb-3" style="max-width: 18rem;">
            <div class="card text-white '.$colors.' mb-3" style="max-width: 18rem;">
            <div class="card-body">
            <h2 class="card-title">'.$row['First Name']." ".$row["Last Name"].'</h2>
            <h5 class="card-text">'.'@'.$row['username'].'</h5>
            <a class="btn btn-primary" href="post.php?username='.$row["username"].'">View Profile</a>
            </div>
            </div>
            </div>

            ';
           

            echo "<br>";
          }
        
        ?>
<br>
<br>
<br>

   
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