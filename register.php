<?php
  session_start(); 

  $emailErr="";
    $usernameErr="";
    $passwordErr="";
    $password2Err="";

    
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST["username"])){
            $usernameErr=" Username is required";
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST["email"])){
            $emailErr=" Email is required";
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST["password"])){
            $passwordErr=" Password is required";
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST["password2"])){
            $password2Err="";
        }
    }
    
  

  if ((isset($_POST["register_btn"])) &&  (!empty($_POST["username"])) && (!empty($_POST["email"])) && (!empty($_POST["password"]))) {
            
    $username=$_POST["username"];
    $email=$_POST["email"];  
    $password=$_POST["password"];
    $password2=$_POST["password2"];


    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if (!$uppercase) {
      
      $passwordErr="";
      
    } else {
      //hash password
      $password=md5($password);
      
      //connect to database
      $con=mysqli_connect(
	  "webprogramming.cmmcedthfueh.us-west-2.rds.amazonaws.com", 
	  "user", 
	  "password", 
	  "db2304998",
	  "3306");  
      
      // make a query
      $sql="INSERT INTO reg(username, email, password, succeed) VALUES ('$username','$email','$password', '$succeed') ";

      // execute query
      mysqli_query($con, $sql);
      $_SESSION['message']="You are now logged in"; 
      $_SESSION['username']=$username;
	  $_SESSION['succeed']=$succeed;

      //Redirect to home page
      header("Location: game.php"); 
    }
  }
  
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register Page</title>
  <link rel="stylesheet" type="text/css" href="./register.css"/>
</head>
<body>

<div class="header">
    <h1>Sign Up Please!</h1>
</div>



<form method="post">
 <div id="container">
     <div class="form">
          <div class="tooltip">
           Username :
           <input type="text" name="username" class="textInput tooltip" placeholder="JDoe123" > <span class="error" > <?= $usernameErr; ?> </span> <span class="tooltiptext">Contain only number &amp; character</span></div>
     
            
           Email :
             <input type="email" name="email" class="textInput" placeholder="you@example.org" > <span class="error">  <?= $emailErr; ?> </span>
            
      
           <div class="tooltip">
           Password :
            <input type="password" name="password" class="textInput" placeholder="*******" > <span class="error">  <?= $passwordErr; ?> </span><span class="tooltiptext"> 
            At least 6 characters | 
            At least one number |
            At least one lowercase character(a-z) |
            At least one uppercase character(A-Z)
            </span> </div>
     
      
           Confirm Password :</td>
           <input type="password" name="password2" class="textInput" placeholder="*******" > <span class="error"> <?= $password2Err; ?> </span>
     
      
      
          
           <input type="submit" name = "login_btn" value="Login" formaction="main.php"> 
           <input type="submit" name = " register_btn" value="Register" formaction="register.php"></td>
     
     </div>
      
 
</div>
</form>

        
</body>
</html>
