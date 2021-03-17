<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<body>
<?php
$hostname = "localhost";
$username = "root";
$password = "tstark";
$db = "kkkp";

$conn=mysqli_connect($hostname,$username,$password,$db);
if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}
echo "Connected Successfully";
?>
<?php
$temp1=$_POST["temp1"];
$temp2=$_POST["temp2"];
$hum1=$_POST["hum1"];
$hum2=$_POST["hum2"];

$sql0 = "INSERT INTO sensdata (temp1, temp2,hum1,hum2) VALUES ($temp1,$temp2,$hum1, $hum2)";
/*$sql1="INSERT INTO series(hum2) values ('$hum2')";
$sql2="INSERT INTO authors(aname) values ('$authname')";
*/
// $arr = array($sql0, $sql1, $sql2);

// foreach ($arr as $sql){
if (mysqli_query($conn, $sql0)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//}
CloseCon($conn);

?>