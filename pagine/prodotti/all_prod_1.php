<!DOCTYPE html>
<html>
<title>The Entertainment Factory</title>
<meta charset="utf-8"/>
<meta name="signup" content="width=device-width, initial-scale=1/">
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link  rel="stylesheet" href="custom_prod.css"/>
<body class="text-center">
<br>
<nav class="navbar navbar-light navbar-expand-lg justify-content-center">
    <ul class="navbar-nav">
      
      <li class="nav-item">
        <a class="nav-link" href="../about/about.html">About</a>
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
        <a class="nav-link" href="cart/cart.php">Cart</a>
      </li>
    </ul>
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
                <img class="d-block w-100 img-carousel" src="../img/wodibow_woonkis.png" alt="...">
              </div>
              <div class="carousel-item ">
                <img class="d-block w-100 img-carousel" src="../img/nintendo.png" alt="...">
              </div>
              <div class="carousel-item ">
                <img class="d-block w-100 img-carousel" src="../img/avengers.png" alt="...">
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
    <h1>All Products</h1>
    <hr class="big">

    <?php
//controllare che utente, password e port siano corretti per il dispositivo corrente
$dbconn = pg_connect( "host=localhost port=5432
dbname=ent_factory user=ale password=basi2" )
or die ("Could not connect: " . pg_last_error());
$query="SELECT * FROM ef_schema.prodotto ORDER BY codice";
$result=pg_query ($query) or die("Query failed: " . pg_last_error());

$count3=0;
$count2=0;
while($line=pg_fetch_array($result,null,PGSQL_ASSOC) and $count3<12){
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
    $count3+=1;

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
              <a class="page-link" href="all_prod_1.php" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="all_prod_1.php">1</a></li>
            <li class="page-item"><a class="page-link" href="all_prod_2.php">2</a></li>
            <li class="page-item"><a class="page-link" href="all_prod_3.php">3</a></li>
            <li class="page-item"><a class="page-link" href="all_prod_4.php">4</a></li>
            <li class="page-item">
              <a class="page-link" href="all_prod_2.php" aria-label="Next">
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
      <p>Copyright: &copy; 2020 <a href="../home/index.php">The Entertainment Factory Inc.</a></p>
    </div>
  </footer>
 
   
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
    