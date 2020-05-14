<?php
if(!(isset($_POST['ae_btn'])) and !(isset($_POST['r_btn']))){
    
    header("Location:catalogue.php");
}
$prod_code=$_POST['inputCode'];
$dbconn = pg_connect( "host=localhost port=5432 dbname=ent_factory user=ale password=basi2" ) or die ("Could not connect: " . pg_last_error()); 
$query1="SELECT * FROM ef_schema.prodotto WHERE codice=$1";
$result=pg_query_params($dbconn, $query1, array($prod_code));
$num_rows = pg_num_rows($result);
if($num_rows>0){
   echo "<h1>$prod_code</h1>";
   if(isset($_POST['r_btn'])){
    $query2="DELETE FROM ef_schema.prodotto WHERE codice=$1";
    $result2=pg_query_params($dbconn, $query2, array($prod_code));
   }
   else{
    $nome=$_POST['inputName'];
    $categoria=$_POST['inputCat'];
    $prezzo=$_POST['inputPrc'];
    $foto=$_POST['inputImg'];
    $quantita_mag=$_POST['inputQty'];
    $query3="UPDATE ef_schema.prodotto SET nome='$nome', categoria='$categoria', 
    prezzo='$prezzo', foto='$foto', quantita_mag='$quantita_mag' WHERE codice=$1";
    $result3=pg_query_params($dbconn, $query3, array($prod_code));
   }
   header("Location:catalogue.php");
}
else{
    if(isset($_POST['r_btn'])){
    echo "<h1>Product not found</h1>";}
    else{
    $nome=$_POST['inputName'];
    $categoria=$_POST['inputCat'];
    $prezzo=$_POST['inputPrc'];
    $foto=$_POST['inputImg'];
    $quantita_mag=$_POST['inputQty'];

    $query4="INSERT into ef_schema.prodotto values ($prod_code, $nome, $categoria, $prezzo,$foto,$quantita_mag) ";
    $data=pg_query_params($dbconn, $query4, array($nome , $categoria, $prezzo,$foto,$quantita_mag));
    if($data){
    header("Location:catalogue.php");
    }}
}



?>
    </body>
</html>
