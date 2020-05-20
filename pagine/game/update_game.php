<?php
if(!(isset($_GET['score']))){
    
    header("Location:game.php");
}
else{
session_start();
$new_score=$_GET['score'];

$dbconn = pg_connect( "host=localhost port=5432 dbname=ent_factory user=ale password=basi2" ) or die ("Could not connect: " . pg_last_error()); 
$username=$_SESSION['name'];

    
    //$data=pg_query_params($dbconn, $query4, array($prod_code,$nome , $categoria, $prezzo,$foto,$quantita_mag));
    $query3="UPDATE ef_schema.cliente SET score='$new_score' WHERE username=$1";
    $result3=pg_query_params($dbconn, $query3, array($username));
    
    header("Location:game.php?fs=".$new_score);
    

}

?>
    </body>
</html>
