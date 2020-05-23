<?php
if(!(isset($_POST['addToCart']))){
    header("Location:all_prod_1.php");
}
session_start();
$nome=$_POST['nome'];
$codice=$_POST['codice'];
$foto=$_POST['foto'];
$prezzo=$_POST['prezzo'];
if((isset($_SESSION['arraycart'])) && (!empty($_SESSION['arraycart']))){
    $new=true;
    $count=0;
    foreach ($_SESSION['arraycart'] as $element){
        if(in_array($codice, $element)) {           
            $prodotto=array($codice,$element[1]+1,$foto,$nome, $prezzo);
            $_SESSION['arraycart'][$count]=$prodotto;
            $new=false;
        }
        $count+=1;
}
if($new){
    $prodotto=array($codice,1,$foto,$nome, $prezzo);
    array_push($_SESSION['arraycart'], $prodotto);
}




}
else{

$_SESSION['arraycart']=array (array($codice,1,$foto,$nome, $prezzo));

}
if(isset($_SESSION['total'])) {
$_SESSION['total']+=$prezzo;}
else{
    $_SESSION['total']=$prezzo;
}
/*echo "total ".$_SESSION['total'];
foreach ($_SESSION['arraycart'] as $element2){
    print_r($element2);
}*/
if(isset($_POST['url'])) {
    $url = $_POST['url'];
     }
   else {
    $url = "/pagine/home/index.php"; }
    header("Location:http://localhost:3000$url");

?>