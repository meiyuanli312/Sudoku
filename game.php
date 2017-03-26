<?php
  session_start();
  $username = $_SESSION["username"];

  $con = mysqli_connect(
        "webprogramming.cmmcedthfueh.us-west-2.rds.amazonaws.com",
        "user",
        "password",
        "db2304998",
        "3306"
     ) or die("Could not connect:" . mysql_error());

  $result= mysqli_query ($con, "SELECT * from reg WHERE username='".$username."'");   

  while( $row= mysqli_fetch_array($result, MYSQLI_ASSOC)){
      $succeed=$row['succeed'];
	    $_SESSION['succeed']=$succeed;
  };

?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,user-scalable=no" />
	<title>sudoku</title>
	<link rel="Stylesheet" type="text/css" href="sudoku.css" />

</head>

<body>
    <?php 
        $username=$_SESSION["username"];
        $succeed=$_SESSION['succeed'];
        print "<p><a id=\"lo\" href=logout.php> LOG OUT</a></p>";
        print "<p id=\"hello\"> <b> User: $username</b> "."</br> </br> Welcome to Sudoku, you have succeed  <b id=\"succeed\">$succeed</b> times. Enjoy your game! </p>";
        print "<p id=\"p3\"></p>";  // this is to display the 2-D array of the game
        print "<div class = \"btn-group\">";
        print "<button class=\"button button1\" onclick = \"sd.checkRes('" .$username. "', $succeed);\"> Finish </button>";
        print "<button class=\"button button2\" onclick = \"sd.reset();\"> Reset </button>";
        print	"<button class=\"button button3\" onclick = \"sd.again();\"> Restart </button>";
        print "</div>";

    ?>

      <script
          src="http://code.jquery.com/jquery-3.1.1.slim.min.js"
          integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc="
          crossorigin="anonymous">
      </script>
      <script src="sudoku.js"></script>
      <script>
            var sd = new SD;
            sd.init(30);
      </script>
</body>



</html>
