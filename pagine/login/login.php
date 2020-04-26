<!DOCTYPE html>
<html>

<title>Login Entertainment Factory</title>
<meta name="viewport" content="width=device−width, initial−scale=1"/>
<link rel="stylesheet" href="./customlogin.css">
<link rel="stylesheet" href="../../css/bootstrap.css"/>
<link rel="stylesheet" href="../../css/bootstrap-grid.css"/>
<script type="text/javascript" lang="javascript" src="./login.js"></script>

<header>
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
    <form method="POST" class="register-form form-submit" name="login" onSumbit="return validLogin()">
    <h2 class="font-weight-light pb-4">Sign in</h2>
    <div class="form-group">
      <input class="form-control border_form" type="text" name="user" placeholder="email or username">
    </div>
    <div class="form-group">
      <input class="form-control border_form" type="password" name="password" placeholder="password">
    </div>
    <div class="form-group form-check text-left">
    <input class="form-check-input" type="checkbox" name="checkbox">
    <label class="form-check-label" onClick="return rememberme()" for="checkbox" >Remember me</label><br>
    </div>
    <button class="btn btn-outline-primary" type="submit">Sign in</button><br>
    <p class="pt-2">o</p>
    <a class="btn btn-primary" href="../signup/signup.php">Sign up</a>
    <br>
    </form>
    </div>
    </div>


<footer id="sticky-footer" class="py-4 bg-dark text-white-50 text-left">
  <div class="container text-center">
    <p>Copyright: &copy; 2020 <a href="../home/index.php">The Entertainment Factory Inc.</a></p>
  </div>
</footer>
</body>
</html>
