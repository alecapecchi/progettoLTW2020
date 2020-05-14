<!DOCTYPE html>
<html>
<title>The Entertainment Factory</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width-device−width, initial−scale=1"/>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link  rel="stylesheet" href="custom_neg.css"/>
<body class="text-center">
  <nav class="navbar navbar-light navbar-expand-lg">
    <ul class="navbar-nav">
      <a class="navbar-brand" href="../home/index.php">
        <img src="logo_new.png" alt="Logo" style="width:40px;">
      </a>
      <li class="nav-item">
        <a class="nav-link" href="orders.php">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="users.php">Users</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link active" href="catalogue.php">Catalogue</a>
      </li>
      
    </ul>
  </nav>



  <h2>Orders</h2>
  


    <?php
//controllare che utente, password eport siano corretti per il dispositivo corrente
$dbconn = pg_connect( "host=localhost port=5432
dbname=ent_factory user=ale password=basi2" )
or die ("Could not connect: " . pg_last_error());
$query="SELECT ef_schema.prodotto.*, ef_schema.ordine_prodotto.*, ef_schema.ordine.*,
ef_schema.cliente_ordine.*, ef_schema.cliente.*
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

while($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
$count=0;
echo "\t <tr>\n";
foreach($line as $col_value){
    if($count==0){$codice_ordine=$col_value;}
    elseif($count==1){$nome_prod=$col_value;}
    elseif($count==2){$categoria=$col_value;}
    elseif($count==3){$prezzo=$col_value;}
    elseif($count==4){$foto=$col_value;}
    elseif($count==6){$cod_prod=$col_value;}
    elseif($count==9){$corrente_se=$col_value;}
    elseif($count==10){$indirizzo=$col_value;}
    elseif($count==11){$citta=$col_value;}
    elseif($count==12){$cap=$col_value;}
    elseif($count==13){$nazione=$col_value;}
    elseif($count==15){$nome=$col_value;}
    elseif($count==16){$cognome=$col_value;}
    elseif($count==17){$email=$col_value;}

    $count+=1;
}

echo" <div class='container bg-faded'>
<div class='row'>
<div class='col-10 mx-auto'>
    <div class='card card-body mb-2'>
<img class='ml-auto' src='delete.svg' style='height: 30px;'>
                <h4 class='text-left'>Order Code: $codice_ordine</h4>
                <table class='blue'>
                    <tr>
                    <th>Name</th>    
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Address</th>    
                    <th>City</th>
                    <th>CAP</th>
                    <th>Nation</th>
                    </tr>
    
                    <tr><td>$nome</td>
                    <td>$cognome</td>
                    <td>$email</td>
                    <td>$indirizzo</td>
                    <td>$citta</td>
                    <td>$cap</td>
                    <td>$nazione</td>
                </tr>
    
    
                  </table>
                  <br>
                  <table class='orange'>
                    <tr>
                    <th>Image</th>    
                    <th>Product Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    </tr>
                    
                    <tr><td><img class='mx-auto' src='../img/$foto' style='height: 40px;'></td>
                    <td>$cod_prod</td>
                    <td>$nome_prod</td>
                    <td>$categoria</td>
                    <td>$prezzo euro</td> </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>  
        
        <br>";

}

pg_free_result($result) ;
pg_close( $dbconn ) ;
?>

                  



  
  <br>
  <footer id="sticky-footer" class="py-4 bg-dark text-white-50 text-left">
    <div class="container text-center">
      <p>Copyright: &copy; 2020 <a href="../home/index.php">The Entertainment Factory Inc.</a></p>
    </div>
  </footer>

  
  
  <script src="../../js/jquery.slim.min.js"></script>
  <script type="text/javascript" lang="javascript" src="../../js/bootstrap.min.js"></script>
  </body>
  </html>
    