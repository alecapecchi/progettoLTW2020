<?php
    session_start();
    if (isset($_SESSION['loggedin'])) {
    header("Location:../home/index.php");
  }
  ?>
<!DOCTYPE html>
<html>

<title>Login Entertainment Factory</title>
<meta name="viewport" content="width=device−width, initial−scale=1"/>
<link rel="stylesheet" href="./customlogin.css">
<link rel="stylesheet" href="../../css/bootstrap.css"/>
<link rel="stylesheet" href="../../css/bootstrap-grid.css"/>
<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="../fav/site.webmanifest">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


<header>
<nav class="navbar navbar-light navbar-expand-lg justify-content-center">
  <ul class="navbar-nav">
    
    <li class="nav-item">
      <a class="nav-link" href="../about/about.php">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../playit/playit.php">Play It!</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" ></a>
    </li>
    <a class="navbar-brand" href="../home/index.php">
      <img src="../home/logo_new.png" alt="Logo" style="width:40px;">
    </a>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" hidden href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Order
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
    </div>
    </li>

    <li class="nav-item">
      <div>
      <a class="nav-link" href="#">Cart</a>

    </div>
    </li>
  </ul>
</nav>
</header>
<body>
  <div class="mycontainer">
    <img class="cover" src="./cover_nologo.png" width="width-device−width">
    <div class="signup-form">
    <form method="POST" class="register-form form-submit" action="valida_login.php"name="login" onsubmit="return validLogin()">
    <h2 class="font-weight-light pb-4">Sign in</h2>
    <div class="form-group">
      <input class="form-control border_form" type="text" id="user" name="user" placeholder="username" required>
    </div>
    <div class="form-group">
      <input class="form-control border_form" type="password"id="password" name="password" placeholder="password" required>
    </div>
    <div class="form-group form-check text-left">
    <input class="form-check-input" onclick="return rememberme()" type="checkbox" name="checkbox">
    <label class="form-check-label" for="checkbox" >Remember me</label><br>
    </div>
    <div class="g-recaptcha mx-auto" data-sitekey="6LeKK_cUAAAAAG-E5cxzPwyNePI55kHC-E7voSM8" ></div> 
  

    <br>
    <div class="form-row">
      <div class="form-group text-center col-sm-4"><button class="btn btn-outline-primary" name="login_btn"type="submit">Sign in</button></div>
      <div class="form-group text-center col-sm-4"><p>or</p></div>
      <div class="form-group text-center col-sm-4"> <a class="btn btn-primary" href="../signup/signup.php">Sign up</a></div>
       
    </div>
    

    
    </form>
    </div>
    </div>


    <footer id="sticky-footer" class="py-4 bg-dark text-white-50 text-left">
      <div class="container text-center">
        <p>Copyright: &copy; 2020 <a href="index.php">The Entertainment Factory Inc.</a> -
        <a type="button" data-toggle="modal" data-target="#modal_terms">
      Terms
            </a></p>
      </div>
    </footer>
    
    
    
    
    <div class="modal fade" id="modal_terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-justify" >
          <b>NOTE: This is a mock website for a fictional shop. It was created as the final project 
            for the academic year’s 2019/2020 course “Linguaggi e Tecnologie per il Web”, at 
            La Sapienza University of Rome. This is not an actual e-commerce website, and thus
             no sales of any product can and/or will be performed. The following is a mock notice, 
             no rights can be derived from it.</b> <br>
             <hr>
    <ul>
    <li>Users’ information, given upon registration, and users’ orders are stored in the database. </li>
    <li>A non-logged in user can browse the website, and insert items in a cart. No information will be 
      stored for a non-logged in user.</li>
    <li>A logged-in user will be able to perform an order, access his personal profile information, 
      and play a game in the section “Play It”.</li>
    <li>A logged-in can access all his stored information on his personal profile page.</li>
    <li>A registered user is responsible for maintaining the security of his password. The Entertainment 
      Factory Inc. will not be liable for any loss or damages from the user fails to maintain the security 
      of the users’ account and password.</li>
    <li>The use of the website constitutes the agreement to, and acceptance of, this Terms of Service.</li>
    <li>The Entertainment Factory Inc. reserves the right to modify, suspend or terminate the service 
      for any reason, without notice, at any time. Furthermore, violation of any of the terms specified 
      will result in the suspension or termination of the users’ account.</li>
    <hr>
    <b>“PLAY IT” CONTEST TERMS and CONDITIONS</b><br>
    <li>The Contest begins at 12:00:01 a.m. CET on May 1st, 2020, and will continue until further notice.</li>
    <li>By participating in the Contest, each participant agrees to abide by and be bound by these Official 
    Rules.</li>
    <li>Every month a winner will be chosen among all the registered users’. That is the user with the 
    highest score for the Play It game, at 11:59:59 p.m. CET on the last day of the month. </li>
    <li>The winner will be given a coupon code valued 3 times his highest score. If the highest score was 
    achieved by two or more users, the winner will be the user that has been registered for a longer 
    period of time.</li>
    <li>The Entertainment Factory Inc. reserves the right to modify, suspend or terminate the contest 
    for any reason, without notice, at any time.</li>
    
    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" lang="javascript" src="login.js"></script>
</body>
</html>
