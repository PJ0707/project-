<?php
session_start(); 
$host="localhost"; 
$user="FTS"; 
$password=""; 
$db="user_login_details"; 
$port="3307";
$con=mysqli_connect($host,$user,$password,$db,$port); 
if(isset($_POST['Login'])) 
{ 
 $uname=$_POST['fid']; 
 $_SESSION['fid'] = $uname; 
 $password=$_POST['password']; 
 $sql="select fid,password from fregister where fid= '".$uname."' AND password='".$password."'"; 
 $result= mysqli_query($con,$sql); 
 $no_rows=mysqli_num_rows($result); 
 $_SESSION["fid"] = $uname; 
 if($no_rows>0) 
 { 
 
 ?>
 <script>
 location.replace("request.php"); 
 </script>
 <?php
 } 
 else
 { 
 ?>
 <script>
 alert("You have Entered Wrong Crentials"); 
 location.replace("main.php"); 
 </script>
 <?php
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initialscale=1">
 
 <title>Faculty_Login_Form</title>
 <link rel="stylesheet" type="text/css" href="style.css">
 
</head>
<body>
	<a href="main.php"><button style="float: right; "class="w3-button w3-red w3-round-large">Go back >></button></a>
<div class="login-box">
<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
<h2>Faculty Login </h2>
<p>UserId</p>
<input type="text" name="fid" placeholder="Enter userid">
<p>Password</p>
<input type="password" id="myinput" name="password" placeholder="Password">
<p class="textwhite"><input type="checkbox" onclick="myFunction()">Show Password</p>
<input type="submit" name="Login" value="Login">
</form>
<span style="color:red"><b>*if new user, register here--||</b></span>
<a href="fregister.php"><button style="float: right; "class="w3-button w3-red w3-round-large"><b>Register>></b></button></a>
</div>
<script src="myjavascript.js"></script>
</body>
</html>
