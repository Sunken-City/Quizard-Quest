/** THE GAME
 * Author: Anthony Cloudy
 * Learning from a tutorial on http://blog.sklambert.com/html5-canvas-game-panning-a-background/
 * 


/**
 * Define an object to hold all our images for the game so images
 * are only ever created once. This type of object is known as a
 * singleton.
 */
var path = "../../Resources/Game/";
var imageRepository = new function() {
  // Define images
  this.background = new Image();
 
  // Set images src
  this.background.src = path + "Backgrounds/Plains.png";
}

//The interface for anything that gets drawn on screen
function Drawable()
{
  this.init = function(x, y){
    //Default variables
    this.x = x;
    this.y = y;
  }
  
  this.speed = 0;
  this.canvasWidth = 0;
  this.canvasHeight = 0;
  
  //Implemented in children
  this.draw = function(){
  }
}

