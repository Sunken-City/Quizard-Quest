/** THE GAME
 * Author: Anthony Cloudy
 * Learning from a tutorial on http://blog.sklambert.com/html5-canvas-game-panning-a-background/
 * Sections are copied from that website, but mostly I'm trying to rewrite them as much as possible
 */

//The path to the resources folder for the game
var path = "../../Resources/Game/";
var avatarPath = "../../Resources/Avatars/Greg.png";

//Global variables for game control
var gamePlaying = true;
var lose = false;
var mute = true;

var avatarMoveTo = 0;
var numCards;
var avatarInc;

var currCard;

var lives;
var time = "00:00";
var seconds = 15;
var minutes = 0;
var timeLimit;
var question;
var answer;

var start;

var goldEarned;
var XPGained;
var XPCategory = [];

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

//Function that checks the current time, and updates the timer.
function increaseTimer() {
  
  var currTime = (new Date().getTime() - start);

      var elapsed = Math.floor(currTime / 1000);
      seconds += elapsed - (60 * minutes) - seconds;
      if (seconds > 59) {
	seconds -= 60;
	minutes++;
      }
      
      if (minutes < 10)
	time = "0" + minutes + ":";
      else
	time = minutes + ":";
      if (seconds < 10)
	time += "0" + seconds;
      else
	time += seconds;
}

//Function used to remove time from the timer.
function updateTimer() {
  
  var currTime = timeLimit - (new Date().getTime() - start);
  minutes = Math.floor(currTime / 60000) % 60;
  seconds = Math.floor((currTime / 1000) % 60);
  
  
  if (minutes < 10)
    time = "0" + minutes + ":";
  else
    time = minutes + ":";
  if (seconds < 10)
    time += "0" + seconds;
  else
    time += seconds;
  
  if (minutes == 0 && seconds == 0)
  {
    gamePlaying = false;
    timeOut();
  }
}

