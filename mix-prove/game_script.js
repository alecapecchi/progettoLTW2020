var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
var gameOver = true;
var left_arrow = false;
var right_arrow = false;
var score = 0;
var lives = 3;
var track = 0;
var badTrack = 0;
var level = 1;
var your_highscore=document.getElementById("score").innerHTML;
var general_highscore=document.getElementById("gh_score").innerHTML;
var score=document.getElementById("fs").innerHTML;



document.addEventListener("keydown", tasto_premuto, false);
document.addEventListener("keyup", tasto_nonpremuto, false);

function tasto_nonpremuto(e) {
	if(e.keyCode == 39){
		right_arrow = false;
	}
	else if(e.keyCode == 37){
		left_arrow = false;
	}
	
}

function tasto_premuto(e) {
	if(e.keyCode == 39){
		right_arrow = true;
	}
	else if(e.keyCode == 37){
		left_arrow = true;
	}
	else if(gameOver){
		playAgain();
	}
}


var player = {
	size: 70,
	x: (canvas.width -70)/ 2,
	y: canvas.height - 70
};

// specs for balls you want to collect
var goodArc = {
	x:[],
	y:[],
	speed: 2,
	color: ["red","blue","yellow"],
	state: []
};
var redNum = 0;

// specs for balls you want to avoid
var badArc = {
	x:[],
	y:[],
	speed: 2,
	color: ["black", "purple", "#003300", "#663300", "white"]

};
var blackNum = 0;
var rad = 10;

// adds value to x property of goodArc
function drawNewGood(){
	if(Math.random() < .02){
		goodArc.x.push(Math.random() * canvas.width);
		goodArc.y.push(0);
		goodArc.state.push(true);

	}
	redNum = goodArc.x.length;
}

//adds values to x property of badArc
function drawNewBad() {
	if(score < 30){
		if(Math.random() < .05){
			badArc.x.push(Math.random() * canvas.width);
			badArc.y.push(0);
		}
	}
	else if(score < 50){
		if(Math.random() < .1){
			badArc.x.push(Math.random() * canvas.width);
			badArc.y.push(0);
		}
	}
	else{
		if(Math.random() < .2){
			badArc.x.push(Math.random() * canvas.width);
			badArc.y.push(0);
		}
	}
	blackNum = badArc.x.length;
}

// draws red and blue balls
function drawRedBall() {
	for(var i = 0; i < redNum; i++){
		if(goodArc.state[i] == true){
			//Keeps track of position in color array with changing redNum size
			var trackCol = (i + track);
		
			context.beginPath();
			context.arc(goodArc.x[i], goodArc.y[i], rad, 0, Math.PI * 2);
			context.fillStyle = goodArc.color[trackCol % 3];
			context.fill();
			context.closePath();
		}
	}
}

// draws black ball to avoid
function drawBlackBall() {
	for(var i = 0; i < blackNum; i++){
		//Keeps track of position in color array with changing blackNum size
		var badCol = (i + badTrack);
		
		context.beginPath();
		context.arc(badArc.x[i], badArc.y[i], rad, 0, Math.PI * 2);
		context.fillStyle = badArc.color[badCol % 5];
		context.fill();
		context.closePath();
	}
}
// draw player to canvas
function drawPlayer() {
	context.beginPath();

var img = new Image();
img.src = "basket.png";

context.drawImage(img, player.x, player.y, player.size+20, player.size);
//requestAnimationFrame(update);

	//context.rect(player.x, player.y, player.size, player.size);
	//context.fillStyle = player.color;
	context.fill();
	context.closePath();
}

// moves objects in play
function playUpdate() {
	
	if(left_arrow && player.x > 0){
		player.x -= 7;
	}
	if(right_arrow && player.x + player.size < canvas.width) {
		player.x += 7;
	}
	for(var i = 0; i < redNum; i++){
		goodArc.y[i] += goodArc.speed;
	}
	for(var i = 0; i < blackNum; i++){
		badArc.y[i] += badArc.speed;
	}
	
	// collision detection
	for(var i = 0; i < redNum; i++){
		// Only counts collision once
		if(goodArc.state[i]){
			if(player.x < goodArc.x[i] + rad && player.x + 90 + rad> goodArc.x[i] && player.y < goodArc.y[i] + rad && player.y + 70 > goodArc.y[i]){
				score++
				// Cycles through goodArc's color array
				//player.color = goodArc.color[(i + track) % 3];
				goodArc.state[i] = false;
			}
		}
		// Removes circles from array that are no longer in play
		if(goodArc.y[i] + rad > canvas.height){
			goodArc.x.shift();
			goodArc.y.shift();
			goodArc.state.shift();
			track++;
		}
	}
	for(var i = 0; i < blackNum; i++){
		if(player.x < badArc.x[i] + rad && player.x +90 + rad > badArc.x[i] && player.y < badArc.y[i] + rad && player.y + 70 > badArc.y[i]){
			lives--;
			//player.color = badArc.color[(i+badTrack)%5];
			badArc.y[i] = 0;
			if(lives <= 0){
				gamesOver();
			}
		}
		// Removes circles from x and y arrays that are no longer in play
		if(badArc.y[i] + rad > canvas.height){
			badArc.x.shift();
			badArc.y.shift();
			badTrack++;
		}
	}
	switch(score){
		case 20:
			badArc.speed = 3;
			goodArc.speed = 3;
			level = 2;
			break;
		case 30:
			level = 3;
			break;
		case 40: 
			goodArc.speed = 4;
			level = 4;
			break;
		case 50:
			level = 5;
			break;
	}

}
//signals end of game and resets x, y, and state arrays for arcs
function gamesOver(){
	goodArc.x = [];
	badArc.x = [];
	goodArc.y = [];
	badArc.y = [];
	goodArc.state = [];
	gameOver = true;
}

//resets game, life, and score counters
function playAgain() {
	gameOver = false;
	level = 1;
	score = 0;
	lives = 3;
	badArc.speed = 2;
	goodArc.speed = 2;
}



function draw(){
	context.clearRect(0, 0, canvas.width, canvas.height);
	if(!gameOver){
		drawPlayer();
		drawBlackBall();
		drawRedBall();
		playUpdate();
		drawNewGood();
		drawNewBad();
			
		context.fillStyle = "black";
		context.textAlign = "left";
		context.fillText("Lives: " + lives, 50, 25);

		
		context.fillStyle = "black";
		context.font = "20px Calibri";
		context.textAlign = "center";
		context.fillText("Score: " + score, canvas.width/2, 25);

		
		context.fillStyle = "black";
		context.font = "20px Calibri";
		context.textAlign = "right";
		context.fillText("General Highscore: " + general_highscore, canvas.width-50, 25);
	
	}
	else{
		context.fillStyle = "orangered";
		context.font = "100px fantasy";
		context.textAlign = "center";

		context.fillText("GAME OVER!", canvas.width/2, 175);

		context.fillStyle = "black";
		context.font = "25px Calibri";
		context.fillText("FINAL SCORE: " + score, canvas.width/2, 260);
		if(score>your_highscore){
			your_highscore=score;
			window.location.href = 'update_game.php?score='+score;
			
		}
		context.fillText("YOUR HIGHSCORE: " + your_highscore, canvas.width/2, 310);
		if(your_highscore>general_highscore){
			general_highscore = your_highscore;
		}
		context.fillText("GENERAL HIGHSCORE: " + general_highscore, canvas.width/2, 360);
		
		context.font = "20px Calibri";
		context.fillText("PRESS SPACE TO PLAY", canvas.width/2, 475);
		
	}
	
	requestAnimationFrame(draw);
}



draw();