<?php 
    //Gioco in javascript, attraverso canvas html
    //valori della sessione
    $loggedin=false;
    session_start();
    if (isset($_SESSION['loggedin'])) {
    $my_username=$_SESSION['name'];
    $loggedin=$_SESSION['loggedin'];

    //dal db prende l'highscore generale, e l'highscore dell'utente
    $dbconn = pg_connect( "host=localhost port=5432 dbname=ent_factory user=ale password=inserisciPasswordA" ) or die ("Could not connect: " . pg_last_error());
    $q = "SELECT * FROM ef_schema.cliente WHERE username='$my_username'";
    $result = pg_query($q);
    $row = pg_fetch_assoc($result);
    $my_score = $row['score'];
    $q2="SELECT max(score) from ef_schema.cliente";
    $result2 = pg_query($q2);
    $row2 = pg_fetch_assoc($result2);
    $general_score = $row2['max'];
  }
    
    else{
        //se non loggato torna all'homepage
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
    

<!--parametri nascosti, presi dal db-->
<p hidden id='gh_score'><?php echo $general_score; ?></p>
<p hidden id='score'><?php echo $my_score; ?></p>
<p hidden id='fs'><?php 
$fs=0;
//nel caso in cui si fosse tornati nella pagina dopo un aggiornamento del db, prende il valore del final
//score dal db
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

var current_elements=[];//array degli elementi in caduta inizializzati
var fall_int;


function startGame() {
    myPlayer = new componentP(90, 70, "basket.png", 430, 445);//giocatore
    myGameArea.start();
    fall_int = setInterval(createElements, 1000);//ogni secondo un nuovo elemento viene creato tramite createElements
}

document.addEventListener("keydown", tasto_premuto, false);


function tasto_premuto(e) {
	if(gameOver && e.keyCode == 32){//se viene premuta la barra spaziatrice, si riinizia il gioco
    startGame();
    gameOver=false;
    first_time=false;}
	
}


function createElements(){
    if(!gameOver){//se non siamo in gameover, un nuovo elemento (con immagine random) viene creato e aggiunto all'array
    x=Math.random() * 1000;
    var piece = f_elements[Math.floor(Math.random() * f_elements.length)];
    var gb="b";
    if(good_f_elements.includes(piece) ){//controlla se l'elemento è nella lista dei "buoni"
        var gb="g";
    }
    current_elements.push(new component(70, 70, piece+".png", x, 0, gb));
   }

}


var myGameArea = {
    canvas : document.getElementById("canvas"),
    start : function() {
        //setta i valori all'inizio di ogni partita
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
    //invocata da createElements()
    //crea un elemento in caduta libera
    this.width = width;
    this.height = height;
    this.x = x;
    this.y = y;
    this.gb=gb;//se l'elemento è "buono" o "cattivo"
    this.speedX = 0;
    this.speedY = 0;    
    this.gravity = 0.05;
    this.gravitySpeed = 0;
    this.potential_point=true;//controlla se l'elemento è stato già catturato
    this.update = function() {
        ctx = myGameArea.context;
        var img = new Image();
        img.src = pic;
        ctx.drawImage(img, this.x, this.y, this.width, this.height);//disegna l'elemento sulla canva
        ctx.fill();
    }
    this.newPos = function() {
        //modifica la posizione dell'elemento
        this.gravitySpeed += this.gravity;
        this.x += this.speedX;
        this.y += this.speedY + this.gravitySpeed;
        this.hitBasket();
    }
    this.hitBasket = function() {
        var rockbottom = myGameArea.canvas.height - this.height;
        var bottom = myGameArea.canvas.height;
        //controlla se l'elemento è entrato nell'are del cestino e se il punto non è già stato assegnato
        if (this.y >= rockbottom && this.y <= bottom && this.x>= myPlayer.x-37 && this.x<=myPlayer.x+90 && this.potential_point) {
            this.y =1000;//fa "sparire" (la canvas è alta 520) l'elemento dallo schermo
            this.potential_point=false;
           if(this.gb==="g"){//se l'elemento è buono aggiunge un punto
            myGameArea.score+=1;}
            else{//altrimenti diminuisce le vite
                myGameArea.lives=myGameArea.lives-1;
                if(myGameArea.lives<=0){//se le vite<=0, il gioco finisce
                    gameOver=true;
                }
            }
        }
    }
}


function componentP(width, height, pic2, x, y) {//crea l'elemento giocatore
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
    if(!gameOver){//se il gioco è in corso
    myGameArea.clear();
    context=myGameArea.context;
    context.fillStyle = "black";
    context.font = "20px Calibri";
    
	context.textAlign = "left";
	context.fillText("Lives: " + myGameArea.lives, 50, 50);//mostra le vite


	context.textAlign = "center";
    context.fillText("Score: " + myGameArea.score, canvas.width/2, 50);//mostra il punteggio
    
    ghs=myGameArea.general_highscore;
    if(myGameArea.score>myGameArea.general_highscore){
        ghs=myGameArea.score;
    }
	context.textAlign = "right";
	context.fillText("General Highscore: " +  ghs, canvas.width-50, 50);//mostra il general highscore, 
    //se score>general_highscore, allora mostra il punteggio
    


    myPlayer.speedX = 0;
    myPlayer.speedY = 0;   
    if (myGameArea.key && myGameArea.key == 37) {
        //se l'utente spinge la freccia sinistra, muovi il giocatore a sinistra
        myPlayer.speedX = -7;
         }
    if (myGameArea.key && myGameArea.key == 39) {
        //se spinge la freccia destra, muovi il giocatore a destra
        myPlayer.speedX = 7; }
    myPlayer.newPos();    
    myPlayer.update();

    var i;
    for (i = 0; i < current_elements.length; i++) {//aggiorna la posizione degli elementi in caduta libera
        myGamePiece=current_elements[i];
        myGamePiece.newPos();
        myGamePiece.update();
        }
    
    
}
else{//se game over
    myGameArea.clear();
    clearInterval(fall_int);
    myGameArea.stop();
    context=myGameArea.context;
    new_game=document.getElementById("new_game").innerHTML;
    
    if(new_game==="t" && first_time){
    //se la schermata di gioco è stata appena aperta (non abbiamo appena terminato una partita),
    // mostriamo la scritta "Start Game", l'highscore(giocatore) e l'highscore(generale)
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
    //se abbiamo finito una partita 
    //mostriamo la scritta "Game Over", il final score, l'highscore(giocatore) e l'highscore(generale)
    context.fillStyle = "orangered";
	context.font = "100px fantasy";
    context.textAlign = "center";
    context.fillText("GAME OVER!", canvas.width/2, 175);

    context.fillStyle = "black";
    context.font = "25px Calibri";
    
    GOscore=myGameArea.score;
    if(first_time){GOscore=document.getElementById("fs").innerHTML;}
    context.fillText("FINAL SCORE: " + GOscore, canvas.width/2, 260);
    if(myGameArea.score>myGameArea.your_highscore){//se abbiamo battuto l'highscore aggiorniamo il db
            
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

