<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <style>
    .city{
      font-family: Gill Sans, Verdana;
   font-size: 11px;
   line-height: 14px;
   text-transform: uppercase;
   letter-spacing: 2px;
   font-weight: bold;
  }
  .well{
    position: absolute;
    top: 10px;
  }
  </style>
<?php
$address="127.0.0.1";
$port="5000";
$msg = "vero";

if(isset($_POST['vero'])) $msg = "vero+". $_POST['random'];
else $msg = "falso+".$_POST['random'];

$sock=socket_create(AF_INET,SOCK_STREAM,0) or die("Cannot create a socket");
socket_connect($sock,$address,$port) or die("Could not connect to the socket");
socket_write($sock,$msg);

$read=socket_read($sock,1024);
echo '<div class="well">';
echo '<h2 class="city">';
echo $read;
echo "</h2>";
echo '<br><a href="index.php">Torna alla home</a>';
echo "</div>";
socket_close($sock);

?>

</body>
</html>
