<?php 
    $loggedin=false;
    session_start();
    if (isset($_SESSION['loggedin'])) {
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];

  $my_total=$_SESSION['total'];
  $cart = $_SESSION['arraycart'];}
	else{
	  header("Location:../login/login.php");
	}



error_reporting(1);
session_start();

require 'stripe/Stripe.php';

$publishable_key 	= "pk_test_Lztn2yXWLHTbq5CnBrteONLE00ekCutsh7";
$secret_key			= "sk_test_iRl7Mcpp49IkDGt0JwlOT3yl00LpWpNgGh";


if(isset($_POST['sToken'])){
	Stripe::setApiKey($secret_key);
	$tokenid		= $_POST['sToken'];
	$final_total 	= $_POST['inputTotal']*100;
	
	
	try {
		$charge 		= Stripe_Charge::create(array( 
		"currency" 		=> "eur",
		"amount" 		=> $final_total,
		"source" 		=> $tokenid,
		
		)			  
		);
		
		$id			= $charge['id'];
		$amount 	= $charge['amount'];
        $balance_transaction = $charge['balance_transaction'];
        $currency 	= $charge['currency'];
        $status 	= $charge['status'];
        $date 	= date("Y-m-d H:i:s");
		
		$result = "succeeded";
		

		

	$corrente=true;
	$indirizzo=$_POST['inputAdd']." ".$_POST['inputhNum'];
	$citta=$_POST['inputCity'];
	$cap=$_POST['inputZip'];
	$nazione=$_POST['inputNation'];
		// ALE
    $dbconn = pg_connect( "host=localhost port=5432
    dbname=ent_factory user=ale password=insert_passwordA" )
    or die ("Could not connect: " . pg_last_error());
    
    
    /*SERGIO
    $dbconn = pg_connect( "host=localhost port=5433
    dbname=ent_factory user=postgres password=insert_passwordS" )
    or die ("Could not connect: " . pg_last_error());*/
		$query="insert into ef_schema.ordine(corrente, indirizzo, citta, cap, nazione) values ( $1 , $2 , $3 , $4 , $5) ";
    $data=pg_query_params($dbconn, $query, array($corrente, $indirizzo , $citta , $cap, $nazione))or die ("Prob: " . pg_last_error());
    if($data){
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
     
      
      
      $query1="insert into ef_schema.cliente_ordine values ( $1 , $2) ";
      $data1=pg_query_params($dbconn, $query1, array($my_username, $codice_ord))or die ("Proba: " . pg_last_error());
     
     foreach($cart as $element){
      $elementg=$element[0];
      $qty=$element[1];
      $query2="insert into ef_schema.ordine_prodotto values ( $1 , $2, $3) ";
      $data2=pg_query_params($dbconn, $query2, array($elementg , $codice_ord,  $qty))or die ("Proby: " . pg_last_error());
       
      $query3="UPDATE ef_schema.prodotto SET quantita_mag=quantita_mag-$qty WHERE codice=$1";
     $result3=pg_query_params($dbconn, $query3, array($elementg));
    }
     
     
    }
      

		
		}
		
		
	header("location:conferma.php?id=".$codice_ord);
		//exit;

		}catch(Stripe_CardError $e) {			
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
<div class="container bg-faded" >
        <div class="row">
        <div class="col-10 mx-auto">
        <div class="card card-body mb-2" style='border-radius: 20px;'>
    <form action="" class="register-form sign-form"
    method="POST" name="payForm" id="pf" >
        <h2 class="text-center font-weight-light pb-2">Payment details</h2>
    <h4 class="font-weight-normal text-left">Delivery</h4>
    <div class="form-row">
      <div class="form-group col-md-11 text-left">
        <label for="name">Address: </label>
        <input type="text" class="form-control border_form" value="via mele"name="inputAdd"  id="add" required placeholder="Street address"/>
      </div>
      <div class="form-group col-md-1 text-left">
        <label for="cat">Number: </label>
        <input type="text" class="form-control border_form" name="inputhNum" value="78" id="hnum" required placeholder="Num"/>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5 text-left">
        <label for="name">City: </label>
        <input type="text" class="form-control border_form" name="inputCity" value="Roma"  id="city" required placeholder="City"/>
      </div>
      <div class="form-group col-md-5 text-left">
        <label for="cat">Nation: </label>
        <input type="text" class="form-control border_form" name="inputNation" value="Italia" id="naz" required placeholder="Nation"/>
      </div>
      <div class="form-group col-md-2 text-left">
        <label for="prc">Zip code: </label>
        <input type="text" class="form-control border_form" name="inputZip" value="00100" id="zip" required placeholder="Zip Code"/>
      </div>
    </div>
    
    <hr>
    <h4 class="font-weight-normal text-left">Card details</h4>
    <div class="form-row">
    <div class="form-group col-md-6 text-left">
        <label for="name">Name on Card: </label>
        <input type="text" class="form-control border_form" name="inputName" value="Mary P" id="name" required placeholder="Name"/>
      </div>
      <div class="form-group col-md-6 text-left">
        <label for="code">Card Number: </label>
        <input type="text" class="form-control border_form" name="inputCNum" value="4242424242424242" id="cnum" data-stripe="number" maxlength="16"required placeholder="Card Number"/>
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
        <input type="text" class="form-control border_form" value="123" name="inputCVC" id="cvc" data-stripe="cvc" maxlength="3"required placeholder="CVC"/>
      </div>
      <div class="form-group col-md-7 text-right"><br><br>
      <h4 id="tot_text">Total: <?php echo $my_total;?> Euro</h4>
        </div>
      
      
    </div>
    <input type="hidden" name="inputTotal" id="tot" value="<?php echo $my_total;?>"/>
     
    <div class="form-group text-right">
    <button type="submit" name="ae_btn" class="btn btn-danger text-right" >Submit</button></div>
  
    </form>

    <hr id='couhr'>
    <h4 class="font-weight-normal text-left" id="couH4">Coupon Code</h4>

    <div class="form-row">
    <div class="form-group col-md-3 text-left">
      <input type="text" class="form-control border_form" name="inputCode"  id="codeCou" value=''placeholder="Code"/>
      </div>
        </div>

    
    <div class="form-group text-left">
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

		
		$myform.append($('<input type="hidden" name="sToken">').val(token));
	
		$myform.get(0).submit();
	  }
	};
	
</script>
</body>
</html>