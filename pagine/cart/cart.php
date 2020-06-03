<?php 
    //pagina del carrello, permette all'utente di rimuovere i prodotti

    //valori della sessione
    $loggedin=false;
    session_start();
    if (isset($_SESSION['loggedin'])) {
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];}
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    //prende l'url, così nel caso in cui l'utente debba effettuare il login si può tornare all'ultima 
    //pagina visitata
?>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>

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
                <a class="nav-link"></a>
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
      <a class="nav-link" href="cart.php">Cart
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

<!--container con la tabella del carrello: ogni riga un prodotto-->
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
  <!--header della tabella, con carattersitiche del prodotto-->
  <th>Photo </th>
  <th>Name</th>
  <th>Quantity </th>
  <th>Price</th>
  <th>Item Price</th>
  </tr>
  
  <?php
//gli elementi vengono presi solo se il carrello non è vuoto
if((isset($_SESSION['arraycart'])) && (!empty($_SESSION['arraycart']))){
  $total=$_SESSION['total'];//prezzo totale del carrello
  echo "<script>total=$total</script>";

  $array=$_SESSION['arraycart'];//array con gli elementi del carrello:
                                //array=(codice prodotto,quantità nel carrello, foto,nome, prezzo singolo)

 //per ogni prodotto nel carrello vengono presi i valori
  $n = count($array);
  for($i = 0; $i < $n; $i++){
    $codice = $array[$i][0]; //codice prodotto
    $var1 = $array[$i][1]; //quantità
    $var2 = $array[$i][2]; //foto
    $var3 = $array[$i][3]; //nome
    $var4 = $array[$i][4]; //prezzoitem
    ?>
    <!--forma la riga della tabella -->
    <div id="div<?php echo $i ?>">
    <tr id="tr<?php echo $i ?>">
    
    <th id="th0<?php echo $i ?>"> <?php echo " <img src=../img/$var2 style='width: 200px;'>"; ?> </th><!--foto-->
    <th id="th1<?php echo $i ?>"> <?php echo " $var3 " ;?> </th><!--nome-->
    <th id="th2<?php echo $i ?>"> <?php echo  $var1; ?></th><!--quantità-->
    <th id="th3<?php echo $i ?>"> <?php echo $var1*$var4; ?> <span class="fas fa-euro-sign "></span></th><!--prezzo totale-->
    <th id="th4<?php echo $i ?>"> <?php echo " $var4 " ; ?> <span class="fas fa-euro-sign"></span></th><!--prezzo unitario-->
    <th id="trush<?php echo $i ?>">
    <?php
    //hidden form(in una nuova finestra), con i valori del prodotto analizzato:
    //l'ultimo elemento della tabella è il submit button del form
    //in removetocart.php riduciamo la quantità del prod nell'array
    $p = $var1*$var4;
    $url="/pagine/cart/cart.php";
     echo "<form method='POST' target='_blank'action='removetocart.php'>
     <input type='hidden' name='codice' value='$codice'>
     <input type='hidden' name='quantity' id='qtyVal$i' value='$var1'>
     <input type='hidden' name='nome' value='$var3'>
     <input type='hidden' name='prezzo' id='prcVal$i' value='$var4'>
     <input type='hidden' name='foto' value='$var2'>
     <input type='hidden' name='url' value='$url'>
    <button type='submit' name='removetoCart' class='btn btn-primary fas fa-trash-alt' id='trushbotton$i'></button>  
     </form>";

    ?>
    </th>
    </tr>

    <script>
  //jquery: al submit del form (ovvero al click del bottone delete nella tabella)
  // la visualizzazione dei dati cambia
  $(document).ready(function(){
    $("#trushbotton<?php echo $i ?>").click(function(){
      //se la quantità del prodotto era maggiore di uno, la quantità del prodottoverrà ridotta di 1 e 
      //il prezzo totale del carrello e del prodotto aggiornati
      if($("#qtyVal<?php echo $i ?>").val()>1){
        new_qty=$("#qtyVal<?php echo $i ?>").val()-1;
        $("#qtyVal<?php echo $i ?>").val(new_qty);//nuovo qty value
        $("#th2<?php echo $i ?>").html(new_qty);//nuovo qty text
        new_price=new_qty*$("#prcVal<?php echo $i ?>").val();
        $("#th3<?php echo $i ?>").html(new_price +" <span class='fas fa-euro-sign'>");//nuovo prezzo prodotto singolo text
        new_total=total-$("#prcVal<?php echo $i ?>").val();//nuovo totale
        total=new_total;
        $("#totalPrc").html(" Total: "+new_total+" <span class='fas fa-euro-sign'></span>");

      }
      else{
      //se la quantità del prodotto era minore di uno, la riga del prodotto verrà nascosta dalla tabella
      //e il prezzo totale del carrello aggiornato
      new_total=total-$("#prcVal<?php echo $i ?>").val();
      total=new_total;
      if(total<=0){
        $("#emCar").show();
        $("#totF").hide();
      }
      $("#totalPrc").html(" Total: "+new_total+" <span class='fas fa-euro-sign'></span>");
      $("#th0<?php echo $i ?>").hide();
      $("#th1<?php echo $i ?>").hide();
      $("#th2<?php echo $i ?>").hide();
      $("#th3<?php echo $i ?>").hide();
      $("#th4<?php echo $i ?>").hide();
      $("#trushbotton<?php echo $i ?>").hide();
      $("#tr<?php echo $i ?>").hide();
      $("#div<?php echo $i ?>").remove();}
            
    });
  });
</script>
    <?php
  } }
  

  ?>
  </div>
  </table>

  <!--se il carrello è vuoto verrà mostrata la scritta "Cart is empty", anziché la tabella-->
  <br><?php if(isset($_SESSION['arraycart'])&& (!empty($_SESSION['arraycart']))):?>
  <h2 style='color:red;display:none' id='emCar'>Cart is empty</h2>  
  <!--prezzo totale-->
  <p class="fas fa-shopping-cart" id='totF'value="<?php echo $_SESSION['total']; ?>" 
  id="totalPrc"> Total: <?php echo $_SESSION['total']; ?> <span class="fas fa-euro-sign"></span></p>
  <?php else:?>
  <h2 style='color:red'>Cart is empty</h2>
  <?php endif?>
  <br>
  <br>
  <div class="form-row">
  <!--bottoni "back to shop" e "payment", se il carrello è vuoto quest'ultimo è disabilitato-->
    <div class="form-group text-left col-md-6"> <a class="btn btn-outline-primary -left" href="../prodotti/all_prod_1.php">Back to Shop</a></div>
    <?php if(!isset($_SESSION['arraycart']) or (empty($_SESSION['arraycart']))): ?>
      <div class="form-group text-right col-md-6"> <button type="button" class="btn btn-primary" disabled>Go to payment</button> </div>
    <?php elseif ($loggedin): ?><!--se l'utente non è loggato vai al login, al click-->
      <div class="form-group text-right col-md-6"> <a class="btn btn-primary" href="../payment/payment.php">Go to payment</a> </div>
      <?php else: ?>
        <div class="form-group text-right col-md-6"> <a class="btn btn-primary" href="../login/login.php?fut='g'">Go to payment</a> </div>
      <?php endif ?>  
    
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
      </div>
    </div>
  </div>
</div>

<script src="../../js/jquery.slim.min.js"></script>
<script type="text/javascript" lang="javascript" src="../../js/bootstrap.min.js"></script>
</body>
</html>