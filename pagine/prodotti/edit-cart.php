<?php
//script per aggiungere i prodotti al carrello
if(!(isset($_POST['addToCart']))){
    header("Location:all_prod_1.php");
}
session_start();
$nome=$_POST['nome'];
$codice=$_POST['codice'];
$foto=$_POST['foto'];
$prezzo=$_POST['prezzo'];
if((isset($_SESSION['arraycart'])) && (!empty($_SESSION['arraycart']))){//se il carrello non è vuoto
    $new=true;
    $count=0;
    foreach ($_SESSION['arraycart'] as $element){
        if(in_array($codice, $element)) {
            //se il prodotto è nel carrello, aumenta la quantità del prodotto seleziionato
            $prodotto=array($codice,$element[1]+1,$foto,$nome, $prezzo);
            $_SESSION['arraycart'][$count]=$prodotto;
            $new=false;
        }
        $count+=1;
}
if($new){//se il prodotto selezionato non è nel carrello inseriscilo
    $prodotto=array($codice,1,$foto,$nome, $prezzo);
    array_push($_SESSION['arraycart'], $prodotto);
}




}
else{
//se il carrello è vuoto, inizializzalo con il prodotto selezionato
$_SESSION['arraycart']=array (array($codice,1,$foto,$nome, $prezzo));

}
//inizializza o modifica il prezzo totale del carrello
if(isset($_SESSION['total'])) {
$_SESSION['total']+=$prezzo;}
else{
    $_SESSION['total']=$prezzo;
}

if(isset($_POST['url'])) {
    $url = $_POST['url'];
     }
   else {
    $url = "/pagine/home/index.php"; }
    //torna alla pagina da cui venivi
    header("Location:http://localhost:3000$url");

?>