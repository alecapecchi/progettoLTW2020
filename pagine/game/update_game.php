<?php
if(!(isset($_GET['score']))){
    
    header("Location:game.php");
}
else{
session_start();
$new_score=$_GET['score'];//prende il punteggio dall'url

$dbconn = pg_connect( "host=localhost port=5432 dbname=ent_factory user=ale password=inserisciPasswordA" ) or die ("Could not connect: " . pg_last_error());
$username=$_SESSION['name'];
//aggiorna il punteggio dell'utente
    $query3="UPDATE ef_schema.cliente SET score='$new_score' WHERE username=$1";
    $result3=pg_query_params($dbconn, $query3, array($username));
    
    header("Location:game.php?fs=".$new_score);//torna alla schermata di gioco
    

}

?>
    </body>
</html>
