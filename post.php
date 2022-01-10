<?php
session_start();
include "partials/_vars.php";
include "partials/_dbconnect.php";
$result = mysqli_query($conn, "SELECT * FROM users");
$posts = mysqli_query($conn, "SELECT * FROM posts");

$username = $_GET['username'];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>User Profile</title>

  </head>
  
  <body class="bg-dark">
  <?php require "partials/_nav.php"; ?>
  <br>  
  <div class="container text-white">
      
<center>
<h1>User Profile</h1>

        <?php $result = mysqli_query($conn, "SELECT * FROM `users` where `username` = '$username'"); 

        $title = mysqli_query($conn, "SELECT * FROM `posts` where `title`"); 
        $text = mysqli_query($conn, "SELECT * FROM `posts` where `text`"); 
        $date = mysqli_query($conn, "SELECT * FROM `posts` where `date`");
        $post_username = mysqli_query($conn, "SELECT * FROM `posts` where `username`");

        $row = mysqli_fetch_array($result);
        $card_colors = array("bg-primary", "bg-secondary", "bg-success", "bg-danger", "bg-warning", "bg-info");
        $colors = $card_colors[array_rand($card_colors)];
        echo '<div class="card text-white '.$colors.' mb-3" style="max-width: 18rem;">
            <div class="card text-white '.$colors.' mb-3" style="max-width: 18rem;">
            <div class="card-body">
            <h2 class="card-title">'.$row['First Name']." ".$row["Last Name"].'</h2>
            <h5 class="card-text">'.'@'.$row['username'].'</h5>
            <hr>
            <h5 class="card-text"><b>Bio:</b> '.$row['bio'].'</h5>
            <hr>
            <h5 class="card-text">Date Joined: '.$row['dt'].'</h5>
            <br>
            

            </div>
            </div>
            </div>

     
            ';

?></div>
<br>
<br>
<div class="container text-white text-center">
<hr>
<br>
  <h1>User Posts</h1>
  <br>
</div>
</center>


<?php
// if there are no posts by a user then show no posts available


          while ($row = mysqli_fetch_assoc($posts)) {
            if ($row < 0) {
              echo "<center><h1 class='text-white'>No posts available</h1></center>";
            }
            else {
            if ($row["username"] == $username) {
              
              $text = htmlspecialchars($row['text']);
              echo '
              
              
              

               <center>
                                                    
              <div class="card text-dark bg-light mb-3 " style="width: 20rem;">
              <div class="card-header">Uploaded by <b>'.$row["username"].'</b></div>
              <div class="card-body">
              <h5 class="card-title">'.$row["title"].'</h5>
              <hr>
              <p class="card-text">'.$text.'</p>
              
              <hr>
              <strong> Uploaded on: '.$row["date"].'</strong>
              
                            </center>      
              </div>
              </div>
              </div>
              
              
              ';
            

          } 
          
                   
          
        } 
      }
        ?>
        

  

        <?php 
    include "partials/_footer.php"
    ?>
  </body>
</html>