function timeOut() {
  if (numRight / numCards < .7)
  {
    lose = true;
  }
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
  this.clock = new Image();
  this.scroll = new Image();
  this.scroll2 = new Image();
  
  var numImages = 7;
  var numLoaded = 0;
  
  function imageLoaded() {
    numLoaded++;
    if (numLoaded === numImages) {
      console.log("Images Loaded");
      $('.answer').hide();
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
  
  this.clock.onload = function() {
    imageLoaded();
  }
  
  this.scroll.onload = function() {
    imageLoaded();
  }
  
  this.scroll2.onload = function() {
    imageLoaded();
  }
  
  // Set images src
  this.background.src = path + randomBackground();
  this.monster.src = randomMonster(6);
  this.avatar.src = avatarPath;
  this.heart.src = path + "/Sprites/Heart.png";
  this.clock.src = path + "/Sprites/Clock.png";
  this.scroll.src = path + "/Sprites/Scroll1.png";
  this.scroll2.src = path + "/Sprites/Scroll2.png";
}

function loadMonster(src, callback) {
  iRepo.monster.src = src;
  iRepo.monster.onload = callback;
}

function loadBG(src, callback) {
  iRepo.background.src = src;
  iRepo.background.onload = callback;
}

function nextCard() {
  
  game.input._value = "";
  if (deck.cards.length != 0) {
    currCard = deck.draw();
    setQuestion(currCard.question);
    if (gameMode < GameMode.SaveTheWorld) {
      loadBG(path + randomBackground(), function() {
      game.monster.change(currCard.category);
      });
    }
    avatarMoveTo = avatarMoveTo + avatarInc;
  }
  else {
    avatarMoveTo = avatarMoveTo + avatarInc;
    gamePlaying = false;
    if (gameMode == GameMode.SaveTheWorld)
    {
      game.bDie.get();
    }
  }
}

function setQuestion(q) {
  question = "Q: " + q;
}

function loseLife() {
  if (gameMode > GameMode.Training)
  lives = lives - 1;
  if (lives == 0) {
    gamePlaying = false; 
    lose = true;
    game.heart.timer = 199;
    game.pDie.get();
    game.heart.lose();
  }
  else {
    game.heart.timer = 29;
    game.heart.toggle = true;
    game.pHurt.get();
    game.heart.hurt();
  }
}

function submitAnswer() {
  if (gamePlaying) {
    if (currCard.answer == game.input._value) {
      game.monster.timer = 29;
      if (gameMode < GameMode.SaveTheWorld)
	game.mDie.get();
      else
	game.bHurt.get();
      game.monster.hurt();
      numRight++;
      XPGained += 10;
      goldEarned += 10 * gameMode;
      switch(currCard.category){
       case "1": //Math
         XPCategory[0] += 10;
	 break;
       case "2": //Science
         XPCategory[1] += 10;
	 break;
       case "3": //Social Studies
         XPCategory[2] += 10;
	 break;
       case "4": //English
         XPCategory[3] += 10;
	 break;
       case "5": //Language
         XPCategory[4] += 10;
	 break;
       case "6": //Misc
         XPCategory[5] += 10;
	 break;
       default:
         console.log("No category or invalid category passed for answer! ONO");
      }
    }
    else {
         loseLife();
    }
  }
}

//Picks a random monster image from the available pool of monsters
function randomMonster(category) {
  switch(category){
    case "0": //Boss
      var choice = Math.floor((Math.random() * 16) + 1);
      return "../../Resources/Game/Sprites/Bosses/" + choice + ".png";
      break;
    case "1": //Math
      var choice = Math.floor((Math.random() * 50) + 1);
      return "../../Resources/Game/Sprites/Math/" + choice + ".png";
      break;
    case "2": //Science
      var choice = Math.floor((Math.random() * 40) + 1);
      return "../../Resources/Game/Sprites/Science/" + choice + ".png";
      break;
    case "3": //Social Stuides
      var choice = Math.floor((Math.random() * 40) + 1);
      return "../../Resources/Game/Sprites/SocialStudies/" + choice + ".png";
      break;
    case "4": //English
      var choice = Math.floor((Math.random() * 45) + 1);
      return "../../Resources/Game/Sprites/English/" + choice + ".png";
      break;
    case "5": //Languages
      var choice = Math.floor((Math.random() * 45) + 1);
      return "../../Resources/Game/Sprites/Languages/" + choice + ".png";
      break;
    case "6": //Misc
      var choice = Math.floor((Math.random() * 50) + 1);
      return "../../Resources/Game/Sprites/Misc/" + choice + ".png";
      break;
    default:
      console.log("No category or invalid category passed for Monster! ONO");
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
 * Canvas Drawables
 * These objects make up the drawable objects on the canvas. Anything that gets drawn has to implement one of these.
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
    this.context.clearRect(this.x - 3, this.y - 3, this.width + 3, this.height + 3);
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
  
  this.hurt = function() {
    
    this.timer --;
      
    if (this.timer % 5 == 0) {
	var imageData = this.context.getImageData(this.x, this.y, this.width, this.height);
	var data = imageData.data;

	for(var i = 0; i < data.length; i += 4) {
	  // red
	  data[i] = 255 - data[i];
	  // green
	  data[i + 1] = 255 - data[i + 1];
	  // blue
	  data[i + 2] = 255 - data[i + 2];
	}

	// overwrite original image
	this.context.putImageData(imageData, this.x, this.y); 
      }
      if (this.timer > 0) {
        var func = wrapFunction(this.hurt, this, []);
	funQueue.push(func);
      }
      else {
	var func = wrapFunction(nextCard(), this, []);
	funQueue.push(func);
      }
  }
  
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
      else {
	var func = wrapFunction(nextCard(), this, []);
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

/**
 * A sound pool to use for the sound effects
 */

function SoundPool(maxSize) {
  var size = maxSize; // Max sounds allowed in the pool
  var pool = [];
  this.pool = pool;
  var currSound = 0;
 
  /*
   * Populates the pool array with the given sound
   */
  this.init = function(object) {
    if (object == "pHurt") {
      for (var i = 0; i < size; i++) {
        // Initalize the sound
        pHurt = new Audio(path + "Audio/Oracle_Link_Hurt.wav");
        pHurt.volume = 1;
        pHurt.load();
        pool[i] = pHurt;
      }
    }
    else if (object == "pDie") {
      for (var i = 0; i < size; i++) {
        var pDie = new Audio(path + "Audio/Oracle_Link_Dying.wav");
        pDie.volume = 1;
        pDie.load();
        pool[i] = pDie;
      }
    }
    else if (object == "mHurt") {
      for (var i = 0; i < size; i++) {
        var mHurt = new Audio(path + "Audio/Oracle_Enemy_Hit.wav");
        mHurt.volume = 1;
        mHurt.load();
        pool[i] = mHurt;
      }
    }
    else if (object == "mDie") {
      for (var i = 0; i < size; i++) {
        var mDie = new Audio(path + "Audio/Oracle_Enemy_Die.wav");
        mDie.volume = 1;
        mDie.load();
        pool[i] = mDie;
      }
    }
    else if (object == "bHurt") {
      for (var i = 0; i < size; i++) {
        var bHurt = new Audio(path + "Audio/Oracle_Boss_Hit.wav");
        bHurt.volume = 1;
        bHurt.load();
        pool[i] = bHurt;
      }
    }
    else if (object == "bDie") {
      for (var i = 0; i < size; i++) {
        var bDie = new Audio(path + "Audio/Oracle_Boss_Die.wav");
        bDie.volume = 1;
        bDie.load();
        pool[i] = bDie;
      }
    }
  };
 
  /*
   * Plays a sound
   */
  this.get = function() {
    if(pool[currSound].currentTime == 0 || pool[currSound].ended) {
      pool[currSound].play();
    }
    currSound = (currSound + 1) % size;
  };
}

function Game() {

  this.init = function() {
    //Grab the canvas from the page
    this.bgCanvas = document.getElementById('background');
    this.mCanvas = document.getElementById('monster');
    this.aCanvas = document.getElementById('avatar');
    this.eCanvas = document.getElementById('etc');
    avatarPath = document.getElementById('avPath').innerHTML;
    iRepo.avatar.src = "../" + avatarPath;
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
      
      this.heart = new Etc(iRepo.heart);
      this.heart.init(595, 30, iRepo.heart.width, iRepo.heart.height);
      
      if (gameMode > GameMode.Training) {
	      this.scroll = new Etc(iRepo.scroll);
	      this.scroll.init(530, 5, iRepo.scroll.width, iRepo.scroll.height);
      }
      
      if (gameMode == GameMode.SaveTheWorld) {
	this.clock = new Etc(iRepo.clock);
	this.clock.init(35, 30, iRepo.clock.width, iRepo.clock.height);
	this.scroll2 = new Etc(iRepo.scroll2);
	this.scroll2.init(5, 5, iRepo.scroll2.width, iRepo.scroll2.height);
      }
      
      this.monster = new Monster();
      //Center the monster in the middle of the screen.
      var monsterX = 382.5 - (iRepo.monster.width/2);
      var monsterY = 168 - (iRepo.monster.height/2);
      this.monster.init(monsterX, monsterY, iRepo.monster.width, iRepo.monster.height);
      
      if (gameMode == GameMode.SaveTheWorld)
	this.monster.change(0);
      else
	this.monster.change(currCard.category);
      
      
      this.avatar = new Avatar();
      this.avatar.init(0, 333, iRepo.avatar.width, iRepo.avatar.height);
      
      this.pHurt = new SoundPool(3);
      this.pHurt.init("pHurt");
 
      this.pDie = new SoundPool(2);
      this.pDie.init("pDie");
      
      this.mHurt = new SoundPool(3);
      this.mHurt.init("mHurt");
 
      this.mDie = new SoundPool(2);
      this.mDie.init("mDie");
      
      this.bHurt = new SoundPool(3);
      this.bHurt.init("bHurt");
 
      this.bDie = new SoundPool(2);
      this.bDie.init("bDie");
      
      game.start();
    }
    //Return if we don't have canvas support on this bozo's computer. IE6 PROBLEMS >:I
    else  
      return;
  };
  
  this.start = function() {
    $('.loading').remove();
    $('.loadingImage').remove();
    start = new Date().getTime();
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
    
    if (funQueue.length != 0) {
      (funQueue.shift())();
    }
  }
  
  else if(lose){
    document.getElementById('question').innerHTML = "THOU HAST LOST! "  + numRight + "/" + numCards;  
    if (funQueue.length != 0) {
      (funQueue.shift())();
    }
    
  }
  
  else{
    game.monster.clear();
    document.getElementById('question').innerHTML = "VICTORY! YOU ARE THE HERO! " + numRight + "/" + numCards;
    printEarning();
  }
   
  if (gameMode > GameMode.Training) {
    game.scroll.draw();
    game.heart.draw();
    document.getElementById('lives').innerHTML = " x" + lives;  
  }
  
  if (gameMode == GameMode.SaveTheWorld) {
    game.scroll2.draw();
    game.clock.draw();
    if (gamePlaying)
    {
      updateTimer();
      document.getElementById('time').innerHTML = time;
    }
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

function printEarning() {
    var htmlString = "";
    
    if (XPCategory[0] != 0)
      htmlString += "</br>You earned " + XPCategory[0] + " math XP!";
    if (XPCategory[1] != 0)
      htmlString += "</br>You earned " + XPCategory[1] + " science XP!";
    if (XPCategory[2] != 0)
      htmlString += "</br>You earned " + XPCategory[2] + " social studies XP!";
    if (XPCategory[3] != 0)
      htmlString += "</br>You earned " + XPCategory[3] + " english XP!";
    if (XPCategory[4] != 0)
      htmlString += "</br>You earned " + XPCategory[4] + " language XP!";
    if (XPCategory[5] != 0)
      htmlString += "</br>You earned " + XPCategory[5] + " misc XP!";
    htmlString += "</br>This game you earned a total of " + XPGained + " XP!";
    htmlString += "</br>You found " + goldEarned + " gold!";
    

    $("#answer").html(htmlString);

    $(".answer").show();
}

function init() {
  // gameMode = GameMode.Quest;
  $.getScript("js/requests.js", function(){
    deck = deck1;
    gameMode = md;

    for(var i = 0; i < deck.cards.length; i++){
      if(deck.cards[i].difficulty == 1)
         seconds += 5;
      
      else if(deck.cards[i].difficulty == 2)
         seconds += 10;
      
      else if(deck.cards[i].difficulty == 3)
         seconds += 15;
      
      else if(deck.cards[i].difficulty == 4)
         seconds += 20;   
    }
    deck.shuffle();
    numCards = deck.cards.length;
    numRight = 0;
    
    for (var i=0; i<6; i++)
      XPCategory[i] = 0;
    
    minutes = Math.floor(seconds/60);
    seconds = seconds%60;
    goldEarned = 0;
    avatarInc = 715 / numCards;
    currCard = deck.draw();
    lives = numCards - Math.ceil(numCards * .7) + 1;
    timeLimit = minutes * 60000 + seconds * 1000;
    setQuestion(currCard.question);
    XPGained = 0;
    game.init();
  });

}
