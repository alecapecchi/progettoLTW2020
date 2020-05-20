<?php 
    $loggedin=false;
    session_start();
    if (isset($_SESSION['loggedin'])) {
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];}?>

<!DOCTYPE html>
<html>
<title>The Entertainment Factory</title>
<meta charset="utf-8"/>
<meta name="signup" content="width=device-width, initial-scale=1/">
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="../fav/site.webmanifest">
<link  rel="stylesheet" href="../../fontawesome-free-5.13.0-web/css/all.css">
<link  rel="stylesheet" href="custom_prod.css"/>
<body class="text-center">
<br>
<nav class="navbar navbar-light navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="navbar-collapse collapse w-100 order-1 order-md-1 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="" hidden style="color:white;">LeftLeftLeftLeftLeft</a>
            </li>
            
        </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-0 order-md-1 dual-collapse2">
      <ul class="navbar-nav mx-auto">
      
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
        <a class="dropdown-item" href="board.php">Board Games</a>
        <a class="dropdown-item" href="wt.php">Wooden Toys</a>
        <a class="dropdown-item" href="at.php">Action</a>
        <a class="dropdown-item" href="dolls.php">Dolls</a>
        <a class="dropdown-item" href="electronic.php">Electronic Toys</a>
      </div>
      </li>

      <li class="nav-item">
        <a class="nav-link"  href="../cart/cart.php">Cart
        <span class="fas fa-shopping-cart"></span>
      </a>
      </li>
    </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-2 dual-collapse2">
        <ul class="navbar-nav ml-auto">
        <?php if ($loggedin): ?>
            <li class="nav-item">
            <a class="nav-link" href="../profile/profile.php"><?php echo 'Welcome, ' . $my_username . '!';?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../login/logout.php"><u>Logout</u></a>
            </li>
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


 
  <div class="mycontainer">
     <div class="row">
      <div class="col-md-2">
        <a class="list-group-item-action font-weight-bold lead pl-3" href="all_prod_1.php">Products</a>
        <div class="list-group list-group-flush " id="type-products">
          <a class="list-group-item list-group-item-action font-weight-bold" href="dolls.php">Dolls</a>
          <a class="list-group-item list-group-item-action font-weight-bold" href="electronic.php">Electronic</a>
          <a class="list-group-item list-group-item-action font-weight-bold" href="at.php">Action</a>
          <a class="list-group-item list-group-item-action font-weight-bold" href="board.php">Board Games</a>
          <a class="list-group-item list-group-item-action font-weight-bold" href="wt.php">Wooden Toys</a>
        </div>

      </div>

      <div class="col-md-8">
        <div class="container-carousel">
          <div  id="bestproducts" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators car-ind">
              <li data-target="#bestproducts" data-slide-to="0" class="active"></li>
              <li data-target="#bestproducts" data-slide-to="1"></li>
              <li data-target="#bestproducts" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100 img-carousel" src="../img/avengers.png" alt="...">
              </div>
              <div class="carousel-item ">
                <img class="d-block w-100 img-carousel" src="../img/nintendo.png" alt="...">
              </div>
              <div class="carousel-item ">
                <img class="d-block w-100 img-carousel" src="../img/wodibow_woonkis.png" alt="...">
              </div>
            </div>
              <a class="carousel-control-prev" href="#bestproducts" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#bestproducts" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
          </div>
          </div>
    </div>
        </div>
    
        
  


  
  <div class="container bg-faded">
    <h1>Action Games</h1>
    <hr class="big">

    <?php
//controllare che utente, password e port siano corretti per il dispositivo corrente
$dbconn = pg_connect( "host=localhost port=5432
dbname=ent_factory user=ale password=basi2" )
or die ("Could not connect: " . pg_last_error());
$query="SELECT * FROM ef_schema.prodotto WHERE categoria='Action' ORDER BY codice";
$result=pg_query ($query) or die("Query failed: " . pg_last_error());

$count2=0;
while($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
if($count2==0){echo "\t<div class='row'>";}
$count=0;
foreach($line as $col_value){
    if($count==0){$codice=$col_value;}
    if($count==1){$nome=$col_value;}
    elseif($count==3){$prezzo=$col_value;}
    elseif($count==4){$foto=$col_value;}
    elseif($count==5){$quant_magazzino=$col_value;}
    $count+=1;}
    echo "\t<div class='col-4 mx-auto'>\n
    <div class='card card-body mb-2'>\n
        <img class='card-img-top mx-auto' src=../img/$foto style='width: 200px;'>\n
        <div class='card-body'>\n
          <h5 class='card-title'>$nome</h5>\n
          <p class='card-text'>$prezzo euro</p>\n";
    if($quant_magazzino>0){
      echo "<a href='#' onclick='show_popup()' class='btn btn-primary'>Add to Cart</a>\n";
    }
    else{ echo "<p class='card-text'><i style='color: red;'>Sorry, Item Out of Stock</i></p>";}
    echo"</div>\n
    </div>\n
</div>\n";
    

if($count2<2){$count2+=1;}
else{
    echo "\t</div>";
    $count2=0;}

}

pg_free_result($result) ;
pg_close( $dbconn ) ;
?>

</div>
<div class="mycontainer">
    <div class="mx-auto">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link"  aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="at.php">1</a></li>
            <li class="page-item">
              <a class="page-link"  aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
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

 
   
  <div id="snackbar">
    Item Added to Cart
    <img src="cart.png" style="width:30px" hspace="3"></div>

<script>
function show_popup() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
  
  <script src="../../../js/jquery.slim.min.js"></script>
  <script type="text/javascript" lang="javascript" src="../../../js/bootstrap.min.js"></script>
  </body>
  </html>
    