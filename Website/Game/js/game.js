/** THE GAME
 * Author: Anthony Cloudy
 * Learning from a tutorial on http://blog.sklambert.com/html5-canvas-game-panning-a-background/
 * Sections are copied from that website, but mostly I'm trying to rewrite them as much as possible
 */

//The path to the resources folder for the game
var path = "../../Resources/Game/";
var avatarPath = "../../Resources/Avatars/PastelGreg.png";

//Global variables for game control
var gamePlaying = true;
var lose = false;
var mute = true;

var avatarMoveTo = 0;
var numCards;
var avatarInc;

var currCard;

var lives;
var question;
var answer;

var numRight;
//Game Mode variables
this.GameMode = {
    Training : 0,
    Quest : 1,
    SaveTheWorld : 2
}
// var gameMode = GameMode.Training;

//size the parent div to wrap the content


var funQueue = [];

/**
 * Misc functions
 */

//Modified from: http://krazydad.com/tutorials/makecolors.php
function colorFromPhase(phase) {
  phase = (phase - 20) * .01;
  var center = 104;
  var width = 127;
  var red   = Math.floor(Math.sin(2 + phase) * width + center);
  var green = Math.floor(Math.sin(0 + phase) * width + center);
  var blue  = Math.floor(Math.sin(4 + phase) * width + center); 
  return "rgba(" + red + "," + green + "," + blue + ", 1)";
}

// Function wrapping code.
// fn - reference to function.
// context - what you want "this" to be.
// params - array of parameters to pass to function.
// Shamelessly stolen from http://stackoverflow.com/questions/899102/how-do-i-store-javascript-functions-in-a-queue-for-them-to-be-executed-eventuall
var wrapFunction = function(fn, context, params) {
    return function() {
        fn.apply(context, params);
    };
}

/**
 * Define an object to hold all our images for the game so images
 * are only ever created once. This type of object is known as a
 * singleton.
 */
var iRepo = new function() {
  // Define images
  this.background = new Image();
  this.monster = new Image();
  this.avatar = new Image();
  this.heart = new Image();
  this.scroll = new Image();
  
  var numImages = 5;
  var numLoaded = 0;
  
  function imageLoaded() {
    numLoaded++;
    if (numLoaded === numImages) {
      console.log("Images Loaded");
      // $('.answer').hide();
      window.init();
    }
  }
  
  this.background.onload = function() {
    imageLoaded();
  }
  
  this.monster.onload = function() {
    imageLoaded();
  }
  
  this.avatar.onload = function() {
    imageLoaded();
  }
  
  this.heart.onload = function() {
    imageLoaded();
  }
  
  this.scroll.onload = function() {
    imageLoaded();
  }
  
  // Set images src
  this.background.src = path + randomBackground();
  this.monster.src = randomMonster(6);
  this.avatar.src = avatarPath;
  this.heart.src = path + "/Sprites/Heart.png";
  this.scroll.src = path + "/Sprites/Scroll1.png";
}

function loadMonster(src, callback) {
  
  iRepo.monster.src = src;
  iRepo.monster.onload = callback;
}

function nextCard() {
  
  if (deck.cards.length != 0) {
    currCard = deck.draw();
    setQuestion(currCard.question);
    game.monster.change(currCard.category);
    iRepo.background.src = path + randomBackground();
    avatarMoveTo = avatarMoveTo + avatarInc;
  }
  else {
    avatarMoveTo = avatarMoveTo + avatarInc;
    gamePlaying = false;
  }
}

function setQuestion(q) {
  question = "Q: " + q;
}

function loseLife() {
  lives = lives - 1;
  if (lives == 0) {
    gamePlaying = false; 
    lose = true;
    game.heart.timer = 199;
    game.heart.lose();
  }
  else {
    game.heart.timer = 29;
    game.heart.toggle = true;
    game.heart.hurt();
  }
}

function submitAnswer() {
  if (gamePlaying) {
    if (currCard.answer == game.input._value) {
      nextCard();
    }
    else {
      numRight--;
      if (gameMode > GameMode.Training)
         loseLife();
      nextCard();
    }
    game.input._value = "";
  }
}

