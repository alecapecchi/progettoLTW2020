<?php
if(!(isset($_POST['save_btn']))){
    
    header("Location:profile.php");
}
session_start();
$username=$_POST['inputUsername'];
$dbconn = pg_connect( "host=localhost port=5432 dbname=ent_factory user=ale password=basi2" ) or die ("Could not connect: " . pg_last_error()); 

    
    $nome=$_POST['inputName'];
    $cognome=$_POST['inputCog'];
    $email=$_POST['inputEmail'];
    $pass=$_POST['inputPass'];
    $options = [
        'cost' => 12,];              
    $passN=password_hash($pass, PASSWORD_BCRYPT, $options);

    
    //$data=pg_query_params($dbconn, $query4, array($prod_code,$nome , $categoria, $prezzo,$foto,$quantita_mag));
    $query3="UPDATE ef_schema.cliente SET nome='$nome', cognome='$cognome', 
    email='$email', pw='$passN' WHERE username=$1";
    $result3=pg_query_params($dbconn, $query3, array($username));
    //echo "fatto";
    $_SESSION['firstName']=$_POST['inputName'];    
    $_SESSION['lastName']=$_POST['inputCog'];
    $_SESSION['email']=$_POST['inputEmail'];

    header("Location:profile.php");
    



?>
    </body>
</html>
