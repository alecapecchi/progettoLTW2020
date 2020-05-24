<?php
if(!(isset($_POST['removetoCart']))){
    header("Location:cart.php");
}
session_start();
$nome=$_POST['nome'];
$codice=$_POST['codice'];
$quantity=$_POST['quantity'];
$foto=$_POST['foto'];
$prezzo=$_POST['prezzo'];
if((isset($_SESSION['arraycart'])) && (!empty($_SESSION['arraycart']))){
    $found=false;
    $count=0;
    foreach ($_SESSION['arraycart'] as $element){
        if(in_array($codice, $element)) { 
            $el = $element[1]-1;         
            $prodotto=array($codice,$element[1]-1,$foto,$nome, $prezzo);
            $_SESSION['arraycart'][$count]=$prodotto;
            $found=true;
        }
        $count+=1;
    }
    if($found){
        $count2=0;
        foreach ($_SESSION['arraycart'] as $element){
            if(in_array($codice, $element)) { 
                if($element[1]==0){
                $prodotto=array($codice,0,$foto,$nome, $prezzo);
                unset($_SESSION['arraycart'][$count2]);
                }
            }
            $count2+=1;
    // $prodotto=array($codice,0,$foto,$nome, $prezzo);
        //unset($_SESSION['arraycart'][$count]);
        }
    }
}

if(isset($_SESSION['total'])) {
    $_SESSION['total']-=$prezzo;}
else{
    $_SESSION['total']=0;
}

if(isset($_POST['url'])) {
    $url = $_POST['url'];
     }
   else {
    $url = "/pagine/home/index.php"; }
    header("Location:http://localhost:3000$url");

?>