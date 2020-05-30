<?php 
    //valori della sessione
    $loggedin=false;
    session_start();
    if (isset($_SESSION['loggedin'])) {
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];}?>
<!DOCTYPE html>
<html>

<title>The Entertainment Factory - About</title>
<meta name="about" content="width-device−width, initial−scale=1"/>
<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="../fav/site.webmanifest">
<link rel="stylesheet" href="../../css/bootstrap.css"/>
<link rel="stylesheet" href="../../css/bootstrap-grid.css"/>
<link rel="stylesheet" href="../home/custom.css">
<link  rel="stylesheet" href="../../fontawesome-free-5.13.0-web/css/all.css">

<script src="../../js/jquery.slim.min.js"></script>
<script type="text/javascript" lang="javascript" src="../../js/bootstrap.min.js"></script>

<body class="text-center">
<br>
<!--navbar-->
<nav class="navbar navbar-light navbar-expand-lg">
<!--bottone in cui navbar collassa nei dispositivi con uno schermo piccolo-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="navbar-collapse collapse w-100 order-1 order-md-1 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" hidden style="color:white;"></a>
            </li>
            
        </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-0 order-md-1 dual-collapse2">
      <ul class="navbar-nav mx-auto">
    <!--link alle pagine principali-->
    <li class="nav-item">
    <!--pagina di about-->
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item">
      <!--pagina del concorso play it!-->
      <a class="nav-link" href="../playit/playit.php">Play It!</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" ></a>
    </li>
    <a class="navbar-brand" href="../home/index.php">
    <!--logo con link all'homepage-->
      <img src="../home/logo_new.png" alt="Logo" style="width:40px;">
    </a>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Order
      </a>
      <!--pagine dei prodotti-->
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="../prodotti/board.php">Board Games</a>
        <a class="dropdown-item" href="../prodotti/wt.php">Wooden Toys</a>
        <a class="dropdown-item" href="../prodotti/at.php">Action</a>
        <a class="dropdown-item" href="../prodotti/dolls.php">Dolls</a>
        <a class="dropdown-item" href="../prodotti/electronic.php">Electronic Toys</a>
      </div>
    </li>

    <li class="nav-item">
    <!--pagina del carrello-->
      <a class="nav-link" href="../cart/cart.php">Cart
      <span class="fas fa-shopping-cart"></span>
    </a>
    </li>
  </ul>
  </div>
    <div class="navbar-collapse collapse w-100 order-2 dual-collapse2">
        <ul class="navbar-nav ml-auto">
        <!--se l'utente è loggato viene mostrato il link al profilo e il logout-->
        <?php if ($loggedin): ?>
            <li class="nav-item">
            <a class="nav-link" href="../profile/profile.php"><?php echo 'Welcome, ' . $my_username . '!';?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../login/logout.php"><u>Logout</u></a>
            </li>
        <!--altrimenti i link alle pagine di login e signup-->
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="../login/login.php"><u>Login</u></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../signup/signup.php"><u>Signup</u></a>
            </li>
            <?php endif ?>

        </ul>
    </div>
  </nav>


<br>
<br>
<!--jumbotron descrittivo-->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">What We Do</h1>
    <p class="lead">We are a young company specialized in entertainment. We offer unbeatable 
    prices on all our products (
      <a class="lead" href="../prodotti/board.php">Board Games</a>,
      <a class="lead" href="../prodotti/wt.php"> Wooden Toys</a>,
      <a class="lead" href="../prodotti/at.php">Action</a>,
      <a class="lead" href="../prodotti/dolls.php">Dolls</a>,
      <a class="lead" href="../prodotti/electronic.php">Electronic Toys</a>
      ) and with the possibility of incredible discounts, when you play our 
      <a class="lead" href="../playit/playit.php"> game</a>.

    </p>
  </div>
</div>

<!--container con card di descrizione degli autori-->
<div class="container">
  <div class="pt-4 row row-cols-1 row-cols-md-2">
    <div class="col mb-6">
        <div class="card">
          <img src="photo.jpg" class="card-img-top" alt="person">
          <div class="card-body">
            <h5 class="card-title">Alessandra Capecchi</h5>
            <p class="card-text">I'm a 20 year old from Rome, Italy.<br> I love to travel and to discover 
              new things. I'm currently 
              finishing my bachelor's degree in Computer Science at La Sapienza University of Rome.
            </p>
            <div class="col mb-2"><i class="fab fa-instagram" style="color:rgb(0, 140, 255);"></i>
            <a href="https://www.instagram.com/ale.capecchi/" class="text-center"> Instagram</a> </div>
            <div class="col mb-2"> <i class="fab fa-linkedin-in" style="color:rgb(0, 140, 255);"></i>
            <a href="https://www.linkedin.com/in/alessandra-capecchi" class="text-center"> Linkedin</a></div>
          </div>
        </div>
      </div>
      <div class="col mb-6">
        <div class="card">
          <img src="sergio.jpg"  class="card-img-top" alt="person">
          <div class="card-body">
            <h5 class="card-title">Sergio Torrejón Espada</h5>
            <p class="card-text">I'm 24 years old. I was born in Spain (Cádiz) and I study computer engineering. <br>
            I study computer science because I love learning about new technologies and being part of their advancement.
            </p>
            <div class="col mb-2"><i class="fab fa-instagram" style="color:rgb(0, 140, 255);"></i>
            <a href="https://www.instagram.com/sergiotorrejon12/" class="text-center"> Instagram</a> </div>
            <div class="col mb-2"><i class="fab fa-facebook" style="color:rgb(0, 140, 255);"></i>
            <a href="https://www.facebook.com/sergio.torrejonespada" class="text-center"> Facebook</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<br>
<br>
<!--footer-->
<footer id="sticky-footer" class="py-4 bg-dark text-white-50 text-left">
  <div class="container text-center">
    <p>Copyright: &copy; 2020 <a href="../home/index.php">The Entertainment Factory Inc.</a> -
    <a type="button" data-toggle="modal" data-target="#modal_terms">
  Terms
        </a></p>
  </div>
</footer>



<!--modal dei termini e condizioni-->
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
        <!--al click chiudi il modal-->
      </div>
    </div>
  </div>
</div>
</body>
</html>