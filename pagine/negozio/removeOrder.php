<?php
//segna l'ordine selezionato come non corrente
if(!(isset($_POST['ord']))){
    header("Location:orders.php");
}
$order_code=$_POST['oc'];
$dbconn = pg_connect( "host=localhost port=5432 dbname=ent_factory user=ale password=basi2" ) or die ("Could not connect: " . pg_last_error());
$query1="UPDATE ef_schema.ordine SET corrente=false WHERE codice=$1";
$result=pg_query_params($dbconn, $query1, array($order_code));
header("Location:orders.php");//torna alla pagina degli ordini


?>