//Picks a random monster image from the available pool of monsters
function randomMonster(category) {
  switch(category){
    case 1: //Math
      var choice = Math.floor((Math.random() * 50) + 1);
      return "../../Resources/Game/Sprites/Math/" + choice + ".png";
    case 2:
      var choice = Math.floor((Math.random() * 40) + 1);
      return "../../Resources/Game/Sprites/Science/" + choice + ".png";
    case 3:
      var choice = Math.floor((Math.random() * 40) + 1);
      return "../../Resources/Game/Sprites/SocialStudies/" + choice + ".png";
    case 4:
      var choice = Math.floor((Math.random() * 45) + 1);
      return "../../Resources/Game/Sprites/English/" + choice + ".png";
    case 5:
      var choice = Math.floor((Math.random() * 45) + 1);
      return "../../Resources/Game/Sprites/Languages/" + choice + ".png";
    case 6:
      var choice = Math.floor((Math.random() * 50) + 1);
      return "../../Resources/Game/Sprites/Misc/" + choice + ".png";
    default:
      console.log("No category or invalid category passed! ONO");
      var choice = Math.floor((Math.random() * 50) + 1);
      return "../../Resources/Game/Sprites/Misc/" + choice + ".png";
  }
}

//Picks a random background image from the available pool of backgrounds
function randomBackground() {
  var choice = Math.floor((Math.random() * 30) + 1);
  if (choice === 1)
    return "Backgrounds/Altar.png";
  
  else if (choice === 2)
    return "Backgrounds/Altar2.png";
  
  else if (choice === 3)
    return "Backgrounds/Castle1.png";
  
  else if (choice === 4)
    return "Backgrounds/Castle2.png";
  
  else if (choice === 5)
    return "Backgrounds/Castle3.png";
  
  else if (choice === 6)
    return "Backgrounds/Castle4.png";
  
  else if (choice === 7)
    return "Backgrounds/CastleGate.png";
  
  else if (choice === 8)
    return "Backgrounds/CastleGrounds.png";
  
  else if (choice === 9)
    return "Backgrounds/Cave.png";
  
  else if (choice === 10)
    return "Backgrounds/Cave2.png";
  
  else if (choice === 11)
    return "Backgrounds/Cave3.png";
  
  else if (choice === 12)
    return "Backgrounds/Cliff.png";

  else if (choice === 13)
    return "Backgrounds/Desert.png";

  else if (choice === 14)
    return "Backgrounds/DesertTemple.png";
  
  else if (choice === 15)
    return "Backgrounds/Forest.png";
  
  else if (choice === 16)
    return "Backgrounds/Forest2.png";
  
  else if (choice === 17)
    return "Backgrounds/Landscape.png";
  
  else if (choice === 18)
    return "Backgrounds/Landscape2.png";
  
  else if (choice === 19)
    return "Backgrounds/Mine.png";
  
  else if (choice === 20)
    return "Backgrounds/Mine2.png";
  
  else if (choice === 21)
    return "Backgrounds/Mountain.png";
  
  else if (choice === 22)
    return "Backgrounds/Ocean.png";
  
  else if (choice === 23)
    return "Backgrounds/Plains.png";
  
  else if (choice === 24)
    return "Backgrounds/Prison.png";
  
  else if (choice === 25)
    return "Backgrounds/Prison2.png";
  
  else if (choice === 26)
    return "Backgrounds/PurpleOcean.png";
  
  else if (choice === 27)
    return "Backgrounds/Temple.png";
  
  else if (choice === 28)
    return "Backgrounds/Temple2.png";
  
  else if (choice === 29)
    return "Backgrounds/Volcano.png";
  
  else if (choice === 30)
    return "Backgrounds/Volcano2.png";
  
}

//The interface for anything that gets drawn on screen
function Drawable() {
  
  this.init = function(x, y, width, height) {
    //Default variables
    this.x = x;
    this.y = y;
    this.width = width;
    this.height = height;
  };
  
  this.speed = 0;
  this.canvasWidth = 0;
  this.canvasHeight = 0;
  
  //Implemented in children
  this.draw = function() {};
}

/**
 * Canvas Creation
 */

function Background() {
  
  this.draw = function() {
    this.context.drawImage(iRepo.background, this.x, this.y, this.width, this.height);
    //this.context.fillRect(0, 333, 765, 666);
  };
}

