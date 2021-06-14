<?php
session_start(); 
$host="localhost"; 
$user="FTS"; 
$password=""; 
$db="user_login_details"; 
$port="3307";
$con=mysqli_connect($host,$user,$password,$db,$port); 
$id=$_SESSION['ID'];
$query="select id,fileid from file_table where status is null"; 
$result= mysqli_query($con,$query); 
$result1=$result; 
$files=scandir("uploads"); 
if(isset($_POST['submit'])) 
{ 
$comm=$_POST['comment'];
$id=$_SESSION['ID'];
if(mysqli_num_rows($result1)>0)
{
while($row2=mysqli_fetch_assoc($result1)){
$fileid=$row2["fileid"];
$insert="INSERT INTO comment_table(comment,id,fileid) values('$comm','$id','$fileid');";
$res= mysqli_query($con,$insert);
if($res){ 
 
 ?>
 <script>
 alert(" Comment posted successfully"); 
 </script>
 <?php
}
}
}
}
set_time_limit(500); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
 <meta content="width=device-width, initialscale=1.0" name="viewport">
 <title>Faculty_page</title>
 <meta content="" name="description">
 <meta content="" name="keywords">
 <style>
 	body
 { 
 padding-bottom:300px;
 background:url("teacher.jpg");
 background-size:cover;
 background-position:center;

 } 
 
 .c2{
 color:black;
 background-color:azure;
 padding-bottom:0px;
 margin:0px;
 justify-content:right;
 }
 }
 </style>
</head>
<body>
<img  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFVqXqqaIl4phDSDgqUq0M3nMzqnvxS17-Uw&usqp=CAU" width="200" height="200">
<a href="logout.php"><button style = "float:right;" class="button"><span id="font1">LogOut </span></button></a>
<a href="request.php"><button style = "float:right;" class="button"><span id="font1">Go back>> </span></button></a>
<form class="w3-container" method="POST" enctype="multipart/form-data">
<?php
 if (mysqli_num_rows($result) > 0) { 
 
 while($row = mysqli_fetch_assoc($result1)) { 
 $namea=$row["fileid"]."a";
$namer=$row["fileid"]."r";
$name = $row["id"] ; 
 $name1=$row["fileid"];
 
 for($a=0;$a<count($files);$a++) 
 { 
 $ram=pathinfo($files[$a],PATHINFO_FILENAME); 
 $var=0;
 if($name1==$ram)
 { 
 $var=1;
 $dowload_fname=$files[$a]; 
 break; 
 } 
 } 
 ?>
<div class="c2" style="flex-basis:70px">
<b><span style="color:red">Student id: </span> </b>
<span><?php echo $name;?></span>
<br>
<b><span style="color:red">File no.: </span></b>
<span><?php echo $name1;?></span>
<input style = "float:right" type="submit" name="<?php echo $namer?>" value="Reject"></input>
 <input style = "float:right" type="submit" name="<?php echo $namea?>" value="Accept"></input>

 <?php
 
 if($var==1) 
 { 
 ?>
 <a href ="uploads/<?php echo $dowload_fname?>" target="_blank"><p style="color:blue"><b>Click here to view file!</b></p></a>
<div>
<input text="textarea" name="comment" placeholder="comment"></input>
<button class="w3-button w3-black w3-hover-green" name="submit">Post</button>
<br><hr><br>
 <?php
}
?>
</div>
<?php
}
?>

</form>
<?php
$query="select fileid from file_table where status is null"; 
$result= mysqli_query($con,$query); 
while($row = mysqli_fetch_assoc($result)) { 
 $name= $row["fileid"]; 
 $namea = $row["fileid"]."a"; 
 $namer = $row["fileid"]."r"; 
 
 if(isset($_POST[$namea])) 
 { 
 $query="update file_table set status = 1 where fileid = '".$name."'"; 
 $exe = mysqli_query($con,$query); 
 if(!strcmp("file_table")) 
 { 
 $query="update file_table set status = 2 where fileid = '".$name."'"; 
 $exe = mysqli_query($con,$query); 
?>
<script>
alert("accepted");
</script>
<?php
 } 
 else{ 
 $query="update file_table set status = 1 where fileid = '".$name."'"; 
 $exe = mysqli_query($con,$query); 
 }
 ?> 
 <script>
 location.replace("request.php");  
 </script>
 <?php 
 } 
 if(isset($_POST[$namer])) 
 { 
 $query="update file_table set status = -2 where fileid = '".$name."'"; 
 $exe = mysqli_query($con,$query); 
?>
<script>
alert("rejected");
</script>
<?php
if(!strcmp("file_table")) 
 { 
 $query="update file set status = -
2 where fileid = '".$name."'"; 
 $exe = mysqli_query($con,$query); 
 } 
 else{ 
 $query="update file_table set status = -1 where fileid = '".$name."'"; 
 $exe = mysqli_query($con,$query); 
 echo "reject"; 
 } 
 ?> 
 <script>
 location.replace("request.php"); 
 </script>
<?php 
 } 
 
 
} 
} 
 
 else{ 
echo "no requests";
 
 } 
 ?>
</body>
</html>
