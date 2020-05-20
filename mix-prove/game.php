<?php 
    $loggedin=false;
    session_start();
    if (isset($_SESSION['loggedin'])) {
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];

    $dbconn = pg_connect( "host=localhost port=5432 dbname=ent_factory user=ale password=basi2" ) or die ("Could not connect: " . pg_last_error()); 
    $q = "SELECT * FROM ef_schema.cliente WHERE username='$my_username'";
    $result = pg_query($q);
    $row = pg_fetch_assoc($result);
    $my_score = $row['score'];
    $q2="select max(score) from ef_schema.cliente";
    $result2 = pg_query($q2);
    $row2 = pg_fetch_assoc($result2);
    $general_score = $row2['max'];
  }
    
    else{
      header("Location:../home/index.php");
    }?>

<!DOCTYPE html>
<html>
<title>The Entertainment Factory - Play it!</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width-device−width, initial−scale=1"/>
<head>
<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="../fav/site.webmanifest">
	<link  rel="stylesheet" href="custom_game.css"/>
</head>
<body>
	
	<canvas id = "canvas" width="1000" height = "520"></canvas>
    <p> Press "Space" to start. To move use: <img  src="arrows.png">. <br>
        Try to catch as many food items as possible, 
        but avoid everything else!</p>


<p hidden id='gh_score'><?php echo $general_score; ?></p>
<p hidden id='score'><?php echo $my_score; ?></p>
<p hidden id='fs'><?php 
$fs=0;
if (isset($_GET['fs'])){
    $fs=$_GET['fs'];
}
echo $fs;
?></p>
<form hidden id="updateScore" name="updateScore" method="post" action="update_game.php">
<input type="hidden" name="Dscore" id="Dscore" value="<?php echo $my_score; ?>">
<input type="hidden" name="GHscore" id="GHscore" value="<?php echo $general_score; ?>"></form>





<script src="game_script.js"></script>
</body>
</html>