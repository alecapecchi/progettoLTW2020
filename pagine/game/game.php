<?php 
    $loggedin=false;
    session_start();
    if (isset($_SESSION['loggedin'])) {
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];

    $dbconn = pg_connect( "host=localhost port=5432 dbname=ent_factory user=ale password=insert_passwordA" ) or die ("Could not connect: " . pg_last_error());
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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>

<link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="../fav/site.webmanifest">
	<link  rel="stylesheet" href="custom_game.css"/>
</head>
<body onload="startGame()">
    

<canvas id = "canvas" width="1000" height = "520"></canvas>
    
    <p>To move use: <img  src="arrows.png">. <br>
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

<p hidden id='new_game'><?php 
$newgame="t";
if (isset($_GET['fs'])){
    $newgame="f";
}
echo $newgame;
?></p>


  



<script>

var myGamePiece;
var gameOver=true;
var myScore;
var first_time=true;
const f_elements = ["apple", "book", "cake", "chair", "donut", "muffin", "pillow", "pizza", "pumpkin", "shoe"];
const good_f_elements = ["apple", "cake", "donut", "muffin", "pizza", "pumpkin"];

var current_elements=[];
var fall_int;


function startGame() {
    myPlayer = new componentP(90, 70, "basket.png", 430, 445);
    myGameArea.start();
    fall_int = setInterval(createElements, 1000);    
}

document.addEventListener("keydown", tasto_premuto, false);


function tasto_premuto(e) {
	if(gameOver && e.keyCode == 32){
    startGame();
    gameOver=false;
    first_time=false;}
	
}


function createElements(){
    if(!gameOver){
    x=Math.random() * 1000;
    var piece = f_elements[Math.floor(Math.random() * f_elements.length)];
    var gb="b";
    if(good_f_elements.includes(piece) ){
        var gb="g";
    }
    current_elements.push(new component(70, 70, piece+".png", x, 0, gb));
   }

}


var myGameArea = {
    canvas : document.getElementById("canvas"),
    start : function() {
        this.score=0;
        this.your_highscore=document.getElementById("score").innerHTML;
        this.general_highscore=document.getElementById("gh_score").innerHTML;
        this.lives=3;
        this.canvas.width = 1000;
        this.canvas.height = 520;
        this.context = this.canvas.getContext("2d");
        
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.interval = setInterval(updateGameArea, 20);        
        window.addEventListener('keydown', function (e) {
            myGameArea.key = e.keyCode;
        })
        window.addEventListener('keyup', function (e) {
            myGameArea.key = false;
        })
    }, 
    stop : function() {
        clearInterval(this.interval);
    },    
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }
}


function component(width, height, pic, x, y,gb) {
    this.width = width;
    this.height = height;
    this.x = x;
    this.y = y;
    this.gb=gb;    
    this.speedX = 0;
    this.speedY = 0;    
    this.gravity = 0.05;
    this.gravitySpeed = 0;
    this.potential_point=true;
    this.update = function() {
        ctx = myGameArea.context;
        var img = new Image();
        img.src = pic;
        ctx.drawImage(img, this.x, this.y, this.width, this.height);
        ctx.fill();
    }
    this.newPos = function() {
        this.gravitySpeed += this.gravity;
        this.x += this.speedX;
        this.y += this.speedY + this.gravitySpeed;
        this.hitBasket();
    }
    this.hitBasket = function() {
        var rockbottom = myGameArea.canvas.height - this.height;
        var bottom = myGameArea.canvas.height;
        if (this.y >= rockbottom && this.y <= bottom && this.x>= myPlayer.x-37 && this.x<=myPlayer.x+90 && this.potential_point) {
            this.y =1000;
            this.potential_point=false;
           if(this.gb==="g"){
            myGameArea.score+=1;}
            else{
                myGameArea.lives=myGameArea.lives-1;
                if(myGameArea.lives<=0){
                    gameOver=true;
                }
            }
        }
    }
}


function componentP(width, height, pic2, x, y) {
    this.gamearea = myGameArea;
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;    
    this.x = x;
    this.y = y;    
    this.update = function() {
        ctx = myGameArea.context;
        
        var img = new Image();
        img.src = pic2;
        ctx.drawImage(img, this.x, this.y, this.width, this.height);
        ctx.fill();
    }
    this.newPos = function() {
        this.x += this.speedX;        
        this.y += this.speedY;        
    }
}






function updateGameArea() {
    if(!gameOver){
    myGameArea.clear();
    context=myGameArea.context;
    context.fillStyle = "black";
    context.font = "20px Calibri";
    
	context.textAlign = "left";
	context.fillText("Lives: " + myGameArea.lives, 50, 50);


	context.textAlign = "center";
    context.fillText("Score: " + myGameArea.score, canvas.width/2, 50);
    
    ghs=myGameArea.general_highscore;
    if(myGameArea.score>myGameArea.general_highscore){
        ghs=myGameArea.score;
    }
	context.textAlign = "right";
	context.fillText("General Highscore: " +  ghs, canvas.width-50, 50);
    


    myPlayer.speedX = 0;
    myPlayer.speedY = 0;   
    if (myGameArea.key && myGameArea.key == 37) {myPlayer.speedX = -7;
         }
    if (myGameArea.key && myGameArea.key == 39) {myPlayer.speedX = 7; }
    myPlayer.newPos();    
    myPlayer.update();

    var i;
    for (i = 0; i < current_elements.length; i++) {
        myGamePiece=current_elements[i];
        myGamePiece.newPos();
        myGamePiece.update();
        }
    
    
}
else{
    myGameArea.clear();
    clearInterval(fall_int);
    myGameArea.stop();
    context=myGameArea.context;
    new_game=document.getElementById("new_game").innerHTML;
    
    if(new_game==="t" && first_time){
        
    context.fillStyle = "orangered";
	context.font = "100px fantasy";
    context.textAlign = "center";
    context.fillText("START GAME", canvas.width/2, 175);

    context.fillStyle = "black";
    context.font = "25px Calibri";

    context.fillText("YOUR HIGHSCORE: " + myGameArea.your_highscore, canvas.width/2, 280);
	
	context.fillText("GENERAL HIGHSCORE: " + myGameArea.general_highscore, canvas.width/2, 350);
    
    context.fillStyle = "white";
	context.font = "23px Calibri";
	
    
    

}
    else{
    context.fillStyle = "orangered";
	context.font = "100px fantasy";
    context.textAlign = "center";
    context.fillText("GAME OVER!", canvas.width/2, 175);

    context.fillStyle = "black";
    context.font = "25px Calibri";
    
    GOscore=myGameArea.score;
    if(first_time){GOscore=document.getElementById("fs").innerHTML;}
    context.fillText("FINAL SCORE: " + GOscore, canvas.width/2, 260);
    if(myGameArea.score>myGameArea.your_highscore){
            
			window.location.href = 'update_game.php?score='+myGameArea.score;
			
        }
    context.fillText("YOUR HIGHSCORE: " + myGameArea.your_highscore, canvas.width/2, 310);
	
	context.fillText("GENERAL HIGHSCORE: " + myGameArea.general_highscore, canvas.width/2, 360);

    context.fillStyle = "white";
	context.font = "23px Calibri";
	



}
context.fillText("PRESS SPACE TO PLAY", canvas.width/2, 475);

    
}

}

</script>



</body>
</html>

