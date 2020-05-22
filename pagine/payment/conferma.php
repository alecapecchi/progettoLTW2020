<?php 
    $loggedin=false;
    session_start();
    if (isset($_SESSION['loggedin'])) {
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];
    $my_email=$_SESSION['email'];
  }
  ?>
<?php 
    //valori login da cambiare
    $my_username='mp';
    $loggedin=true;
    $email="alessandra.a.capecchi@gmail.com";
    ?>
<!DOCTYPE html>
<html>
<head>
<title>Confirmation</title>
<meta charset=" utf−8"/>
<meta name="viewport" content="width-device-width, initial−scale=1"/>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>
<link href="custompay.css" rel="stylesheet"/>
<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="../fav/site.webmanifest">
<body class="text-center" style="background-image: url(../login/cover_nologo.png);">
<?php
$dbconn = pg_connect( "host=localhost port=5432
dbname=ent_factory user=ale password=basi2" )
or die ("Could not connect: " . pg_last_error());
if (isset($_GET["id"]) ){
  $order_num = $_GET["id"];
}
else{ header('Location: ../home/index.php');
	exit;}


$_SESSION['arraycart']=array();
$_SESSION['total']=0;



$to_email = $email;
$subject = "Order Confirmation #".$order_num;
$body = "Hi ".$my_username.",
Your order #".$order_num." has been placed.
Did you know that you may check all your orders by visiting your profile page?
Thank you for shopping with us,
The Entertainment Factory Inc. Team.
";
$headers = "From: no-reply@gmail.com";
 
if (mail($to_email, $subject, $body, $headers)) {
    

        echo "<br><br><br><br><div class='container bg-faded'>
        <div class='row'>
          <div class='col-5 mx-auto'>
              <div class='card card-body mb-2'  style='border-radius: 20px;'>
              
                <img class='card-img-top mx-auto' src='logo_new.png' style='width: 200px;'>
              <p><b><u>ORDER CONFIRMATION #$order_num</u></b></p>
              <h2 class='mx-auto'>Thank you for your order!</h2>
              <br>
              <p class='mx-auto'>You'll receive a confirmation email shortly!</p>    
              <p><a href='../home/index.php'>Back home</a>    
              
              </div>
              </div> </div> </div>";
}

   


?>



</body>
</html>


