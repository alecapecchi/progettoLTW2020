<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset=" utf−8"/>
<meta name="viewport" content="width-device-width, initial−scale=1"/>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>
<link href="../signup/customsignup.css" rel="stylesheet"/>
<body class="text-center">
<?php

if(!(isset($_POST['login_btn']))){
    header("Location:../home/index.php");
}
if(isset($_POST['g-recaptcha-response'])){
  $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
  echo '<h2>Please check the the captcha form.</h2>';
  
}
if ( !isset($_POST['user'], $_POST['password']) ) {
	exit('Complete username e password!');
}
$secretKey = "6LeKK_cUAAAAAOhhA7_WEioSWA2XWc8qdIwSUn9U";
$ip = $_SERVER['REMOTE_ADDR'];
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response,true);
$firstName="";
    $lastName="";
    $email="";
    $score="";
if($responseKeys["success"]){
    session_start();
    $username=$_POST['user'];
    $dbconn = pg_connect( "host=localhost port=5432 dbname=ent_factory user=ale password=basi2" ) or die ("Could not connect: " . pg_last_error()); 
    $query1="SELECT *from ef_schema.cliente where username=$1";
    $result=pg_query_params($dbconn, $query1, array($username));
    $num_rows = pg_num_rows($result);
    
    
    if($num_rows>0){
        while($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
            $count=0;
            foreach($line as $col_value){
                if($count==1){$firstName=$col_value;}
                elseif($count==2){$lastName=$col_value;}
                elseif($count==3){$email=$col_value;}
                elseif($count==4){$pass=$col_value;}
                elseif($count==5){$score=$col_value;}
                $count+=1;
                

            }

            //echo $firstName." first ";
                //echo $lastName." last ";
                //echo $email." email ";
                //echo $score." score ";
          }

            if (password_verify($_POST['password'], $pass)) {
              session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $_POST['user'];
            $_SESSION['email'] = $email;
            $_SESSION['score'] = $score;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;

            if(isset($_SESSION['url'])) {
              $url = $_SESSION['url'];
               }
             else {
              $url = "/home/index.php"; }
              header("Location:http://localhost:3000$url");
            }
            else{
                echo "<br><br><br><br><div class='container bg-faded'>
                <div class='row'>
                  <div class='col-5 mx-auto'>
                      <div class='card card-body mb-2'  style='border-radius: 20px;'>
                        <img class='card-img-top mx-auto' src='../signup/logo_new.png' style='width: 200px;'>
                        
                      <h2 class='mx-auto'>Sorry, wrong username or password.
                       </h2>
                      <br>
                      <h5 class='mx-auto'><a href='login.php'>Try again!</a></h5>        
                      
                      </div>
                      </div> </div> </div>";
            }
    }
    else{
        echo "<br><br><br><br><div class='container bg-faded'>
        <div class='row'>
          <div class='col-5 mx-auto'>
              <div class='card card-body mb-2'  style='border-radius: 20px;'>
                <img class='card-img-top mx-auto' src='../signup/logo_new.png' style='width: 200px;'>
                
              <h2 class='mx-auto'>Sorry, wrong username or password.
               </h2>
              <br>
              <h5 class='mx-auto'><a href='login.php'>Try again!</a></h5>        
              
              </div>
              </div> </div> </div>";
    }
}
else {
  echo '<h2 style="color:white;">You look like a bot. If you are human, try again in a couple of minutes</h2>';
}


?>



</body>
</html>