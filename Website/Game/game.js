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