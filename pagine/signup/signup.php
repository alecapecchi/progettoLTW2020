<?php
    session_start();
    if (isset($_SESSION['loggedin'])) {
    header("Location:../home/index.php");
  }
  ?>
<!DOCTYPE html>
<html>
<head>
<title>Signup</title>
<head>
<meta charset=" utf−8"/>
<meta name="viewport" content="width-device-width, initial−scale=1"/>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="customsignup.css"/>
<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="../fav/site.webmanifest">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<header>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg justify-content-center">
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
          <img src="logo_new.png" alt="Logo" style="width:40px;">
        </a>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Order
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="../prodotti/board.php">Board Games</a>
          <a class="dropdown-item" href="../prodotti/wt.php">Wooden Toys</a>
          <a class="dropdown-item" href="../prodotti/at.php">Action</a>
          <a class="dropdown-item" href="../prodotti/dolls.php">Dolls</a>
          <a class="dropdown-item" href="../prodotti/electronic.php">Electronic Toys</a>
        </div>
        </li>
  
        <li class="nav-item">
          <a class="nav-link" href="#">Cart</a>
        </li>
      </ul>
    </nav>
  </header>
<body class="text-center">
    <br>
    <br>
   
   
   
   
    <div class="container bg-faded" >
        <div class="row">
        <div class="col-6 mx-auto">
        <div class="card card-body mb-2" style='border-radius: 20px;'>
    <form action="validareg.php" class="register-form sign-form"
    method="POST" name="formsignup" onsubmit="return validForm(this)">
        <h2 class="text-center font-weight-light pb-2">Sign up</h2>
    <h4 class="font-weight-normal text-left">Profile</h4>
    <div class="form-row">
      <div class="form-group col-md-6 text-left">
        <label for="name">Name: </label>
        <input type="text" class="form-control border_form" name="inputName"  id="name" placeholder="Ex. Gianluigi"/>
      </div>
      <div class="form-group col-md-6 text-left">
        <label for="surname">Surname: </label>
        <input type="text" class="form-control border_form" name="inputLname" id="surname" placeholder="Ex. Buffon"/>
      </div>
    </div>
    <div class="form-group text-left">
      <label for="mail">Mail: </label><div class="input-group">
      <input type="email" class="form-control border_form" name="inputEmail" id="mail" placeholder="Ex. you@example.it">
    </div></div>

    <h4 class="font-weight-normal text-left">Account</h4 >
      <div class="form-group text-left">
        <label for="user">Username:</label>
        <div class="input-group">
          <div class="input-group-prepend">
           <span class="input-group-text border_form" id="user">@</span>
          </div>
          <input type="text" class="form-control border_form" name="inputusername" id="username" placeholder="Username"/>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group text-left">
          <label for="mypassword">Password:</label>  
          <input type="password" class="form-control border_form" name="inputpw" id="mypassword" required minlength="8" maxlength="25"/>
          <div class="form-group form-check">
          <input class="form-check-input" type="checkbox" onclick="showPassword()" value="" id="checkbox"/>
          <label class="form-check-label" for="checkbox">Show me the password</label>
        </div>
        </div>

        <div class="form-group col-md-6 text-left"> 
          <label for="confirmpassword">Confirm password: </label>
          <input type="password" class="form-control border_form" name="confermaInputPw" required id="confirmpassword"/>
        </div>
    </div>

      <div class="form-row">
        <div class="form-group text-center col-md-6"><button type="submit" name="reg_btn" class="btn btn-primary " >Submit</button></div>
        <div class="form-group text-center col-md-6"> <button type="reset"class="btn btn-primary">Reset</button></div>
         
      </div>
      
      <div class="g-recaptcha" data-sitekey="6LeKK_cUAAAAAG-E5cxzPwyNePI55kHC-E7voSM8" ></div> 
    <br>
      <p class="text-center">Already have an account? 
        <a href="../login/login.php">Sign in</a>
      </p>



</form>
</div>
</div>
</div>
</div>



<br>
<br>

<footer id="sticky-footer" class="py-4 bg-dark text-white-50 text-left">
  <div class="container text-center">
    <p>Copyright: &copy; 2020 <a href="../home/index.php">The Entertainment Factory Inc.</a> -
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
<script type="text/javascript" lang="javascript" src="signup.js"></script>
</body>
</html>