function Monster() {
  
  this.idleVal = 0;
  this.idleUp = true;
  
  this.draw = function() {
    this.context.drawImage(iRepo.monster, this.x, this.y, this.width, this.height);
  };
  
  this.clearAll = function() {
    this.context.clearRect(0, 0, 765, 333);
  };
  
  this.clear = function() {
    this.context.clearRect(this.x, this.y - 1, this.width, this.height + 1);
  };
  
  this.change = function(category) {
      loadMonster(randomMonster(category), function() {
      game.monster.width = iRepo.monster.width;
      game.monster.height = iRepo.monster.height;
      game.monster.x = 382.5 - (iRepo.monster.width/2);
      game.monster.y = 168 - (iRepo.monster.height/2);
      game.monster.clearAll();
    });
  };
  
  //Make the monster float up and down in an idling sequence
  this.idle = function() {  
    //If we hit a boundary, then change direction
    if (this.idleVal == 20)
      this.idleUp = false;
    
    else if (this.idleVal == -20)
      this.idleUp = true;
        
    if (this.idleUp) {
      this.idleVal++;
      if (this.idleVal % 10 == 0)
      	this.y++;
    }
    else {
      this.idleVal--;
      if (this.idleVal % 10 == 0)
      	this.y--;
    }
  };
}

function Avatar() {
  
  this.pointCache = 0;
  
  this.draw = function() {
    this.clear();
    this.context.drawImage(iRepo.avatar, this.x, this.y, this.width, this.height);
  };
  
  this.clear = function() {
    this.context.clearRect(0, this.y, 765, this.height);
  };
  
  this.move = function(nextPoint) {
    if (this.x < nextPoint) {
      if (this.pointCache != nextPoint) {
	      this.pointCache = nextPoint;
	      this.turningPoint = (this.pointCache - this.x)/2 + this.x;
	      this.multiplier = 2;
      }
      
      if (this.x <= this.turningPoint) {
	      this.x = this.x + this.multiplier;
	      this.multiplier++;
      }
      else {
	      this.x = this.x + this.multiplier;
	      this.multiplier--;
	      if (this.multiplier < 1)
	         this.multiplier = 2;
      }
      
      if (this.x > nextPoint) {
	      this.x = nextPoint;
	      this.multiplier = 20;
      }
      //Code for a rainbow trail:
      //this.context.fillStyle = colorFromPhase(this.x);
      //this.context.fillRect(this.x, this.y, this.width - 25, this.height);
    }
  };
}

function Etc(Image) { 
  
  this.image = Image;
  
  this.draw = function() {
    this.context.drawImage(this.image, this.x, this.y, this.width, this.height);
  };
  
  this.hurt = function() 
  {
      this.timer --;
      
      if (this.timer > 0)
      {
	if (this.timer % 5 == 0)
	{
	  this.toggle = !this.toggle;
	  
	  if (this.toggle)
	  {
	    this.context.fillStyle = "rgba(255,0,0,.5)";
	    this.context.fillRect(0, 0, 765, 335);
	  }
	  else
	  {
	    this.context.clearRect(0, 0, 765, 335);
	  }
	}

	var func = wrapFunction(this.hurt, this, []);
	funQueue.push(func);
      }
      
  };
  
  this.lose = function() 
  {
      this.timer --;
      
      if (this.timer > 0)
      {
	if (this.timer % 5 == 0)
	{	  
	  this.context.fillStyle = "rgba(255,0,0,.1)";
	  this.context.fillRect(0, 0, 765, 335);
	}

	var func = wrapFunction(this.lose, this, []);
	funQueue.push(func);
      }
      
  };
}


//Get the background object to copy all of Drawable's information
Background.prototype = new Drawable();
Avatar.prototype = new Drawable();
Monster.prototype = new Drawable();
Etc.prototype = new Drawable();

