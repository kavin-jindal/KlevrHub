<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin = true;
}
else{
  $loggedin=false;
}
echo '

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">KlevrHub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>';

        if(!$loggedin){
        echo '
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="signup.php">Signup</a>
        </li>
        '
        ;
      }

        if($loggedin){
          echo '
              
        
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Website
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="feed.php">Blog Feed</a></li>
            <li><a class="dropdown-item" href="users.php">User List</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logs.php">Developer Logs</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Your Account
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="account.php">Account</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">View your profile</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="add_post.php">Add Post</a>
        </li>
        </ul>
        
        

        ';
        
        }
        
        
        echo '
      
      
    </div>
  </div>
</nav>'; ?>