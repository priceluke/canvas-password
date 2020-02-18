<?php include("config.php");
session_start();
$echoString = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {

     $myusername = mysqli_real_escape_string($db,$_POST['username']);
     $mypassword = mysqli_real_escape_string($db,$_POST['points']);
  if (isset($_POST['register'])){
   // username and password sent from form


   $sql = "INSERT INTO User (Username) VALUES('$myusername')";
   mysqli_query($db,$sql);

   $sql = "INSERT INTO Password (Data, UserID) VALUES('$mypassword', '". mysqli_insert_id($db) ."')";
   mysqli_query($db,$sql);
   $echoString = "User Registered";
} elseif (isset($_POST['login'])) {
  $sql = "SELECT password.data FROM password INNER JOIN user on password.UserID = User.UserID WHERE username = '$myusername'";
  $result = mysqli_query($db,$sql);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        include("algorithm.php");
        writeMsg();
        echo $row["data"]. "<br>";
        echo $mypassword;
        echo "<br>User Logged In??ehhh??<br>";
    }
} else {
    echo "0 results";
}
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
}
}
?>



<!DOCTYPE html>
<html>

<head>
  <title>PenPass</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
</head>

<body>

  <div id="paintbg" width="100%" height="100%">
    <p id="title" >PenPass<br><?php echo $echoString; ?>
      <form action="" method="post" style="">
        <table style="margin-left:40%;">
          <tr>
            <td align='center' colspan="4">
        <input style="" width="100%" type="text" name="username"><br></td>
      </tr><tr><td>
        <button type="submit"  name="login" style="float:left;" class="button">LOGIN</button>
</td><td>
      <button class="button" style="" onclick="erase()">CLEAR</button></td><td>

      <button class="button"><a href="#" id="dwnld" download="my-file-name.png">SAVE</a></button></td><td>
        <input type="hidden" name="points" id="drawinglog" value="">
        <button type="submit" style="float:left;" name="register" class="button">REGISTER</button>
</td></tr>
</table>
    </form><br>
    </p>
    <div id="space">

    </div>

    <div id="canvasarea">
      <canvas id="myCanvas" width="1060px" height="680px" style="border:1.5px solid #000000;">
        Not Supported</canvas>
    </div>


  </div>

  <script type="text/javascript" src="drawing.js"></script>
</body>
<footer>
</footer>

</html>