function Game() {

  this.init = function() {
    //Grab the canvas from the page
    this.bgCanvas = document.getElementById('background');
    this.mCanvas = document.getElementById('monster');
    this.aCanvas = document.getElementById('avatar');
    this.eCanvas = document.getElementById('etc');
    this.input = new CanvasInput({
      canvas: document.getElementById('input'),
      x: 170,
      y: 560,
      width:400,
      height: 35,
      fontFamily: 'VT323',
      fontSize: 30,
      fontColor: '#DDDDDD',
      placeHolder: 'Enter an Answer...',
      backgroundColor: '#222222',
      borderColor: '#FF9900',
      boxShadow: '1px 1px 0px rgba(0, 0, 0, 1)',
      onsubmit: function() {submitAnswer()}
    });
    //Check to see if we can use the canvas
    if (this.bgCanvas.getContext) {
      this.bgContext = this.bgCanvas.getContext('2d');
      this.mContext = this.mCanvas.getContext('2d');
      this.aContext = this.aCanvas.getContext('2d');
      this.eContext = this.eCanvas.getContext('2d');
      
      Background.prototype.context = this.bgContext;
      Background.prototype.canvasWidth = this.bgCanvas.width;
      Background.prototype.canvasHeight = this.bgCanvas.height;
      
      Monster.prototype.context = this.mContext;
      Monster.prototype.canvasWidth = this.mCanvas.width;
      Monster.prototype.canvasHeight = this.mCanvas.height;
      
      Avatar.prototype.context = this.aContext;
      Avatar.prototype.canvasWidth = this.aCanvas.width;
      Avatar.prototype.canvasHeight = this.aCanvas.height;

      Etc.prototype.context = this.eContext;
      Etc.prototype.canvasWidth = this.eCanvas.width;
      Etc.prototype.canvasHeight = this.eCanvas.height;
      
      this.background = new Background();
      this.background.init(0, 0, iRepo.background.width, iRepo.background.height);
      
      if (gameMode > GameMode.Training) {
	      this.heart = new Etc(iRepo.heart);
	      this.heart.init(575, 55, iRepo.heart.width, iRepo.heart.height);
	      this.scroll = new Etc(iRepo.scroll);
	      this.scroll.init(510, 30, iRepo.scroll.width, iRepo.scroll.height);
      }
      
      this.monster = new Monster();
      //Center the monster in the middle of the screen.
      var monsterX = 382.5 - (iRepo.monster.width/2);
      var monsterY = 168 - (iRepo.monster.height/2);
      this.monster.init(monsterX, monsterY, iRepo.monster.width, iRepo.monster.height);
      
      this.avatar = new Avatar();
      this.avatar.init(0, 333 - iRepo.avatar.height/2, iRepo.avatar.width, iRepo.avatar.height);
      
      game.start();
    }
    //Return if we don't have canvas support on this bozo's computer. IE6 PROBLEMS >:I
    else  
      return;
  };
  
  this.start = function() {
    $('.loading').remove();
    $('.loadingImage').remove();
    // $('.answer').show();
    animate();
  };
}
      
/**
 * The animation loop. Calls the requestAnimationFrame shim to
 * optimize the game loop and draws all game objects. This
 * function must be a gobal function and cannot be within an
 * object.
 */
function animate() {
  requestAnimFrame(animate);
  
  if (gamePlaying) {
    game.background.draw();

    game.monster.clear();
    game.monster.idle();
    game.monster.draw();

    document.getElementById('question').innerHTML = question;  
    // document.getElementById('answer').innerHTML = game.input._value;  
    
    if (funQueue.length != 0) {
      (funQueue.shift())();
    }
  }
  
  else if(lose){
    document.getElementById('question').innerHTML = "YOU HAVE LOST! "  + numRight + "/" + numCards;  
    if (funQueue.length != 0) {
      (funQueue.shift())();
    }
  }
  
  else{
    document.getElementById('question').innerHTML = "WINNER WINNER CHICKEN DINNER! " + numRight + "/" + numCards; 
  }
   
  if (gameMode > GameMode.Training) {
    game.scroll.draw();
    game.heart.draw();
    document.getElementById('lives').innerHTML = " x" + lives;  
  }
  
  game.avatar.draw();
  game.avatar.move(avatarMoveTo);

}
 
/**
 * requestAnim shim layer by Paul Irish
 * Finds the first API that works to optimize the animation loop,
 * otherwise defaults to setTimeout().
 */
window.requestAnimFrame = (function(){
  return  window.requestAnimationFrame   ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame    ||
      window.oRequestAnimationFrame      ||
      window.msRequestAnimationFrame     ||
      function(/* function */ callback, /* DOMElement */ element){
        window.setTimeout(callback, 1000 / 60);
      };
})();

var game = new Game();
var deck;
var gameMode;

function init() {
  // gameMode = GameMode.Quest;
  $.getScript("js/requests.js", function(){
    deck = deck1;
    gameMode = md;
    deck.shuffle();
    numCards = deck.cards.length;
    numRight = numCards;
    avatarInc = 715 / numCards;
    currCard = deck.draw();
    lives = numCards - Math.ceil(numCards * .7) + 1;
    setQuestion(currCard.question);
    game.init();
  });

}
