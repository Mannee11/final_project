<?php
include_once('dbconnect.php');

$conn = mysqli_connect("localhost","sopmycom_adminmyshop","i58[uBtsBU#k") or die("Unable to connect");
  mysqli_select_db($conn,"sopmycom_myshop"); 

$sql="DELETE FROM tbl_cart WHERE prid='$_GET[prid]'";
$result = mysqli_query($conn,$sql);

if($result){
echo '<script type="text/javascript"> alert("Delete Successful")</script>';
header("refresh:1; url=/project/php/user/mycart.php");
}
else{
echo "Error";
}
?>