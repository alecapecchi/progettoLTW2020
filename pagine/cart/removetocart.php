<?php
//riduce la quantità del prodotto nel carrello (se >0), altrimenti rimuove il prodotto da $_SESSION['arraycart']
//$_SESSION['arraycart']=array((codice prodotto,quantità nel carrello, foto,nome, prezzo singolo),(...),...);
if(!(isset($_POST['removetoCart']))){
    header("Location:cart.php");
}
//dati del prodotto
session_start();
$nome=$_POST['nome'];
$codice=$_POST['codice'];
$quantity=$_POST['quantity'];
$foto=$_POST['foto'];
$prezzo=$_POST['prezzo'];
if((isset($_SESSION['arraycart'])) && (!empty($_SESSION['arraycart']))){//se il carrello non è vuoto
    $found=false;
    $count=0;
    foreach ($_SESSION['arraycart'] as $element){
        //se il prodotto è nel carrello
        if(in_array($codice, $element)) { 
            $el = $element[1]-1; //sottrai la quantità
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
                if($element[1]==0){//se la quantità è uguale a 0 toglie l'array del prodotto dall'array del carrello
                $prodotto=array($codice,0,$foto,$nome, $prezzo);
                unset($_SESSION['arraycart'][$count2]);
                $_SESSION['arraycart'] = array_values($_SESSION['arraycart']);
                }
            }
            $count2+=1;
        }
    }
}

if(isset($_SESSION['total'])) {//sottrae il prezzo del singolo prodotto al prezzo totale del carrello
    $_SESSION['total']-=$prezzo;}
else{
    $_SESSION['total']=0;
}

if(isset($_POST['url'])) {
    $url = $_POST['url'];
     }
   else {
    $url = "/pagine/home/index.php"; }
    
    ?>


<html>
<!--la finestra viene chiusa immediatamente-->
<body onload=window.close()>


   </body>
</html>
