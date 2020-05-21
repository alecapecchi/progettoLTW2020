<?php 
    $loggedin=false;
    session_start();
    if (isset($_SESSION['loggedin'])) {
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];}
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];?>
<!DOCTYPE html>
<html>
<title>The Entertainment Factory</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width-device−width, initial−scale=1"/>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="../fav/site.webmanifest">
<link  rel="stylesheet" href="customcart.css"/>
<link rel="stylesheet" href="../home/custom.css">
<link  rel="stylesheet" href="../../fontawesome-free-5.13.0-web/css/all.css">
<script type = “text/javascript” src = “../../Vue/vue.js”></script>
<script src=
"http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js">
</script>

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
      <img src="../home/logo_new.png" alt="Logo" style="width:40px;">
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
      <a class="nav-link" href="cart.php">Cart
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
  <div class="container">
  <div class=" text-center">
  <br>
  <h1>Shopping Cart 
  </h1>
  <br>
  <hr class="big"/>
  <br>
  <table class="table table-bordered text-center">
  <tr>
  <th>Photo </th>
  <th>Name</th>
  <th>Quantity </th>
  <th>Price</th>
  <th>Item Price</th>
  </tr>
  
  <?php
  /* ALE
  $dbconn = pg_connect( "host=localhost port=5432
  dbname=ent_factory user=ale password=basi2" )
  or die ("Could not connect: " . pg_last_error());
  */
  
  //SERGIO
  $dbconn = pg_connect( "host=localhost port=5432
  dbname=ent_factory user=postgres password=c354497" )
  or die ("Could not connect: " . pg_last_error());
  //*/

  
  $coduser= "SELECT * FROM ef_schema.cliente_ordine WHERE username_cliente='prova'";
  $coduser= pg_query ($coduser) or die("Query failed: " . pg_last_error());

  while($linecod=pg_fetch_array($coduser,null,PGSQL_ASSOC)){
      $cont=0;
      foreach($linecod as $col_value){
        if($cont==0){$user=$col_value;}
        elseif($cont==1){$cod=$col_value;}
        $cont+=1;
      }
  }
  $query="SELECT * FROM ef_schema.ordine_prodotto WHERE codice_ordine='$cod'";
  $result=pg_query ($query) or die("Query failed: " . pg_last_error());
  
  /*
  $query="SELECT * FROM ef_schema.ordine_prodotto WHERE codice_ordine='1'";
  $result=pg_query ($query) or die("Query failed: " . pg_last_error());
  */
  $total=0;
  while($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
    
    $count=0;
    foreach($line as $col_value){
      if($count==0){$codice_prodotto=$col_value;}
      elseif($count==2){$quantita=$col_value;}
      $count+=1;
    }
    
    $art= "SELECT * FROM ef_schema.prodotto WHERE codice = '$codice_prodotto'";
    $art= pg_query ($art) or die("Query failed: " . pg_last_error());
    
    while($lineart=pg_fetch_array($art,null,PGSQL_ASSOC)){
      $count1=0;
      foreach($lineart as $value){
        if($count1==0){$cod=$value;}
        if($count1==1){$nome=$value;}
        if($count1==3){$prezzo=$value;}
        if($count1==4){$photo=$value;}
        $count1+=1;
      }
      $itemprice=$prezzo;
      $prezzo*=$quantita;
      //$total+=$prezzo;
    $array[] = array($photo,$nome,$quantita,$prezzo,$itemprice);

    }
  }
  $n = count($array);
  for($i = 0; $i < $n; $i++){
    $var0 = $array[$i][0];
    $var1 = $array[$i][1];
    $var2 = $array[$i][2];
    $var3 = $array[$i][3];
    $total +=$var3;
    $var4 = $array[$i][4];
    ?>
    <div id="div<?php echo $i ?>">
    <tr id="tr<?php echo $i ?>">
    
    <th id="th0<?php echo $i ?>"> <?php echo " <img src=../img/$var0 style='width: 200px;'>" ?> </th>
    <th id="th1<?php echo $i ?>"> <?php echo " $var1 " ?> </th>
    <th id="th2<?php echo $i ?>"> <?php echo " $var2 "  ?></th>
    <th id="th3<?php echo $i ?>"> <?php echo " $var3 "  ?> <span class="fas fa-euro-sign "></span></th>
    <th id="th4<?php echo $i ?>"> <?php echo " $var4 "  ?> <span class="fas fa-euro-sign"></span></th>
    <th id="trush<?php echo $i ?>"><button id="trushbotton<?php echo $i ?>" class="fas fa-trash-alt"></button></th>
    </tr>
    
    <script>
  $(document).ready(function(){
    $("#trushbotton<?php echo $i ?>").click(function(){
      $("#th0<?php echo $i ?>").hide();
      $("#th1<?php echo $i ?>").hide();
      $("#th2<?php echo $i ?>").hide();
      $("#th3<?php echo $i ?>").hide();
      $("#th4<?php echo $i ?>").hide();
      $("#trushbotton<?php echo $i ?>").hide();
      $("#tr<?php echo $i ?>").hide();
      $("#div<?php echo $i ?>").remove();
            
    });
  });
</script>
    <?php
  } 
  
  pg_free_result($result) ;
  pg_close( $dbconn ) ;
  ?>
  </div>
  </table>

  <script>
  $(document).ready(function(){
    $("#couponBtn").click(function(){
      if($("#codeCou").val().toUpperCase()=='LTW2020'){
      $("#tot_text").text("Total: 1 Euro");
      $("#tot").val("1");
      $("#couponBtn").hide();
      $("#couhr").hide();
      $("#codeCou").hide();
      $("#couH4").hide();}
    });
  });
  </script>
  <br>
  <p class="fas fa-shopping-cart"> Total: <?php echo " $total " ?> <span class="fas fa-euro-sign"></span></p>
  
  <br>
  <br>
  <div class="form-row">
    <div class="form-group text-left col-md-6"> <a class="btn btn-primary -left" href="../prodotti/all_prod_1.php">Back to Shop</a></div>
    <div class="form-group text-right col-md-6"> <a class="btn btn-primary" href="../payment/payment.php">Go to payment</a> </div>
  </div>

</div>
<br>
</div>
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

<script src="../../js/jquery.slim.min.js"></script>
<script type="text/javascript" lang="javascript" src="../../js/bootstrap.min.js"></script>
</body>
</html>