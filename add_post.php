<?php
session_start();
$showAlert = false;
$showError = false;
include "partials/_vars.php";
include "partials/_dbconnect.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_SESSION["username"];
    $title = $_POST["title"];
    $body = $_POST["body"];
    $textt = mysqli_real_escape_string($conn, $body);
    $sql = "INSERT INTO `posts` (`username`, `title`, `text`, `date`) VALUES ('$username', '$title', '".$textt."', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    if ($result){
        $showAlert = true;
    }
    else {
        $showError = "Error: " . $sql . "<br>" . mysqli_error($conn);
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

    <title>Add Post</title>
  </head>
  <body class="bg-dark">
  <?php require "partials/_nav.php"; 
  if ($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> The post was uploaded successfully!.
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
      
        
        <h1>Add Post</h1>
        <br>
        <br>
        <form action="add_post.php" method="post" class="w-75">
                <div class="mb-3">
        <label for="title" class="form-label">Titles</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter the post title">
        </div>
        <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control" id="body" name="body" rows="20" placeholder="Enter the post body here"></textarea>
        <br>
        <strong>Remember, as of now you cannot edit or delete the posts made ;-;</strong>
        <br>
        <br>
        <button type="submit" class="btn btn-outline-primary">Submit</button>    
    </div>
</form>
<br>
<br>
<br>

   
        
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