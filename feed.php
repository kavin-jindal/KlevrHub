<?php
session_start();
include "partials/_vars.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}
$name = htmlspecialchars($_SESSION['username']);
$url = "http://".$_SERVER['HTTP_HOST'].$_SESSION['username'];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Feed</title>
  </head>
  <body class="bg-dark">
  <?php require "partials/_nav.php"; ?>
  <br>  
  
  <center>
  

  

  
      <br>
      <h1 class="text-white">Blog Feed</h1>
      <br>
      <?php
      
      include "partials/_dbconnect.php";
      $posts = mysqli_query($conn, "SELECT * FROM posts ORDER BY date DESC LIMIT 5");
      while (($row = mysqli_fetch_assoc($posts)) > 5) {
        $text = htmlspecialchars($row['text']);
        echo '
        <div class="card text-dark bg-light mb-3" style="max-width: 20rem;">
        <div class="card-header">Uploaded by <b>'.$row["username"].'</b></div>
        <div class="card-body">
        <h5 class="card-title">'.$row["title"].'</h5>
        <hr>
        <p class="card-text">'.$text.'</p>
        
        <hr>
        <strong> Uploaded on: '.$row["date"].'</strong>
        
        
          </div>
          </div>
        </div>
        ';
        

      }
      ?>
    </center>
      <br>
      <br>
      <br>  <br>  
     
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
      
       