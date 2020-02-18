//Create canvas
var canvas = document.getElementById('myCanvas');
var ctx = canvas.getContext('2d');
//Set background
ctx.fillStyle = "white";
ctx.fillRect(0, 0, 700, 500);

//Lines is default
lines();

var removeRectangleInLine = 0;

function lines() {
  //painting = false;
  //Remove event listeners so line won't draw rectangle

  //Initialize mouse coordinates to 0,0
  var mouse = {
    x: 0,
    y: 0
  };

  //Paint includes line width, line cap, and color
  paint = function() {
    console.log(mouse.x, mouse.y);
    document.getElementById("drawinglog").value += "(" + mouse.x + ", " + mouse.y + ")";
    ctx.lineTo(mouse.x, mouse.y);
    ctx.lineWidth = 3;
    ctx.lineJoin = 'round';
    ctx.lineCap = brushstyle;
    ctx.strokeStyle = colors;
    ctx.stroke();
  };

  //Find mouse coordinates relative to canvas
  linesMousemove = function(e) {
    mouse.x = e.pageX - this.offsetLeft;
    mouse.y = e.pageY - this.offsetTop;
  };

  //User clicks down on canvas to trigger paint
  linesMousedown = function() {
    ctx.beginPath();
    console.log("init " + mouse.x + mouse.y);
    ctx.moveTo(mouse.x, mouse.y);
    canvas.addEventListener('mousemove', paint, false);
  };

  //When mouse lifts up, line stops painting
  linesMouseup = function() {
    canvas.removeEventListener('mousemove', paint, false);
  };

  //When mouse leaves canvas, line stops painting
  linesMouseout = function() {
    canvas.removeEventListener('mousemove', paint, false);
  };

  //Event listeners that will trigger the paint functions when
  //mousedown, mousemove, mouseup, mouseout
  canvas.addEventListener('mousedown', linesMousedown, false);
  canvas.addEventListener('mousemove', linesMousemove, false);
  canvas.addEventListener('mouseup', linesMouseup, false);
  canvas.addEventListener('mouseout', linesMouseout, false);

};

//Color palette
var colors = "#545454";

//Change brush style
var brushstyle = "round";

//Clear canvas
function erase() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
	document.getElementById("drawinglog").value = "";
};

//Save image
var button = document.getElementById('dwnld');
button.addEventListener('click', function(e) {
  var dataURL = canvas.toDataURL('image/png');
  button.href = dataURL;

});
