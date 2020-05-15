<?php 
    //valori login da cambiare
    $loggedin=true;
    if($loggedin){
    $my_username='mp';
    $my_score=56;
    $my_name="Mary";
    $my_lastname="Poppins";
    $my_email="mary@gmail.com";}
    else{
      header("Location:../home/index.php");
    }?>

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
<link  rel="stylesheet" href="custom_prof.css"/>
<body class="text-center">
<br>


  <nav class="navbar navbar-light navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="navbar-collapse collapse w-100 order-1 order-md-1 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="" style="color:white;">LeftLeftLeftLeftLeft</a>
            </li>
            
        </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-0 order-md-1 dual-collapse2">
      <ul class="navbar-nav mx-auto">

      <li class="nav-item">
        <a class="nav-link" href="../about/about.html">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="playit.html">Play It!</a>
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
        <a class="nav-link" href="../cart/cart.php">Cart</a>
      </li>
    </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-2 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a class="nav-link" href="profile.php"><?php echo 'Welcome, ' . $my_username . '!';?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../login/logout.php"><u>Logout</u></a>
            </li>
        </ul>
    </div>
  </nav>
  


  

  <div class="container bg-faded" >
        <div class="row">
        <div class="col-10 mx-auto" >
        <div class="card card-body mb-2" style='border-radius: 20px;background-color:  rgb(210, 233, 255);'>
    <form action="update_profile.php" class="register-form sign-form" onsubmit=validForm(this);
    method="POST" name="prof_up" >
    <?php echo "<h2 class='text-left'>Welcome, ". $my_username."!</h2>";?>
    <h5 class="text-right">Game Score: <?php echo $my_score;?></h5>
    <div class="form-row">
    <div class="form-group col-md-4 text-left">
        <label for="cat">Username: </label>
        <input type="text" class="form-control border_form" name="inputUsername" id="us" value="<?php echo $my_username;?>"readonly/>
      </div>
      <div class="form-group col-md-4 text-left">
        <label for="name">Name: </label>
        <input type="text" class="form-control border_form" name="inputName"  id="name" required value="<?php echo $my_name;?>"/>
      </div>
    
      <div class="form-group col-md-4 text-left">
        <label for="prc">Last Name: </label>
        <input type="text" class="form-control border_form" name="inputCog" id="cog" required value="<?php echo $my_lastname;?>"/>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4 text-left">
        <label for="mail">Email: </label>
        <input type="email" class="form-control border_form" name="inputEmail" id="mail" required value="<?php echo $my_email;?>"/>
      </div>
      <div class="form-group col-md-4 text-left">
        <label for="pass">Password: </label>
        <input type="password" class="form-control border_form" name="inputPass" id="pass" required minlength="8" maxlength="25" placeholder="New Password"/>
      </div>
      <div class="form-group col-md-4 text-left">
        <label for="conf">Confirm: </label>
        <input type="password" class="form-control border_form" name="inputConf" id="conf" required placeholder="Confirm"/>
      </div>
      
    </div>
    <div class="form-group text-right">
    <button type="submit" name="save_btn" class="btn btn-danger text-right" >Save</button></div>
    </form>

  
</div>
</div>
</div>
</div>
  
<br>

<hr>  
<br>

<h2>Orders</h2>
<hr class="orange">


    <?php
//controllare che utente, password eport siano corretti per il dispositivo corrente
$dbconn = pg_connect( "host=localhost port=5432
dbname=ent_factory user=ale password=basi2" )
or die ("Could not connect: " . pg_last_error());
$query="SELECT ef_schema.prodotto.*, ef_schema.ordine_prodotto.*, ef_schema.ordine.*,
ef_schema.cliente_ordine.*, ef_schema.cliente.*, ef_schema.prodotto.nome as nomeProd
FROM ef_schema.prodotto INNER JOIN ef_schema.ordine_prodotto
ON ef_schema.prodotto.codice=codice_prodotto 
INNER JOIN ef_schema.ordine
ON ef_schema.ordine_prodotto.codice_ordine=ef_schema.ordine.codice
INNER JOIN ef_schema.cliente_ordine
ON ef_schema.ordine.codice=ef_schema.cliente_ordine.codice_ordine
INNER JOIN ef_schema.cliente
ON username=username_cliente

ORDER BY ef_schema.ordine_prodotto.codice_ordine"; 
$result=pg_query ($query) or die("Query failed: " . pg_last_error());
$count2=0;
$total=0;
while($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
$count=0;
echo "\t <tr>\n";
foreach($line as $col_value){
    if($count==0){$codice_ordine=$col_value;}
    elseif($count==1){$nome=$col_value;}
    elseif($count==2){$categoria=$col_value;}
    elseif($count==3){$prezzo=$col_value;}
    elseif($count==4){$foto=$col_value;}
    elseif($count==6){$cod_prod=$col_value;}
    elseif($count==8){$qty=$col_value;}
    elseif($count==9){$corrente_se=$col_value;}
    elseif($count==10){$indirizzo=$col_value;}
    elseif($count==11){$citta=$col_value;}
    elseif($count==12){$cap=$col_value;}
    elseif($count==13){$nazione=$col_value;}
    elseif($count==14){$username=$col_value;}
    elseif($count==16){$cognome=$col_value;}
    elseif($count==17){$email=$col_value;}
    elseif($count==20){$nome_prod=$col_value;}
    $count+=1;
}

if($count2!=0 && $codice_ordine!=$old){
    $total=number_format((float)$total, 2, '.', '');
    echo " </table>
    <br>";
    if($old_us==$my_username){
    echo "<h4 class='ml-auto'>Total: $total</h4>";}
    echo "</div></div></div></div>  
<br>";
$total=0;}

if($username==$my_username){
if($count2==0 or $codice_ordine!=$old){
$count3=0;

echo" <div class='container bg-faded'>
<div class='row'>
<div class='col-10 mx-auto'>
    <div class='card card-body mb-2'>
                <h4 class='text-left'>Order Code: $codice_ordine</h4>
                
                  <br>
                  <table class='orange'>
                    <tr>
                    <th>Image</th>    
                    <th>Product Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Qty</th>
                    </tr>";}
                    
    echo "<tr><td><img class='mx-auto' src='../img/$foto' style='height: 40px;'></td>
                    <td>$cod_prod</td>
                    <td>$nome_prod</td>
                    <td>$categoria</td>
                    <td>$prezzo euro</td> 
                    <td>$qty</td> 
                    </tr>";
                    $total+=$prezzo*$qty;
}
$old=$codice_ordine;
$count2+=1;
$old_us=$username;

}
if($corrente_se=='t'){
$total=number_format((float)$total, 2, '.', '');
    echo " </table>
    <br>
    <h4 class='ml-auto'>Total: $total</h4>";}
else{
  echo " </table>";
}

pg_free_result($result) ;
pg_close( $dbconn ) ;
?>


    </div></div></div></div>  
<br>



  
  <br>
  <footer id="sticky-footer" class="py-4 bg-dark text-white-50 text-left">
    <div class="container text-center">
      <p>Copyright: &copy; 2020 <a href="../home/index.php">The Entertainment Factory Inc.</a></p>
    </div>
  </footer>

  
  
  <script src="../../js/jquery.slim.min.js"></script>
  <script type="text/javascript" lang="javascript" src="../../js/bootstrap.min.js"></script>
  <script type="text/javascript" lang="javascript" src="profile.js"></script>
  </body>
  </html>
    