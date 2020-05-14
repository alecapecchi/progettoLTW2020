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

  <div class="container bg-faded">
  <div class="row">
        <div class="col-10 mx-auto">
            <div class="card card-body mb-2">
                <h2>Catalogue</h2>
                  <table class='orange'>
                    <tr>
                    <th>0</th>    
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>    
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>    
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>    
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>    
                    <th>12</th>
                    <th>13</th>
                    <th>14</th>    
                    <th>15</th>
                    <th>16</th>
                    <th>17</th>    
                    <th>18</th>
                    
                    </tr>
                    <tr>
                    <th>ON</th>    
                    <th>Name</th>
                    <th>Cat</th>
                    <th>Price</th>    
                    <th>Img</th>
                    <th>Qty</th>
                    <th>Pr cod</th>    
                    <th>ON</th>
                    <th>000</th>
                    <th>000</th>    
                    <th>Ind</th>
                    <th>Citta</th>
                    <th>CAP</th>    
                    <th>Naz</th>
                    <th>Usna</th>
                    <th>Usna</th>    
                    <th>LsNa</th>
                    <th>email</th>
                    <th>Pw</th>    
                    <th>Score</th>
                    
                    </tr>

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

while($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
$count=0;
echo "\t <tr>\n";
foreach($line as $col_value){
  echo "\t
  <td>$col_value</td>\n";
    $count+=1;
}
echo "\t </tr>\n";
}

pg_free_result($result) ;
pg_close( $dbconn ) ;
?>
                  </table>
                </div>
            </div>
        </div>
    </div>




  <br>
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
    