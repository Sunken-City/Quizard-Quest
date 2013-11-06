/** THE GAME
 * Author: Anthony Cloudy
 * Learning from a tutorial on http://blog.sklambert.com/html5-canvas-game-panning-a-background/
 * Sections are copied from that website, but mostly I'm trying to rewrite them as much as possible
 */

//The path to the resources folder for the game
var path = "../../Resources/Game/";
var avatarPath = "../../Resources/Avatars/";

//Game Mode
this.GameMode = 
{
    Training : 0,
    Quest : 1,
    Test : 2
}

/**
 * Misc functions
 */

//Modified from: http://krazydad.com/tutorials/makecolors.php
function colorFromPhase(phase)
{
  phase = (phase - 20) * .01;
  var center = 104;
  var width = 127;
  var red   = Math.floor(Math.sin(2 + phase) * width + center);
  var green = Math.floor(Math.sin(0 + phase) * width + center);
  var blue  = Math.floor(Math.sin(4 + phase) * width + center); 
  return "rgba(" + red + "," + green + "," + blue + ", 1)";
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
 
  var numImages = 4;
  var numLoaded = 0;
  
  function imageLoaded()
  {
    numLoaded++;
    if (numLoaded === numImages)
    {
      window.init();
    }
  }
  
  function changeImage(i, pathTail)
  {
    i.src = path + pathTail;
  }
  
  this.background.onload = function(){
    imageLoaded();
  }
  
  this.monster.onload = function(){
    imageLoaded();
  }
  
  this.avatar.onload = function(){
    imageLoaded();
  }
  
  this.heart.onload = function(){
    imageLoaded();
  }
  
  // Set images src
  this.background.src = path + randomBackground();
  this.monster.src = path + randomMonster();
  this.avatar.src = avatarPath + "Greg.png";
  this.heart.src = path + "/Sprites/Heart.png";
}

//Picks a random monster image from the available pool of monsters
function randomMonster()
{
  var choice = Math.floor((Math.random() * 3) + 1);
  if (choice === 1)
  {
    return "Sprites/Centipede.png";
  }
  else if (choice === 2)
  {
    return "Sprites/Slug.png";
  }
  else if (choice === 3)
  {
    return "Sprites/Stag.png";
  }
}

//Picks a random background image from the available pool of backgrounds
function randomBackground()
{
  var choice = Math.floor((Math.random() * 3) + 1);
  if (choice === 1)
  {
    return "Backgrounds/Plains.png";
  }
  else if (choice === 2)
  {
    return "Backgrounds/Cliff.png";
  }
  else if (choice === 3)
  {
    return "Backgrounds/Forest.png";
  }
}

