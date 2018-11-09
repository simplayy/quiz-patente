

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
</head>
<body>

<canvas id="myCanvas"></canvas>
 <form action = "client.php" method = "post">
<?php
$random=rand(1,40);

// nome di host
$host = "localhost";
// username dell'utente in connessione
$user = "root";
// password dell'utente
$password = "";
//nome database
$dbname="patente";

// stringa di connessione al DBMS
$connessione = new mysqli($host, $user, $password, $dbname);

// verifica su eventuali errori di connessione
if ($connessione->connect_errno) {
    echo "Connessione fallita: ". $connessione->connect_error . ".";
    exit();
}

$sql = "SELECT id, testo FROM quiz where id=$random";
$result = $connessione->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo "<br>";
        echo "<div>";
        echo "<p>";
        echo  "".$row["testo"]. "<br>";
        echo "</p>";
    }
} else {
    echo "0 results";
}

// chiusura della connessione
$connessione->close();
echo '<input type="hidden" name="random" value="'.$random.'">';
?>
	Vero: <input type="radio" value="vero" name="vero">
	Falso: <input type="radio" value="falso" name="falso">
 	<br><input type="submit" value="Invia" class="myButton">

  </div>
</form>
<style>

.myButton {
	-moz-box-shadow: 0px 7px 5px -1px #9ea89b;
	-webkit-box-shadow: 0px 7px 5px -1px #9ea89b;
	box-shadow: 0px 7px 5px -1px #9ea89b;
	background-color:#000105;
	-moz-border-radius:20px;
	-webkit-border-radius:20px;
	border-radius:20px;
	border:1px solid #000000;
	display:inline-block;
	cursor:pointer;
	color:#fafafa;
	font-family:Arial;
	font-size:15px;
	padding:0px 17px;
	text-decoration:none;
	text-shadow:0px 4px 8px #000000;
}
.myButton:hover {
	background-color:#020500;
}
.myButton:active {
	position:relative;
	top:1px;
}

form {
  max-width: 300px;
  margin: 10px auto;
  padding: 10px 20px;
  background: #f4f7f8;
  border-radius: 8px;
}


input[type="text"],
input[type="password"],
input[type="date"],
input[type="datetime"],
input[type="email"],
input[type="number"],
input[type="search"],
input[type="tel"],
input[type="time"],
input[type="url"],
textarea,
select {
  background: rgba(255, 255, 255, 0.1);
  border: none;
  font-size: 16px;
  height: auto;
  margin: 0;
  outline: 0;
  padding: 15px;
  width: 100%;
  background-color: #e8eeef;
  color: #8a97a0;
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.03) inset;
  margin-bottom: 30px;
}

input[type="radio"],
input[type="checkbox"] {
  margin: 0 4px 8px 0;
}

select {
  padding: 6px;
  height: 32px;
  border-radius: 2px;
}

button {
  padding: 19px 39px 18px 39px;
  color: #FFF;
  background-color: #4bc970;
  font-size: 18px;
  text-align: center;
  font-style: normal;
  border-radius: 5px;
  width: 100%;
  border: 1px solid #3ac162;
  border-width: 1px 1px 3px;
  box-shadow: 0 -1px 0 rgba(255, 255, 255, 0.1) inset;
  margin-bottom: 10px;
}

fieldset {
  margin-bottom: 30px;
  border: none;
}

legend {
  font-size: 1.4em;
  margin-bottom: 10px;
}

label {
  display: block;
  margin-bottom: 8px;
}

label.light {
  font-weight: 300;
  display: inline;
}

.number {
  background-color: #5fcf80;
  color: #fff;
  height: 30px;
  width: 30px;
  display: inline-block;
  font-size: 0.8em;
  margin-right: 4px;
  line-height: 30px;
  text-align: center;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
  border-radius: 100%;
}

