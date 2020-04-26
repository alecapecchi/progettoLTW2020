<!DOCTYPE html>
<html>
<meta charset="utf-8"/>
<meta name="signup" content="width=device-width, initial-scale=1/">
<link rel="stylesheet" href="../../css/bootstrap.css"/>
<link rel="stylesheet" href="./customsignup.css"/>
<script type="text/javascript" lang="javascript" src="../../js/bootstrap.bundle.min.js"></script>
</script>
<script type="text/javascript" lang="javascript" src="./signup.js">
</script>
<script src="../../js/jquery.slim.min.js"></script>

  <header>
    <br>
    <nav class="navbar navbar-light navbar-expand-lg justify-content-center">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link" href="../about/about.html">About</a>
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
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
          <a class="nav-link" href="#">Cart</a>
        </li>
      </ul>
    </nav>
  </header>
  
  <body>
    <!--<div class="form-row">-->
      <div class="mycontainer">
        <img class="cover" src="../login/cover_nologo.png" width="width-device−width">
      <div class="signup-form">
      <form  method="POST" class="register-form sign-form" name="formsignup" onsubmit="return validForm()">
        <h2 class="text-center font-weight-light pb-2">Sign up</h2>
        <h4 class="font-weight-normal">Profile</h4>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Name: </label>
            <input class="form-control border_form" type="textarea" id="name" placeholder="Ex. Gianluigi"/>
          </div>
          <div class="form-group col-md-6">
            <label for="surname">Surname: </label>
            <input class="form-control border_form" type="textarea" id="surname" placeholder="Ex. Buffon"/>
          </div>
        </div>
        <div class="form-group ">
          <label for="mail">Mail: </label>
          <input type="textarea" class="form-control border_form" id="mail" placeholder="Ex. you@example.it">
        </div>
        

      <h4 class="font-weight-normal">Account</h4 >
        <div class="form-group">
          <label for="user">Username:</label>
          <div class="input-group">
            <div class="input-group-prepend">
             <span class="input-group-text border_form" id="user">@</span>
            </div>
            <input type="text" class="form-control border_form" id="user" placeholder="Username"/>
          </div>
        </div>


      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="mypassword">Password:</label>  
            <input type="password" class="form-control border_form" id="mypassword" minlength="8" maxlength="25"/>
            <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" onclick="showPassword()" value="" id="checkbox"/>
            <label class="form-check-label" for="checkbox">Show me the password</label>
          </div>
          </div>

          <div class="form-group col-md-6"> 
            <label for="confirmpassword">Confirm password: </label>
            <input type="password" class="form-control border_form" id="confirmpassword"/>
          </div>
      </div>

        <div class="form-row">
          <div class="form-group text-center col-md-6"><button type="submit" class="btn btn-primary " >Submit</button></div>
          <div class="form-group text-center col-md-6"> <button type="reset"class="btn btn-primary">Reset</button></div>
           
        </div>
        <br>
        <p class="text-center">Already have an account? 
          <a href="../login/login.php">Sign in</a>
        </p>
      </form>
    </div>
    </div>
<br>
<br>
<!--<img class="img_radius" position="absolute" src="../home/p2.jpg" width="350" height="200" hspace="20">
-->
<footer id="sticky-footer" class="py-4 bg-dark text-white-50 text-left">
    <div class="container text-center">
      <p>Copyright: &copy; 2020 <a href="index.php">The Entertainment Factory Inc.</a></p>
    </div>
  </footer>
</body>

</html>  