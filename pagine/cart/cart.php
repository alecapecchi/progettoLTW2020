<?php 
    //valori login da cambiare
    $my_username='mp';
    $loggedin=true;?>
<!DOCTYPE html>
<html>
<title>The Entertainment Factory</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width-device−width, initial−scale=1"/>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link  rel="stylesheet" href="customcart.css"/>
<link rel="stylesheet" href="../home/custom.css">
<link  rel="stylesheet" href="../../fontawesome-free-5.13.0-web/css/all.css">
<script type = “text/javascript” src = “../../Vue/vue.js”></script>

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
      <a class="nav-link" href="../about/about.html">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../playit/playit.php">Play It!</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" ></a>
    </li>
    <a class="navbar-brand" href="index.php">
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
      <a class="nav-link" href="../cart/cart.php">Cart
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
                <a class="nav-link" href="../login/login.html"><u>Login</u></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../signup/signup.html"><u>Signup</u></a>
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
  <hr class="big"/>
  <br>
  <table class="table table-bordered text-center">
  <tr>
  <th>Photo </th>
  <th>Name</th>
  <th>Quantity <span class="fas fa-euro-sign"></span></th>
  <th>Price</th>
  <th>Items Price</th>
  </tr>
  
  <?php
  /* ALE
  $dbconn = pg_connect( "host=localhost port=5432
  dbname=ent_factory user=ale password=basi2" )
  or die ("Could not connect: " . pg_last_error());
  */

  $dbconn = pg_connect( "host=localhost port=5433
  dbname=ent_factory user=postgres password=c354497" )
  or die ("Could not connect: " . pg_last_error());

  
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
      $total+=$prezzo;
    ?>
    <th> <?php echo " <img src=../img/$photo style='width: 200px;'>" ?> </th>
    <th> <?php echo " $nome" ?> </th>
    <th> <button class="fas fa-minus"></button> 
          <?php echo "  $quantita " ?>
         <button class="fas fa-plus"></button>
   </th>
    <th> <?php echo " $prezzo" ?> </th>
    <th> <?php echo " $itemprice " ?> </th>
    <th><button class="fas fa-trash-alt"></button></th>
    </tr>
    <?php
    }
  }
  pg_free_result($result) ;
  pg_close( $dbconn ) ;
  ?>
  </div>
  </table>
  <p class="fas fa-shopping-cart"> Total: <?php echo " $total " ?>€</p>
  <br>
  <a class="btn btn-primary" href="../prodotti/all_prod_1.php">Back to Shop</a>
  <a class="btn btn-primary" href="../payment/payment.php">Go to payment</a>
</div>
<br>
</div>
<footer id="sticky-footer" class="py-4 bg-dark text-white-50 text-left">
  <div class="container text-center">
    <p>Copyright: &copy; 2020 <a href="../home/index.php">The Entertainment Factory Inc.</a></p>
  </div>
</footer>

<script src="../../js/jquery.slim.min.js"></script>
<script type="text/javascript" lang="javascript" src="../../js/bootstrap.min.js"></script>
</body>
</html>