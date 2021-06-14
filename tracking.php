
<?php
session_start(); 
$host="localhost"; 
$user="FTS"; 
$password=""; 
$db="user_login_details"; 
$port="3307";
$con=mysqli_connect($host,$user,$password,$db,$port); 
$id=$_SESSION['ID']; 
$query="select * from file_table where id='".$id."'"; 
$result= mysqli_query($con,$query); 
set_time_limit(500); 
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta content="width=device-width, initialscale=1.0" name="viewport">
 <title>Track_page</title>
 <meta content="" name="description">
 <meta content="" name="keywords">
 <style>
 	body
 	{
 		padding-bottom: 400px;
 		background:url(k.jpg);
 		background-position: center;
 		background-repeat: no-repeat;
 		background-size: cover;
 	}
.c{
 color:black;
 background-color:azure;
 padding:10px;
 margin:20px;
 justify-content:right;
 }

 </style>
</head>
<body>
<img  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFVqXqqaIl4phDSDgqUq0M3nMzqnvxS17-Uw&usqp=CAU" width="250" height="200">
<a href="selection.php"><button style="float: right; "class="w3-button w3-red w3-round-large">Go back >></button></a>
<a href="logout.php"><button style = "float:right;" class="button"><span id="font1">LogOut </span></button></a>
<form method="POST">
<?php
 if (mysqli_num_rows($result) > 0) { 
 while($row = mysqli_fetch_assoc($result)) { 
 $fid = $row["fileid"] ; 
 $fname = $row["fname"] ;
?>
<?php
$que="select comment from comment_table where fileid='".$fid."'" ;
$res=mysqli_query($con,$que);
?>
<?php
if(mysqli_num_rows($res)>0)
{
while($row1=mysqli_fetch_assoc($res)){
$fil=$row1["comment"];
?>
<?php
}
}
?>
<div class="c" style="flex-basis:300px">
<b><span style="color:red">file id: </span></b>
 <span><?php echo $fid?></span>
<br>
<b><span style="color:red">file name: </span></b>
<span><?php echo $fname?> </span> 
<div>
<div>
 <span><input style="float:right;" type="submit" name="<?php echo $fid; ?>" value="track"> </span>
</div>
</div>
<b><span style="color:red">comment: </span></b>
<span><?php echo $fil?></span>
</div>
<?php
}
}
?>
</form>
<?php
extract($_REQUEST); 
$query="select fileid from file_table where id='".$id."'"; 
$result= mysqli_query($con,$query); 
while($row = mysqli_fetch_assoc($result)) { 
 $rid=$row["fileid"]; 
 if(isset($_POST[$rid])) 
 { 
 $_SESSION["rid"] = $rid; 
 ?>
 <script>
 
 location.replace("status.php"); 
 </script>
 <?php
 
 } 
} 
?>

</body>
</html>