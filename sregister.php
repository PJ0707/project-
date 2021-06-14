<?php
session_start(); 
$host="localhost"; 
$user="FTS"; 
$password=""; 
$db="user_login_details"; 
$port="3307";
$con=mysqli_connect($host,$user,$password,$db,$port); 
if(isset($_POST['submit'])) 
{ 
 $uname=$_POST['userid']; 
 $_SESSION['ID'] = $uname; 
 $password=$_POST['password']; 
 $email=$_POST['email'];
 $sql="insert into sregister(ID,password,email) values('$uname','$password','$email');"; 
 $result= mysqli_query($con,$sql); 
 if($result) 
 { 
 
 ?>
 <script>
 alert("registered successfully");
 </script>
 <?php
 } 
 else
 { 
 ?>
 <script>
 alert("try again"); 

 </script>
 <?php
}
}
?>
<DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=width-content,intial scale=1">
<title> Student Registration Page</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<a href="login.php"><button style="float: right; "class="w3-button w3-red w3-round-large">Go back >></button></a>
<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
<div class="login-box">
<h2 style="color:red">Register here</h2>
<p>USERID</p>
<input type="text box" name="userid" placeholder="create userid">
<p> PASSWORD</p>
<input type="password" name="password" placeholder="create password">
<p> EMAIL</p>
<input type="email" name="email" placeholder=" enter email">
<br><br>
<input type="submit" name="submit" placeholder="submit">
</div>
</form>
</body>
</html>