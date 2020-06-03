<?php 
  //pagina di pagamento
  //valori della sessione
    $loggedin=false;
    session_start();
    if((isset($_SESSION['arraycart'])) && (!empty($_SESSION['arraycart']))){//se il carrello non è vuoto
    if (isset($_SESSION['loggedin'])) {//se l'utente non è loggato
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];

  $my_total=$_SESSION['total'];
  $cart = $_SESSION['arraycart'];}
	else{//se non loggato torna all'homepage
	  header("Location:../login/login.php");
  }}
  else{
    header("Location:../prodotti/all_prod_1.php");
  }



error_reporting(1);
session_start();

require 'stripe/Stripe.php';//usa la libreria di Stripe

$publishable_key  = "mia_chiave_pubblica";
$secret_key     = "mia_chiave_privata";



if(isset($_POST['sToken'])){//se è settato il token
	Stripe::setApiKey($secret_key);//setta la key con la chiave privata
	$tokenid		= $_POST['sToken'];//prende il token
	$final_total 	= $_POST['inputTotal']*100;//totale in centesimi
	
	
	try {//prova ad addebitare la carta
		$charge 		= Stripe_Charge::create(array( 
		"currency" 		=> "eur",
		"amount" 		=> $final_total,
		"source" 		=> $tokenid,
		
		)			  
		);
		//valori della transazione
		$id			= $charge['id'];
		$amount 	= $charge['amount'];
        $balance_transaction = $charge['balance_transaction'];
        $currency 	= $charge['currency'];
        $status 	= $charge['status'];
        $date 	= date("Y-m-d H:i:s");
		
		$result = "succeeded";
		

		
//indirizzo di spedizione (preso dal form)
	$corrente=true;
	$indirizzo=$_POST['inputAdd']." ".$_POST['inputhNum'];
	$citta=$_POST['inputCity'];
	$cap=$_POST['inputZip'];
	$nazione=$_POST['inputNation'];
		// ALE
    $dbconn = pg_connect( "host=localhost port=5432
    dbname=ent_factory user=ale password=inserisciPasswordA" )
    or die ("Could not connect: " . pg_last_error());
    
    
    /*SERGIO
    $dbconn = pg_connect( "host=localhost port=5433
    dbname=ent_factory user=postgres password=inserisciPasswordS" )
    or die ("Could not connect: " . pg_last_error());*/
    //inserisce l'ordine nel database
		$query="insert into ef_schema.ordine(corrente, indirizzo, citta, cap, nazione) values ( $1 , $2 , $3 , $4 , $5) ";
    $data=pg_query_params($dbconn, $query, array($corrente, $indirizzo , $citta , $cap, $nazione))or die ("Prob: " . pg_last_error());
    if($data){
      //recupera il codice dell'ordine
      $query0="SELECT max(codice) FROM ef_schema.ordine WHERE cap=$1";
      $result=pg_query_params($dbconn, $query0, array($cap))or die ("Prob1: " . pg_last_error());
      $num_rows = pg_num_rows($result);
      
      if($num_rows>0){
          while($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
              $count=0;
              foreach($line as $col_value){
                  if($count==0){$codice_ord=$col_value;
                  }
                  $count+=1;
  
              }}
     
      
      //inserisce nella tabella della relazione cliente-ordine, l'username e il codice dell'ordine
      $query1="insert into ef_schema.cliente_ordine values ( $1 , $2) ";
      $data1=pg_query_params($dbconn, $query1, array($my_username, $codice_ord))or die ("Proba: " . pg_last_error());
     
     foreach($cart as $element){
      //per ogni elemento del carrello:
      $elementg=$element[0];//codice prod
      $qty=$element[1];
      //inserisce nella tabella della relazione ordine-prodotto: il codice del prodotto,
      //il codice dell'ordine e la quantità acquistata
      $query2="insert into ef_schema.ordine_prodotto values ( $1 , $2, $3) ";
      $data2=pg_query_params($dbconn, $query2, array($elementg , $codice_ord,  $qty))or die ("Proby: " . pg_last_error());
       
      //aggiorna la quantità di prodotto disponibile in magazzino, sottraendo la qty acquistata a quella totale
      $query3="UPDATE ef_schema.prodotto SET quantita_mag=quantita_mag-$qty WHERE codice=$1";
     $result3=pg_query_params($dbconn, $query3, array($elementg));
    }
     
     
    }
      

		
		}
		
		
	header("location:conferma.php?id=".$codice_ord);//va alla pagina di conferma
		

		}catch(Stripe_CardError $e) {	
      //ritorna errore se la carta non è stata accettata		
			$error = $e->getMessage();
			$result = "declined";
		}
}

?><!DOCTYPE html>
<html>
<title>The Entertainment Factory</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width-device−width, initial−scale=1"/>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link  rel="stylesheet" href="../../fontawesome-free-5.13.0-web/css/all.css">
<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="../fav/site.webmanifest">
<link  rel="stylesheet" href="custom_pay.css"/>
<body class="text-center">
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
        <a class="nav-link" href="../about/about.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../playit/playit.php">Play It!</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" ></a>
      </li>
      <!--logo con link all'homepage-->
      <a class="navbar-brand" href="../home/index.php">
        <img src="logo_new.png" alt="Logo" style="width:40px;">
      </a>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Order
      </a><!--pagine dei prodotti-->
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
        <!--se l'utente è loggato viene mostrato il link al profilo e il logout-->
            <li class="nav-item">
            <a class="nav-link" href="../profile/profile.php"><?php echo 'Welcome, ' . $my_username . '!';?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../login/logout.php"><u>Logout</u></a>
            </li>
        <?php else: ?>
        <!--altrimenti i link alle pagine di login e signup-->
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

<br><!--form di pagamento-->
<div class="container bg-faded" >
        <div class="row">
        <div class="col-10 mx-auto">
        <div class="card card-body mb-2" style='border-radius: 20px;'>
    <form action="" class="register-form sign-form"
    method="POST" name="payForm" id="pf" ><!--indirizzo di spedizione-->
        <h2 class="text-center font-weight-light pb-2">Payment details</h2>
    <h4 class="font-weight-normal text-left">Delivery</h4>
    <div class="form-row">
      <div class="form-group col-md-11 text-left">
        <label for="name">Address: </label>
        <input type="text" class="form-control border_form" value="" name="inputAdd"  id="add" required placeholder="Street address"/>
      </div>
      <div class="form-group col-md-1 text-left">
        <label for="cat">Number: </label>
        <input type="text" class="form-control border_form" name="inputhNum" value="" id="hnum" required placeholder="Num"/>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5 text-left">
        <label for="name">City: </label>
        <input type="text" class="form-control border_form" name="inputCity" value=""  id="city" required placeholder="City"/>
      </div>
      <div class="form-group col-md-5 text-left">
        <label for="cat">Nation: </label>
        <input type="text" class="form-control border_form" name="inputNation" value="" id="naz" required placeholder="Nation"/>
      </div>
      <div class="form-group col-md-2 text-left">
        <label for="prc">Zip code: </label>
        <input type="text" class="form-control border_form" name="inputZip" value="" id="zip" required placeholder="Zip Code"/>
      </div>
    </div>
    
    <hr>
    <h4 class="font-weight-normal text-left">Card details</h4>
    <div class="form-row"><!--dati sulla carta-->
    <div class="form-group col-md-6 text-left">
        <label for="name">Name on Card: </label>
        <input type="text" class="form-control border_form" name="inputName" value="" id="name" required placeholder="Name"/>
      </div>
      <div class="form-group col-md-6 text-left">
        <label for="code">Card Number: </label>
        <input type="text" class="form-control border_form" name="inputCNum" value="" id="cnum" data-stripe="number" maxlength="16"required placeholder="Card Number"/>
      </div>
      
    </div>
    <div class="form-row">
    <div class="form-group col-md-2 text-left">
        <label for="name">Exp Month: </label>
       <select name="month" id="month" class="form-control border_form" data-stripe="exp_month">
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
                </div>


								<div class="form-group col-md-2 text-left">
                <label for="name">Exp Year</label>
								<select name="year" id="year" class="form-control border_form" data-stripe="exp_year">
                  <option value="21">2020</option>
                  <option value="21">2021</option>
                  <option value="20">2020</option>									
									<option value="22">2022</option>
									<option value="23">2023</option>
									<option value="24">2024</option>
									<option value="25">2025</option>
									<option value="26">2026</option>
									<option value="27">2027</option>
									<option value="28">2028</option>
									<option value="29">2029</option>
									<option value="30">2030</option>
								</select>
      
      </div>



      <div class="form-group col-md-1 text-left">
        <label for="code">CVC: </label>
        <input type="text" class="form-control border_form" value="" name="inputCVC" id="cvc" data-stripe="cvc" maxlength="3"required placeholder="CVC"/>
      </div>
      <div class="form-group col-md-7 text-right"><br><br>
      <h4 id="tot_text">Total: <?php echo $my_total;?> Euro</h4>
        </div>
      
      
    </div>
    <input type="hidden" name="inputTotal" id="tot" value="<?php echo $my_total;?>"/>
     
    <div class="form-group text-right">
    <button type="submit" name="ae_btn" class="btn btn-danger text-right" >Submit</button></div>
  
    </form>
    
    <!--sezione coupon-->
    <hr id='couhr'>
    <h4 class="font-weight-normal text-left" id="couH4">Coupon Code</h4>

    <div class="form-row">
    <div class="form-group col-md-3 text-left">
      <input type="text" class="form-control border_form" name="inputCode"  id="codeCou" value=''placeholder="Code"/>
      </div>
        </div>

    
    <div class="form-group text-left">
    <!--se il coupon è stato inserito correttamente, 
    il valore del prezzo totale verrà cambiato con jquery, e la sezione del coupon sarà nascosta-->
     <button id="couponBtn" class="btn btn-secondary">Validate</button></div>


</div>
</div>
</div>
</div>
  
<br>
      

  




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
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
  <script>
    
$(document).ready(function(){
  $("#couponBtn").click(function(){//se è stato inserito un coupon
    if($("#codeCou").val().toUpperCase()=='LTW2020'){//e il coupon inserito è corretto
    $("#tot_text").text("Total: 1 Euro");//modifica il testo del totale
    $("#tot").val("1");//modifica il valore del totale
    //nascondi tutta la sezione del coupon
    $("#couponBtn").hide();
    $("#couhr").hide();
    $("#codeCou").hide();
    $("#couH4").hide();}
  });
});
</script>

<script type="text/javascript">
//prende la key pubblica
	Stripe.setPublishableKey('<?php print $publishable_key; ?>');
//fa creare a stripe un token
	$(function() {
	  var $form = $('#pf');
	  $form.submit(function(event) {
		
		Stripe.card.createToken($form, validateResponse);
	
		return false;
	  });
	});
//controlla che non ci siano stati errori
	function validateResponse(status, response) {
	  
	  var $myform = $('#pf');
	
	  if (!response.error) { 
		var token = response.id;
      //se non ci sono stati errori, aggiunge il valore del token al form
		
		$myform.append($('<input type="hidden" name="sToken">').val(token));
	
		$myform.get(0).submit();
	  }
	};
	
</script>
</body>
</html>