@media screen and (min-width: 480px) {
  form {
    max-width: 480px;
  }
}
html {
background:#ecf0f1;
}
canvas {
display:block;
margin:auto;
background:#ecf0f1;
}
div {
    border: 1px solid gray;
    padding: 8px;
}

p {
    text-indent: 50px;
    text-align: justify;
    letter-spacing: 3px;
}
</style>
<script>
var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");
var mask;

var pointCount = 500;
var str = "Test Guida";
var fontStr = "bold 128pt Helvetica Neue, Helvetica, Arial, sans-serif";

ctx.font = fontStr;
ctx.textAlign = "center";
c.width = ctx.measureText(str).width;
c.height = 128; // Set to font size

var whitePixels = [];
var points = [];
var point = function(x,y,vx,vy){
this.x = x;
this.y = y;
this.vx = vx || 1;
this.vy = vy || 1;
}
point.prototype.update = function() {
ctx.beginPath();
ctx.fillStyle = "#95a5a6";
ctx.arc(this.x,this.y,1,0,2*Math.PI);
ctx.fill();
ctx.closePath();

// Change direction if running into black pixel
if (this.x+this.vx >= c.width || this.x+this.vx < 0 || mask.data[coordsToI(this.x+this.vx, this.y, mask.width)] != 255) {
  this.vx *= -1;
  this.x += this.vx*2;
}
if (this.y+this.vy >= c.height || this.y+this.vy < 0 || mask.data[coordsToI(this.x, this.y+this.vy, mask.width)] != 255) {
  this.vy *= -1;
  this.y += this.vy*2;
}

for (var k = 0, m = points.length; k<m; k++) {
  if (points[k]===this) continue;

  var d = Math.sqrt(Math.pow(this.x-points[k].x,2)+Math.pow(this.y-points[k].y,2));
  if (d < 5) {
    ctx.lineWidth = .2;
    ctx.beginPath();
    ctx.moveTo(this.x,this.y);
    ctx.lineTo(points[k].x,points[k].y);
    ctx.stroke();
  }
  if (d < 20) {
    ctx.lineWidth = .1;
    ctx.beginPath();
    ctx.moveTo(this.x,this.y);
    ctx.lineTo(points[k].x,points[k].y);
    ctx.stroke();
  }
}

this.x += this.vx;
this.y += this.vy;
}

function loop() {
ctx.clearRect(0,0,c.width,c.height);
for (var k = 0, m = points.length; k < m; k++) {
  points[k].update();
}
}

function init() {
// Draw text
ctx.beginPath();
ctx.fillStyle = "#000";
ctx.rect(0,0,c.width,c.height);
ctx.fill();
ctx.font = fontStr;
ctx.textAlign = "left";
ctx.fillStyle = "#fff";
ctx.fillText(str,0,c.height/2+(c.height / 2));
ctx.closePath();

// Save mask
mask = ctx.getImageData(0,0,c.width,c.height);

// Draw background
ctx.clearRect(0,0,c.width,c.height);

// Save all white pixels in an array
for (var i = 0; i < mask.data.length; i += 4) {
  if (mask.data[i] == 255 && mask.data[i+1] == 255 && mask.data[i+2] == 255 && mask.data[i+3] == 255) {
    whitePixels.push([iToX(i,mask.width),iToY(i,mask.width)]);
  }
}

for (var k = 0; k < pointCount; k++) {
  addPoint();
}
}

function addPoint() {
var spawn = whitePixels[Math.floor(Math.random()*whitePixels.length)];

var p = new point(spawn[0],spawn[1], Math.floor(Math.random()*2-1), Math.floor(Math.random()*2-1));
points.push(p);
}

function iToX(i,w) {
return ((i%(4*w))/4);
}
function iToY(i,w) {
return (Math.floor(i/(4*w)));
}
function coordsToI(x,y,w) {
return ((mask.width*y)+x)*4;

}

setInterval(loop,50);
init();
</script>
</body>
</html>