//The interface for anything that gets drawn on screen
function Drawable()
{
  this.init = function(x, y, width, height){
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
  this.draw = function(){
  };
}

/**
 * Canvas Creation
 */

function Background()
{
  this.draw = function() {
    this.context.drawImage(iRepo.background, this.x, this.y, this.width, this.height);
    //this.context.fillRect(0, 333, 765, 666);
  };
}

function Monster()
{
  this.idleVal = 0;
  this.idleUp = true;
  
  this.draw = function() {
    this.context.drawImage(iRepo.monster, this.x, this.y, this.width, this.height);
  };
  
  this.clear = function() {
    this.context.clearRect(this.x, this.y, this.width, this.height);
  };
  
  this.change = function() 
  {
    iRepo.changeImage(iRepo.monster, "Sprites/Heart.png");
  };
  
  //Make the monster float up and down in an idling sequence
  this.idle = function() {  
    //If we hit a boundary, then change direction
    if (this.idleVal == 20)
    {
      this.idleUp = false;
    }
    else if (this.idleVal == -20)
    {
      this.idleUp = true;
    }
    
    if (this.idleUp)
    {
      this.idleVal++;
      if (this.idleVal % 10 == 0)
      {
	this.y++;
      }
    }
    else 
    {
      this.idleVal--;
      if (this.idleVal % 10 == 0)
      {
	this.y--;
      }
    }
  };
}

function Avatar()
{
  this.draw = function() {
    this.context.drawImage(iRepo.avatar, this.x, this.y, this.width, this.height);
  };
  
  this.clear = function() {
    this.context.clearRect(this.x, this.y, this.width, this.height);
  };
  
  this.move = function() {
    this.x++;
    this.context.fillStyle = colorFromPhase(this.x);
    this.context.fillRect(this.x, this.y, this.width - 25, this.height);
  };
}

function Etc()
{  
  this.draw = function() {
    this.context.drawImage(iRepo.heart, this.x, this.y, this.width, this.height);
  };
}


//Get the background object to copy all of Drawable's information
Background.prototype = new Drawable();
Avatar.prototype = new Drawable();
Monster.prototype = new Drawable();
Etc.prototype = new Drawable();


function Game()
{
  this.init = function() {
    //Grab the canvas from the page
    this.bgCanvas = document.getElementById('background');
    this.mCanvas = document.getElementById('monster');
    this.aCanvas = document.getElementById('avatar');
    this.eCanvas = document.getElementById('etc');
    
    this.lives = 5;
    this.question = "sqrt(Onions)";
    this.answer = "Shallots";
    
    //Check to see if we can use the canvas
    if (this.bgCanvas.getContext)
    {
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
      
      this.heart = new Etc();
      this.heart.init(550, 50, iRepo.heart.width, iRepo.heart.height);
      
      this.monster = new Monster();
      //Center the monster in the middle of the screen.
      var monsterX = iRepo.background.width/2 - iRepo.monster.width/2;
      var monsterY = iRepo.background.height/4 + iRepo.monster.height;
      this.monster.init(monsterX, monsterY, iRepo.monster.width, iRepo.monster.height);
      
      this.avatar = new Avatar();
      this.avatar.init(0, 333 - iRepo.avatar.height/2, iRepo.avatar.width, iRepo.avatar.height);
      
      //this.display = new Display(800, false, true);
      
      return true;
    }
    else
    {
      //Return false if we don't have canvas support on this bozo's computer. IE6 PROBLEMS >:I
      return false;
    }
  };
  
  this.start = function() {
    animate();
  };
}
      
/**
 * The animation loop. Calls the requestAnimationFrame shim to
 * optimize the game loop and draws all game objects. This
 * function must be a gobal function and cannot be within an
 * object.
 */
function animate() 
{
  requestAnimFrame(animate);
  game.background.draw();
  
  game.monster.clear();
  game.monster.idle();
  game.monster.draw();
  
  game.avatar.draw();
  game.avatar.move();
  
  game.heart.draw();
  document.getElementById('lives').innerHTML = game.lives;  
  document.getElementById('question').innerHTML = game.question;  
  document.getElementById('answer').innerHTML = game.answer;  
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

function init()
{
  if(game.init())
  {
    game.start();
  }
}


/*
function Display(size, offset, openInNewWindow) {
	var display = this;
	
	if(offset) {
		this.offset = offset;
	} else {
		this.offset = new Vector2(0, 0);
	}
	
	this.tileSize = new Vector2(10, 16);
	this.nodes = [];
	this.size = size;
    this.pixelSize = new Vector2(this.size.x*this.tileSize.x + this.offset.x + 10, 
        this.size.y * this.tileSize.y + this.offset.y + 17);
	
    if(openInNewWindow) {
        var paramsString = "width=" + (this.size.x*this.tileSize.x + this.offset.x + 10)
            + ", height=" + (this.size.y * this.tileSize.y + this.offset.y + 17);
        this.window = window.open("", "", paramsString);
    } else {
        this.window = window;
    }
	
	this.init = function(size) {
		// style popup window nicely
		$("body", this.window.document).css({
			"background-color": "black",
			"font-family": "Courier"
		});
		
		$("head", this.window.document).html("<title>Saege</title>");
		
		var $message = $('<div id="message_bar">', this.window.document).css({
			"color": "white",
			"margin-left": "3px"
		});
		
		$("body", this.window.document).html($message);
		this.$message = $("#message_bar", this.window.document);
		
		// create HTML element for the display
		var $display = $('<div id="display">', this.window.document);
		this.$display = $display;
		
		// populate it with <span> elements
		for(var x = 0; x<size.x; x++) {
			this.nodes[x] = [];
			
			for(var y = 0; y<size.y; y++) {
				var $span = $('<span class="tile" id="' + "t_" + x + "_" + y + '">', this.window.document);
				$span.css({
					position: "absolute",
					width: display.tileSize.x,
					height: display.tileSize.y,
					left: display.tileSize.x * x + display.offset.x,
					top: display.tileSize.y * y + display.offset.y
				});
				$span.text(" ");
				$display.append($span);
				
				this.nodes[x][y] = $span[0];
			}
		}
 
		$("body", this.window.document).append($display);
	}
	
	this.ch = function(character, position, color, opacity, backgroundColor) {
		var tile = this.nodes[position.x][position.y]
		
		if(character) {	
			tile.innerHTML = character;
		}
		
		if(color) {
			tile.style.color = color;
		}
		
		if(opacity) {
			tile.style.opacity = opacity;
		}
		
		if(backgroundColor) {
			tile.style.backgroundColor = backgroundColor;
		}
	}
 
	this.init(this.size);
}*/

//From https://gist.github.com/ebonneville/3929297
// basic position class, holds x and y coordinates and utility functions
/*
function Vector2(x, y) {
	this.x = x;
	this.y = y;
	
	this.add = function(other) {
		return new Vector2(this.x + other.x, this.y + other.y);
	};
	
	this.distance = function(pos) {
		var dx = pos.x - this.x;
		var dy = pos.y - this.y;
		
		return Math.abs(Math.sqrt((dx * dx) + (dy * dy)));
	};
	
	this.manhattan = function(pos) {
		return(Math.abs(this.x - pos.x) + Math.abs(this.y - pos.y));
	};
	
	this.clone = function() {
		return(new Vector2(this.x, this.y));
	};
	
	this.toString = function() {
		return("(" + this.x + ", " + this.y + ")");
	};
}
*/